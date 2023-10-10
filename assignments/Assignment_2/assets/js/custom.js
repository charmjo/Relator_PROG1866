//constant dictionaries
const PROVINCES = [
    {abbr: "AB", name: "Alberta"},
    {abbr: "BC", name: "British Columbia"},
    {abbr: "MB", name: "Manitoba"},
    {abbr: "NT", name: "Northwest Territories"},
    {abbr: "NU", name: "Nunavut"},
    {abbr: "QC", name: "Quebec"},
    {abbr: "SK", name: "Saskatchewan"},
    {abbr: "YT", name: "Yukon"},
    {abbr: "ON", name: "Ontario"},
    {abbr: "NB", name: "New Brunswick"},
    {abbr: "NL", name: "Newfoundland and Labrador"},
    {abbr: "NS", name: "Nova Scotia"},
    {abbr: "PE", name: "Prince Edward Island"},
];


// eventlisteners
var cookbookField = document.getElementById("cookbook");
var saadbookField = document.getElementById("saadbook");

cookbookField.addEventListener("change", updateCookbookPrice);
saadbookField.addEventListener("change", updateSaadbookPrice);

function updateCookbookPrice (event) {
    cookbookField.classList.remove("errorBorder");
    if(!validateDataFormat("number",event.target.value)) {
        cookbookField.classList.add("errorBorder");
        //WILL need to make the some error trapping stuff here 
        return;
    }
    updatePrice("cookbook",event.target.value);
}

function updateSaadbookPrice (event) {
    saadbookField.classList.remove("errorBorder");
    if(!validateDataFormat("number",event.target.value)) {
        saadbookField.classList.add("errorBorder");
        //WILL need to make the some error trapping stuff here 
        return;
    }
    updatePrice("saadbook",event.target.value);
}

// general-purpose functions
function updatePrice(id, qty) {
    let price = 0;
    let getId;

    getId = id.charAt(0).toUpperCase()+id.slice(1);
    let totalField = document.getElementById(`total${getId}`);

    qty = parseFloat(qty);

    if (id=="cookbook"){
        price = 2.00;
    } else if (id == "saadbook") {
        price = 3.00;
    }

    totalField.textContent = (price * qty).toFixed(2); 
}


function countBookQty (value,id) {
    const min = 1;
    const max = 998;
    let qtyValue = document.getElementById(id).value;

    if(!validateDataFormat("number", qtyValue)) {
        // TO DO: ERROR message, add color here
        return;
    }

    // just making sure these two items have the same number format
    qtyValue = parseInt(qtyValue);
    value = parseInt(value);

    // min = 0, max = 999
    if(qtyValue < min && value == -1) return;
    else if (qtyValue > max && value == 1) return;

    qtyValue = qtyValue + value;
    document.getElementById(id).value = qtyValue;

    updatePrice(id,qtyValue);
}

function checkoutItems () {
    let form = document.getElementById("checkoutForm");
    form.classList.remove("hidden");
}

// form functions
function formHandler() {
    let formDetails = {} ;
    let errorList = {} ;

    //step 1 = fetch the data
    formDetails = setUserData();
    productDetails = setProductData();

    //step 2 = validate data
    errorList = validateDataLogic(formDetails);
    if (!productDetails) {
        // as much as I would like to do modals but I lack the time to implement and test it.
        alert("Your product quantity has an incorrect format. Please enter a valid format. Thank you.");
    }

    // clean up error messages
    for (let key in formDetails) {
        let field = document.getElementById(`u${key}`);
        let message = document.getElementById(`${key}Error`);

        field.classList.remove("errorBorder");
        message.textContent = ``;
    }

    //step 3 = process data
    if(errorList.blank.length === 0 && errorList.format.length === 0) {
        let subtotal = calcSubtotal(productDetails);
        let taxDetail = calcTax(formDetails.provinces,subtotal);
        let grandTotal = subtotal + taxDetail.salesTax;

        // I will go with gross purchase (without the tax) when it comes to showing the receipt
        if (subtotal < 10){
            let receiptDisplay = document.getElementById("receiptDisplay");
            let output = document.getElementById("output");
            
            output.classList.remove("hidden");
            output.classList.add("errorText");
            receiptDisplay.textContent = " Sorry, you must have a minimum purchase of $10.00. Thank you.";

        } else {
            formDetails.subtotal = subtotal;
            formDetails.grandTotal = grandTotal;
            displayReceipt(formDetails,productDetails,taxDetail);
        }
        
    } else { // show the error
        errorList.blank.forEach(item => {
            let field = document.getElementById(`u${item}`);
            let message = document.getElementById(`${item}Error`);

            // the border works I forgot to remove the comment in the video
            field.classList.add("errorBorder");
            message.textContent = `Please fill up ${item}`;
        });

        errorList.format.forEach(item => {
            let field = document.getElementById(`u${item}`);
            let message = document.getElementById(`${item}Error`);

            // the border works I forgot to remove the comment in the video
            if (!field.classList.contains("errorBorder")){
                field.classList.add("errorBorder");
            }
            message.textContent = `Please enter the correct format`;
        });
    }

    return false;
}

