
$( document ).ready(function() {
    // Handler for .ready() called.

    // FIXME: add validations for the province dropdown.
    // submission forms
    $('#order-form').on('submit', function (e) {
      e.preventDefault(); // prevent the default functionality of form submission. forms automatically reload when they submit.
      
      // get all data from the form
      // var email = $('#login-email').val();
      // var password = $('#login-password').val();

      // serialize gets the name of the fiels.
      console.log($('#order-form').serialize());
      var formData = $('#order-form').serialize();

      // sned that data to the process page
      // AJAX
      // this is a method call, passing an object as a parameter
      $.ajax({
        type : 'POST',
        url  : 'process.php',
        data: {
          action : 'order-add',  
          formData : formData,
        },
        success : function (output) {
          console.log(output); 
      //    var outputObj = JSON.parse(output);

          // if (outputObj['outputType'] == 'success' ) { 
          //     $('#errors').html('');
          //     $('#formResult').html(outputObj['output']);
          // } else {
          //     $('#formResult').html('');
          //     $('#errors').html(outputObj['output']);
          // }
        }
      });
    });

    $('#manager-form').on('submit', function (e) {
      e.preventDefault(); // prevent the default functionality of form submission. forms automatically reload when they submit.
    
      // serialize gets the name of the fiels.
      console.log($('#manager-form').serialize());
      var formData = $('#manager-form').serialize();

      // sned that data to the process page
      // AJAX
      // this is a method call, passing an object as a parameter
      $.ajax({
        type : 'POST',
        url  : 'process.php',
        data: {
          action : 'manager-add',  
          formData : formData,
        },
        success : function (output) {
          console.log(output);
      //    var outputObj = JSON.parse(output);
        //TODO: manager form Error messages
        //TODO: Do another callback to show list of users.

          // if (outputObj['outputType'] == 'success' ) { 
          //     $('#errors').html('');
          //     $('#formResult').html(outputObj['output']);
          // } else {
          //     $('#formResult').html('');
          //     $('#errors').html(outputObj['output']);
          // }
        }
      });
    });


    // event-handlers 
    $("#yarn_qty").change(function () {
      console.log($("#yarn_qty").val());
    });

    $("#needle_qty").change(function () {
      console.log($("#needle_qty").val());
    });
});