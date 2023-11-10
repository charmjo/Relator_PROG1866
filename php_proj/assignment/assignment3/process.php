<?php
/*
 TO DO:
    - WRITE THE HTML SIDE
    - namespace
    - work on ze products on FE
    - DISPLAY THE RESULTS
    - DISPLAY THE ERROR
    - DISPLAY THE RECEIPT

    DO THIS AFTER I DO THE FRONTEND
    - check if every field key is present in the post request 
*/
// make this dynamic but I wanted to do a class implementation of this 
if ($_POST){
    $person["uname"] = $_POST["uname"];
    $person["uphone"] = $_POST["uphone"];
    $person["uemail"] = $_POST["uemail"];
    $person["upostcode"] = $_POST["upostcode"];
    $person["uaddress"] = $_POST["uaddress"];
    $person["ucity"] = $_POST["ucity"];
    $person["uprovince"] = 'AB';
    $person["ucred_num"] = $_POST["ucred_num"];
    $person["ucred_month"] = $_POST["ucred_month"];
    $person["ucred_year"] = $_POST["ucred_year"];
    $person["upassword"] = $_POST["upassword"];
    $person["uconfirm_password"] = $_POST["uconfirm_password"];

    $product1["id"] = "cookbook"; // TODO
    $product1["name"] = "Cookbook"; // TODO
    $product1["qty"] = 2;
    $product1["unit_price"] = 2.25;
    $product1["price"] = 0.00;

    $product2["id"] = "saadbook"; // TODO
    $product2["name"] = "Systems analysis and Design"; //TODO
    $product2["qty"] = 1;
    $product2["unit_price"] = 3.75;
    $product2["price"] = 0.00;

    $products = [$product1,$product2];

    //validate
    $keysWithError = validateLogic($person);
    if (!$keysWithError){
        // process
        // clear ze errors
        // charm, take into account if the subtotal is lesser than 10. will need to put a key on the error message. I love php mutations :)
        $output = processForm($person,$products);
        
    } else {
        $errors = formatErrorMessages($keysWithError, $inputFields);
        print_r($errors);
        // display error
    }
}


function validateLogic ($person) {
    $withError = [];

    // check for blanks
    foreach ($person as $key => $value) {
        if (hasError("blank",$value)) {
            array_push($withError,["key" => $key, "error_type" => "blank"]);   
        }
    }

    // check for format
    foreach ($person as $key => $value) {
        $error = false;
        if ($key == "password") {
            $error = hasError($key,$value,$person["uconfirm_password"]);
        } else if ($key == "uconfirm_password") {
            $error = hasError($key,$value,$person["upassword"]);
        } else {
            $error = hasError($key,$value);
        }

        if ($error) {
            array_push($withError,["key" => $key, "error_type" => "format"]);            
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
        $abbrCol = array_column(MONTHS, 'abbr');
        // array_search returns the index.
        if (!is_numeric(array_search($value,$abbrCol))) return true;
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
    else if ($key == "password" || $key == "confirmPassword") {
        if ($value != $secondValue) return true;  
    } 
    else if ($key == "blank") {
        if (trim($value) == "") return true;
    }
    return false;
}

// process
function processForm ($person, $products) {
    $productsWithSubtotal = calcPrice($products);
    if($productsWithSubtotal["subtotal"] >= 10) {
        $productsWithTax = calcTax($productsWithSubtotal,$person["uprovince"]);
        return $productsWithTax;
    } else {
        return ["key" => "subtotalIsLessThan10"];
        // put message here
    }

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

function formatErrorMessages ($keysWithError, $inputFields) {
    $errorMsg = [];
    foreach ($keysWithError as $item) {
        $field = $item["key"];
        if ($item["error_type"]  == "blank") {
            array_push($errorMsg,["{$inputFields[$field]} is {$item["error_type"]}"]); 
        }
        else if ($item["error_type"]  == "format") {
            array_push($errorMsg,["Format for {$inputFields[$field]} is invalid."]);
        }
    }

    return $errorMsg;

}
//output

?>