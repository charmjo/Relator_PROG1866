// eventlisteners


function decrementBookQty () {

}

function formHandler() {
    // return true if there is no error on validation
    // return false  if there is error on validation
    // can submit data to server if true

    //step 1 = fetch the data
    let uname = document.getElementById('uname').value;
    let uphone = document.getElementById('uphone').value;
    let tickets = document.getElementById('tickets').value;


    //step 2 = validate data
    // if (errors), this will be true if the errors variable has any string on it. 
    let errors = '';

    if (uname == '') {
        errors += 'Please enter your name.';
    }

    // no need to put string tags in JS regex
    // I manage to shorten it from /^[0-9]{3}[\-][0-9]{3}[\-][0-9]{4}$/
    let phoneRegex = /^\d{3}\-\d{3}\-\d{4}$/

    if(!phoneRegex.test(uphone)) {
        errors += '<br> Phone number is not in the correct format';
    } 
    // even if you have a dropdown, validation is still needed.

    //step 3 = process data

    //step 4=  show output
    // string literals can be multilined.
    if(errors != '') {
        document.getElementById('output').innerHTML = errors;
    } else {
        let output = '';

        output = `
            Name: ${uname} <br>
            Phone: ${uphone} <br>
            Tickets: ${tickets} <br>
            
        `;
        document.getElementById('output').innerHTML = output;
    }

    return false;
}