function setUserData () {
    let formDetails = {};
    formDetails.name = document.getElementById('uname').value;
    formDetails.phone = document.getElementById('uphone').value;
    formDetails.email = document.getElementById('uemail').value;
    formDetails.postCode = document.getElementById('upostCode').value;
    formDetails.address = document.getElementById('uaddress').value;
    formDetails.city = document.getElementById('ucity').value;
    formDetails.provinces = document.getElementById('uprovinces').value;
    formDetails.creditCardNum = document.getElementById('ucreditCardNum').value;
    formDetails.creditExpiryYear = document.getElementById('ucreditExpiryYear').value;
    formDetails.creditExpiryMonth = document.getElementById('ucreditExpiryMonth').value;
    formDetails.password = document.getElementById('upassword').value;
    formDetails.confirmPassword = document.getElementById('uconfirmPassword').value;

    return formDetails;
}

function setProductData () {
    let productDetails = [
        {productName: "The Ultimate Final Fanstasy XIV Cookbook", productQty: 0, unitPrice: 2.00, totalPrice: 0.00},
        {productName: "Systems Analysis and Design in a Changing World", productQty: 0, unitPrice: 3.00, totalPrice: 0.00},
    ];

    let cookbookQtyValue = document.getElementById("cookbook").value;
    let saadbookQtyValue = document.getElementById("saadbook").value;

    if (!validateDataFormat("number",cookbookQtyValue) || !validateDataFormat("number",saadbookQtyValue)) {
        //TO DO: add error message here
        return false;
    }

    cookbookQtyValue = parseFloat(cookbookQtyValue);
    saadbookQtyValue = parseFloat(saadbookQtyValue);

    productDetails[0].productQty = cookbookQtyValue;
    productDetails[0].totalPrice = productDetails[0].unitPrice * cookbookQtyValue;
    productDetails[1].productQty = saadbookQtyValue;
    productDetails[1].totalPrice = productDetails[1].unitPrice * saadbookQtyValue;

    return productDetails;  
}

function validateDataLogic (data) {
    let errors = {};
    errors.blank = [];
    errors.format = [];
    for (let key in data) {
        if (data[key] == ''){
            errors.blank.push(key);
        }
    }

    for (let key in data) {
        let validation = false;

        // password and confirm password are kinda different coz they are both user input.
        if (key == "password" ) {
            validation = validateDataFormat(key, data["password"], data["confirmPassword"]);
        } else if (key == "confirmPassword") {
            validation = validateDataFormat(key, data["password"], data["confirmPassword"]);
        } else {
            validation = validateDataFormat(key,data[key])     
        }

        if (!validation) {
            errors.format.push(key);
        }
        
    }
    return errors;
}

