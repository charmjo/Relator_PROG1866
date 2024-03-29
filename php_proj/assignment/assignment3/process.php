<?php
/*
 TO DO:

*/
if ($_POST){
    $person["uname"] = $_POST["uname"];
    $person["uphone"] = $_POST["uphone"];
    $person["uemail"] = $_POST["uemail"];
    $person["upostcode"] = $_POST["upostcode"];
    $person["uaddress"] = $_POST["uaddress"];
    $person["ucity"] = $_POST["ucity"];
    $person["uprovince"] = $_POST["uprovinces"];
    $person["ucred_num"] = $_POST["ucred_num"];
    $person["ucred_month"] = $_POST["ucred_month"];
    $person["ucred_year"] = $_POST["ucred_year"];
    $person["upassword"] = $_POST["upassword"];
    $person["uconfirm_password"] = $_POST["uconfirm_password"];

    /*
        Notes on product lines:
        1. Only value that I'M GETTING FROM POST : qty.
    */
    $product1["id"] = "cookbook";
    $product1["name"] = "The Ultimate Final Fantasy XIV Cookbook by Victoria Rosenthal";
    $product1["qty"] = $_POST["cookbook_qty"];
    $product1["unit_price"] = 2.25;
    $product1["price"] = 0.00;

    $product2["id"] = "saadbook";
    $product2["name"] = "Systems Analysis and Design in a Changing World by John Satzinger";
    $product2["qty"] = $_POST["saadbook_qty"];
    $product2["unit_price"] = 3.75;
    $product2["price"] = 0.00;

    $products = [$product1,$product2];

    //main logic of the program.
    $keysWithError = [];
    $keysWithError = personValidateLogic($person);
    if (!$keysWithError){
        // decided not to clear the person array as it is easier to modify if the fields are filled.

        // taking advantage of how I can easily mutate php variables for this
        $output = processForm($person,$products);
        
    } else {
        $errors = formatErrorMessages($keysWithError, $inputFields);
    }
}

// getting the subtotal, tax rate, sales tax and total amount. 
function processForm ($person, $products) {
    // I want to avoid mutating the $person and $products array as possible since I use then for display.
    $outputArr = [];
    $productsWithSubtotal = calcPrice($products);
    if($productsWithSubtotal["subtotal"] >= PRICE_LIMIT) {
        $productsWithTax = calcTax($productsWithSubtotal,$person["uprovince"]);
    
        $outputArr["product_info"] = $productsWithTax;
        // format to currency here

        $outputArr["person_info"] = $person;
        // add person info
        return $outputArr;
    } else {
        return ["key" => "subtotalIsLessThan10"];
    }
}


// validates the person information fields
function personValidateLogic ($person) {
    $withError = [];

    // check for blanks
    foreach ($person as $key => $value) {
        if (hasError("blank",$value)) {
            array_push($withError,["key" => $key, "error_type" => "blank"]);   
        }
    }

    // check for format. 
    foreach ($person as $key => $value) {
        $error = false;
        if ($key == "upassword") {
            $error = hasError($key,$value,$person["uconfirm_password"]);
        } else if ($key == "uconfirm_password") {
            $error = hasError($key,$value,$person["upassword"]);
        } else {
            $error = hasError($key,$value);
        }

        // $withError array is populated with the the key and the error type.
        if ($error) {
            // double checking to avoid double error messages
            $keyCol = array_column($withError, 'key');
            $index = array_search($key,$keyCol);
            if (is_numeric($index)) {
                $withError[$index]["error_type"] = "format";
            } else {
                array_push($withError,["key" => $key, "error_type" => "format"]);        
            }    
        }
    }

    return $withError;
}

// I restricted the user input in the qty field. This should suffice.
function productValidateLogic ($products) {
    $withError = [];
    foreach ($products as $product) {
        $itemQty = $product["qty"]; 
        if (hasError("number",$itemQty)) {
            array_push($withError,["key" => $product["id"], "error_type" => "format"]);   
        }
    }
    return $withError;
}

// Validation vault. added blank here too.
function hasError ($key, $value,$secondValue = "") {

    if ($key == "uemail") {
        if (!preg_match(REGEX_EMAIL, $value)) return true;
    } 
    else if ($key == "uprovince") {
        $abbrCol = array_column(PROVINCES, 'abbr');
        if (!is_numeric(array_search($value,$abbrCol))) return true;
    } 
    else if ($key == "ucred_month") {
        if (!preg_match(REGEX_MONTH_LIST, $value)) return true;
    } 
    else if ($key == "ucred_num") {
        if (!preg_match(REGEX_CREDIT_CARD_NUM, $value)) return true;    
    } 
    else if ($key == "ucred_year") {
        if (!preg_match(REGEX_CREDIT_CARD_YEAR, $value)) return true;        
    } 
    else if ($key == "number") {
        if (!preg_match(REGEX_NUMBER, $value)) return true;  
    } 
    else if ($key == "upassword" || $key == "uconfirm_password") {
        if ($value != $secondValue) return true;  
    } 
    else if ($key == "blank") {
        if (trim($value) == "") return true;
    }
    return false;
}

// getting the subtotal
function calcPrice ($prods) {
    $index = 0;
    $subtotal = 0.00;

    foreach ($prods as $product) {
        $price = 0.00;
        $price = $product["qty"] * $product["unit_price"];
        $prods[$index]["price"] = $price;

        $subtotal += $prods[$index]["price"];

        $index++;
    }

    $productsWithSubtotal["products"] = $prods;
    $productsWithSubtotal["subtotal"] = $subtotal;

    return $productsWithSubtotal;
}

function calcTax ($prods, $provAbbr) {
    // get the tax value
    $province = getProvince($provAbbr);
    $taxRate = $province["tax_percent"];
    $salesTax = $taxRate * $prods["subtotal"];
    $newTotal = $salesTax + $prods["subtotal"];

    $prods["tax_rate"] = $taxRate;
    $prods["sales_tax"] = $salesTax;
    $prods["total"] = $newTotal;

    return $prods;
}

function getProvince ($provAbbr) {
    foreach (PROVINCES as $province) {
        if ($province["abbr"] == $provAbbr) return $province;
    }
    return false;
}

// general error message template
function formatErrorMessages ($keysWithError, $inputFields) {
    $errorMsg = [];
    // messages are formatted according to error type.
    foreach ($keysWithError as $item) {
        $field = $item["key"];
        if ($field == "upassword" || $field == "uconfirm_password") {

            // templating when matching password and confirm password
            if($field == "upassword") {
                $secField = "uconfirm_password";
            } else {
                $secField = "upassword";
            }
            array_push($errorMsg,"{$inputFields[$field]} and {$inputFields[$secField]} Fields do not match."); 
        } else if ($item["error_type"]  == "blank") {
            array_push($errorMsg,"{$inputFields[$field]} is {$item["error_type"]}"); 
        }
        else if ($item["error_type"]  == "format") {
            array_push($errorMsg,"Format for {$inputFields[$field]} is invalid.");
        } 
    }

    return $errorMsg;
}

//output
// be sure to clear the fields
function resetInputFields ($person, $products) {
    
}
?>