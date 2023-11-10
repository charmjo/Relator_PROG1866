<?php
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

?>