function validateDataFormat (key, data, password="") {
    let regex;

    if(key == "creditExpiryMonth"){
        const months = ['JAN','FEB','MAR','APR','MAY','JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];
        if (!months.includes(data)) return false;
    } 
    else if (key == "creditCardNum") { // credit card num
        regex=/^(\d{4}\-){3}\d{4}$/;  
        if (!data.match(regex)) return false;
    } 
    else if (key == "creditExpiryYear") { // credit card expiry year
        regex = /^\d{4,4}$/;
        if (!data.match(regex)) return false;
    } 
    else if (key == "email") { // email
        /*
        // positive test cases
            charmjohannes.relator@gmail.com
            test@test.com
            Crelator5384@conestogac.on.ca
            charm_relator@gmail.com
        
        // negative test casess
            charm@gma_il.com
            x@test.com
            xy@test.com
        */
        regex= /^(\w{3,}(\.)?)+@([a-z0-9]+\.)+[a-z0-9]+$/i;
        if (!data.match(regex)) return false;          
    } 
    else if (key == "password" || key == "confirmPassword") {
        regex = password;
        if (!data.match(regex)) return false;
    }
    else if (key == "number") {
        regex = /^\d+$/;
        if(!data.match(regex)) return false;
    }

   return true;
}

// calculates tax per province/territory
function calcTax (province, subtotal) {
    let tax = 0;
    let taxDetail = {};
    let salesTax = 0;

    // I chose to follow retailcouncil.org's website since canada's federal government website only listed  GST and HST while some provinces have their own tax rules i.e Quebec. Fedex website also uses the same percentage.
    // source for tax table: https://www.retailcouncil.org/resources/quick-facts/sales-tax-rates-by-province/
    const PROVINCE_15 = ['NB','NL','NS','PE'];
    const PROVINCE_5 = ['AB','NT','NU','YT'];
    const PROVINCE_12 = ['MB','BC'];  
    const QUEBEC = 'QC';
    const ONTARIO = 'ON'; 
    const SASKATCHEWAN = 'SK';

    if (PROVINCE_15.includes(province)) {
        tax = .15;
    } else if (PROVINCE_12.includes(province)) {
        tax = .12;
    } else if (PROVINCE_5.includes(province)){
        tax = .05;
    } else if (province == QUEBEC) {
        tax = .14975;
    } else if (province == ONTARIO) {
        tax = .13;
    } else if (province == SASKATCHEWAN) {
        tax = .11;
    }

    salesTax = tax * subtotal;
    
    taxDetail.taxRate = tax;
    taxDetail.salesTax = salesTax;
    
    return taxDetail;
}

function calcSubtotal (productList) {
    let subtotal = 0.0;

    for (const item of productList) {
        subtotal += item["totalPrice"];
    }
    return subtotal;
}

function displayReceipt(formDetails, productDetails, taxDetail){
    // NOTE 1: I AM NOT showing passwords since showing them are risky
    // NOTE 2: I will show credit card details (knowing they will not be showed in real life for completion purposes.)
    let receipt = '';
    let newline = '\r\n';
    let receiptDisplay = document.getElementById("receiptDisplay");
    let output = document.getElementById("output");
    output.classList.remove("hidden", "errorText");

    receipt = `Name: ${formDetails.name} ${newline}Address: ${formDetails.address} ,${formDetails.city}, ${formDetails.provinces}, ${formDetails.postCode} \r\n`;
    receipt += `Phone: ${formDetails.phone} ${newline}Email: ${formDetails.email} \r\n`;
    receipt += `Credit Card Number: ${formDetails.creditCardNum} \t\tExpiry Month: ${formDetails.creditExpiryMonth} \t\tExpiry Year: ${formDetails.creditExpiryYear}\r\n`;
    receipt += `========================================================================================= \r\n`;
    receipt += `Product List \r\n`;
    
    for (const product of productDetails) {
        receipt += `${product["productName"]}\t - \tUnit Price: ${product["unitPrice"].toFixed(2)}\t - \tQty: ${product["productQty"]}\t - \tTotal Price: ${product["totalPrice"].toFixed(2)} \r\n`;
    }

    receipt += `========================================================================================= \r\n`;
    receipt += `Subtotal: ${formDetails.subtotal} \r\n`;
    receipt += `Sales Tax (${taxDetail.taxRate * 100}%): ${taxDetail.salesTax.toFixed(2)} \r\n`;
    receipt += `Grand Total: ${formDetails.grandTotal.toFixed(2)} \r\n`;

    receiptDisplay.textContent = receipt;
}