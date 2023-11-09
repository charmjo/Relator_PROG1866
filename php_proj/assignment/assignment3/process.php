<?php

/*
 TO DO:
    - VALIDATION - DONE
    - GET THE TAX RATE -
    - WRITE THE HTML SIDE
    - namespace
    - DISPLAY THE RESULTS
    - DISPLAY THE ERROR
    - DISPLAY THE RECEIPT

*/
//constants, I should place this on a separate file
define("PROVINCES", [
    ["abbr" => "NB","name" => "New Brunswick", "tax_percent" => .15],
    ["abbr" => "NL","name" => "Newfoundland and Labrador", "tax_percent" => .15],
    ["abbr" => "NS","name" => "Nova Scotia", "tax_percent" => .15],
    ["abbr" => "PE","name" => "Prince Edward Island", "tax_percent" => .15],
    ["abbr" => "AB","name" => "Alberta", "tax_percent" => .05],
    ["abbr" => "NT","name" => "Northwest Territories", "tax_percent" => .05],
    ["abbr" => "NU","name" => "Nunavut", "tax_percent" => .05],
    ["abbr" => "YT","name" => "Yukon", "tax_percent" => .05],
    ["abbr" => "MB","name" => "Manitoba", "tax_percent" => .12],
    ["abbr" => "BC","name" => "British Columbia", "tax_percent" => .12],
    ["abbr" => "QC","name" => "Quebec", "tax_percent" => .14975],
    ["abbr" => "ON","name" => "Ontario", "tax_percent" => .13],
    ["abbr" => "SK","name" => "Saskatchewan", "tax_percent" => .11]
]);

define("MONTHS", [
    ["abbr" => "JAN","name" => "January"],
    ["abbr" => "FEB","name" => "February"],
    ["abbr" => "MAR","name" => "March"],
    ["abbr" => "APR","name" => "April"],
    ["abbr" => "MAY","name" => "May"],
    ["abbr" => "JUN","name" => "June"],
    ["abbr" => "JUL","name" => "July"],
    ["abbr" => "AUG","name" => "August"],
    ["abbr" => "SEP","name" => "September"],
    ["abbr" => "OCT","name" => "October"],
    ["abbr" => "NOV","name" => "November"],
    ["abbr" => "DEC","name" => "December"],
]);

// see assignment 2 for this.
define("REGEX_CREDIT_CARD_NUM","/^(\d{4}\-){3}\d{4}$/");
define("REGEX_CREDIT_CARD_YEAR","/^\d{4,4}$/");
define("REGEX_EMAIL","/^(\w{3,}(\.)?)+@([a-z0-9]+\.)+[a-z0-9]+$/i");
define("REGEX_NUMBER","/^\d+$/");

// input fields
$inputFields = [
    "uname" => "Username",
    "uphone" =>"Phone",
    "uemail" => "Email",
    "upostcode" => "Postcode",
    "uaddress" => "Address",
    "ucity" => "Address",
    "uprovince" => "Province",
    "ucred_mum" => "Credit Card Number",
    "ucred_month" => "Credit Card Expiry Month",
    "ucred_year" => "Credit Card Expiry Year",
    "upassword" => "Password",
    "uconfirm_password" => "Confirm Password",
];

// fetch
$person = [];
$errors = [];
$person["uname"] = "Charm";
$person["uphone"] ="123-123-1234";
$person["uemail"] = "charm@test.com";
$person["upostcode"] = "A1B 2C3";
$person["uaddress"] = "20 kingsdrive";
$person["ucity"] = "Waterloo";
$person["uprovince"] = "NB";
$person["ucred_mum"] = "1234-1234-1234-1234";
$person["ucred_month"] = "JAN";
$person["ucred_year"] = "2027";
$person["upassword"] = "test123";
$person["uconfirm_password"] = "test123";

$product1["id"] = "cookbook"; // TODO
$product1["name"] = "Cookbook"; // TODO
$product1["qty"] = 2;
$product1["unit_price"] = 2.25;
$product1["price"] = 0.00;

$product2["id"] = "saadbook"; // TODO
$product2["name"] = "Systems analysis and Design"; //TODO
$product2["qty"] = 5;
$product2["unit_price"] = 3.75;
$product2["price"] = 0.00;

$products = [$product1,$product2];



// validateLogic();
//validate


$keysWithError = validateLogic($person);
if (!$keysWithError){
    // process
    // I should revise this so I do not mutate the original array
    processForm($person,$products);
} else {
    // display error
}



function validateLogic ($person) {
    $keysWithError = [];

    // check for blank
    foreach ($person as $key => $value) {
        if (hasError("blank",$value)) {
            array_push($keysWithError,["key" => $key, "error_type" => "blank"]);   
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
            array_push($keysWithError,["key" => $key, "error_type" => "format"]);            
        }
    }

    return $keysWithError;
}

// Validation vault
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
        print_r($productsWithTax);
    } else {
        // put message here
    }

}

// change this so this is a copy of products instead
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

    $prods["tax_rate"] = $taxRate;
    $prods["sales_tax"] = $salesTax;

    return $prods;
}

function getProvince ($provAbbr) {
    foreach (PROVINCES as $province) {
        if ($province["abbr"] == $provAbbr) return $province;
    }
    return false;
}

//output




?>