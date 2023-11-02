// eventlisteners
var mugField = document.getElementById("mug");
var scissorsField = document.getElementById("scissors");
var scrunchieField = document.getElementById("scrunchie");

mugField.addEventListener("change", updateMugPrice);
scissorsField.addEventListener("change", updateScissorsPrice);
scrunchieField.addEventListener("change", updateScrunchiePrice);

function updateMugPrice (event) {
    mugField.classList.remove("errorBorder");
    if(!validateDataFormat("number",event.target.value)) {
        mugField.classList.add("errorBorder");
        //WILL need to make the some error trapping stuff here 
        return;
    }
    updatePrice("mug",event.target.value);
}

function updateScissorsPrice (event) {
    scissorsField.classList.remove("errorBorder");
    if(!validateDataFormat("number",event.target.value)) {
        scissorsField.classList.add("errorBorder");
        //WILL need to make the some error trapping stuff here 
        return;
    }
    updatePrice("scissors",event.target.value);
}

function updateScrunchiePrice (event) {
    scrunchieField.classList.remove("errorBorder");
    if(!validateDataFormat("number",event.target.value)) {
        scrunchieField.classList.add("errorBorder");
        //WILL need to make the some error trapping stuff here 
        return;
    }
    updatePrice("scrunchie",event.target.value);
}

// general-purpose functions
function updatePrice(id, qty) {
    let price = 0;
    let getId;

    getId = id.charAt(0).toUpperCase()+id.slice(1);
    let totalField = document.getElementById(`total${getId}`);

    qty = parseFloat(qty);

    if (id=="mug"){
        price = 20.50;
    } else if (id == "scissors") {
        price = 8.50;
    } else if (id == "scrunchie") {
        price = 12.50;
    }

    totalField.textContent = (price * qty).toFixed(2); 
}


function countItemQty (value,id) {
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
        let taxDetail = calcTax(subtotal);
        let grandTotal = subtotal + taxDetail.salesTax;

        formDetails.subtotal = subtotal;
        formDetails.grandTotal = grandTotal;
        displayReceipt(formDetails,productDetails,taxDetail);
                
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
    formDetails.clientNo = document.getElementById('uclientNo').value;
    formDetails.email = document.getElementById('uemail').value;

    return formDetails;
}

function setProductData () {
    let productDetails = [
        {productName: "Mug", productQty: 0, unitPrice: 20.50, totalPrice: 0.00},
        {productName: "Scissors", productQty: 0, unitPrice: 8.50, totalPrice: 0.00},
        {productName: "Scrunchie", productQty: 0, unitPrice: 12.50, totalPrice: 0.00},
    ];

    let mugQtyValue = document.getElementById("mug").value;
    let scissorsQtyValue = document.getElementById("scissors").value;
    let scrunchieQtyValue = document.getElementById("scrunchie").value;

    if (!validateDataFormat("number",mugQtyValue) || !validateDataFormat("number",scissorsQtyValue)) {
        //TO DO: add error message here
        return false;
    }

    mugQtyValue = parseFloat(mugQtyValue);
    scissorsQtyValue = parseFloat(scissorsQtyValue);
    scrunchieQtyValue = parseFloat(scrunchieQtyValue);

    productDetails[0].productQty = mugQtyValue;
    productDetails[1].productQty = scissorsQtyValue;
    productDetails[2].productQty = scrunchieQtyValue;

    for (const item of productDetails) {
        item.totalPrice = item.unitPrice * item.productQty;
    }

    

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

        if (key == "clientNo") {
            validation = validateDataFormat("number",data[key])
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

    if (key == "email") { // email
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
    else if (key == "number") {
        regex = /^\d+$/;
        if(!data.match(regex)) return false;
    }

   return true;
}

// calculates tax per province/territory
function calcTax (subtotal) {
    let tax = .13;
    let taxDetail = {};

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
    let receipt = '';
    let newline = '\r\n';
    let receiptDisplay = document.getElementById("receiptDisplay");
    let output = document.getElementById("output");
    output.classList.remove("hidden", "errorText");

    receipt = `Order Confirmation \r\n`;
    receipt += `Name: ${formDetails.name} \r\n`;
    receipt += `Client Number: ${formDetails.clientNo} ${newline}Email: ${formDetails.email} \r\n`;
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