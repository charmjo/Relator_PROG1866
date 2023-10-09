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

const ERROR_MESSAGES = [

]

// eventlisteners

// methods
// function updatePrice(id) {
//     let sourceField = document.getElementById('')
// }


function countBookQty (value,id) {
    const min = 1;
    const max = 998;
    var qtyValue = document.getElementById(id).value;

    if(!validateDataFormat("number", qtyValue)) {
        // add color here
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
}

function checkoutItems () {
    let form = document.getElementById("checkoutForm");
    form.classList.remove("hidden");
}

function formHandler() {
    let formDetails = {} ;
    let errorList = {} ;

    //step 1 = fetch the data
    formDetails = setUserData();
    productDetails = setProductData();

    //step 2 = validate data
    errorList = validateDataLogic(formDetails);
    console.log(errorList);

    //step 3 = process data
    if(errorList.blank.length === 0 && errorList.format.length === 0) {

    } else { // show the error

    }

    //step 4=  show output
    // string literals can be multilined.
    // if(errors != '') {
    //     document.getElementById('output').innerHTML = errors;
    // } else {
    //     let output = '';

    //     output = `
    //         Name: ${uname} <br>
    //         Phone: ${uphone} <br>
    //         Tickets: ${tickets} <br>
            
    //     `;
    //     document.getElementById('output').innerHTML = output;
    // }

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
    formDetails.province = document.getElementById('uprovinces').value;
    formDetails.creditCardNum = document.getElementById('ucreditCardNum').value;
    formDetails.creditExpiryYear = document.getElementById('ucreditCardYear').value;
    formDetails.creditExpiryMonth = document.getElementById('ucreditCardMonth').value;

    return formDetails;
}

function setProductData () {
    let productDetails = [
        {productName: "The Ultimate Final Fanstasy XIV Cookbook", productQty: 0, totalBasePrice: 2.00},
        {productName: "Systems Analysis and Design in a Changing World", productQty: 0, totalBasePrice: 3.00},
    ];
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
        if (!validateDataFormat(key,data[key])) {
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
    else if (key == "password") {
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

    // I chose to follow retailcouncil.org's website since canada's government website only listed  GST and HST while some provinces have their own tax rules i.e Quebec
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