/*
    Using jQuery for form validations
*/

$(document).ready(function(){
    $('#myform').validate({
        messages: {
            studentName:{
                required: 'Name is required'
            }
        }
    });
});


