<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Forms and Validations</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <script type="text/javascript" src="js/custom.js"></script> -->
  <link href="https://fonts.googleapis.com/css?family=Bilbo+Swash+Caps" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Kalam" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myform').on('submit', function (e) {
        e.preventDefault(); // prevent the default functionality of form submission. forms automatically reload when they submit.
        
        // get all data from the form
        var name = $('#name').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        var postcode = $('#postcode').val();
        var lunch = $('.lunch:checked').val();
        var tickets = $('#tickets').val();
        var campus = $('#campus').val();

        // serialize gets the name of the fiels.
        console.log($('#myform').serialize());

        // sned that data to the process page
        // AJAX
        // this is a method call, passing an object as a parameter
        $.ajax({
          type : 'POST',
          url  : 'process.php',
          data: {
            name     : name,  
            email    : email,
            phone    : phone,
            postcode : postcode,
            lunch    : lunch,
            tickets  : tickets,
            campus   : campus
          },
          success : function (output) {
            console.log(output);
            var outputObj = JSON.parse(output);

            if (outputObj['outputType'] == 'success' ) { 
                $('#errors').html('');
                $('#formResult').html(outputObj['output']);
            } else {
                $('#formResult').html('');
                $('#errors').html(outputObj['output']);
            }
          }
        });

        // show output
      });
    });
  </script>
</head>

<body>
  <header>
    Welcome Admin!
  </header>
  <?php include('includes/nav.php'); ?>
  <main>
    <section class="w50">
      <form name="myform" id="myform" method="POST" action="process.php">
        <label>Name</label>
        <input id="name" value=""  placeholder="First Last" type="text" name="name"><br />

        <label>Email</label>
        <input id="email" value="" placeholder="email@domain.com" type="email" name="email"><br />

        <label>Phone</label>
        <input id="phone" value="" placeholder="123-123-1234" type="phone" name="phone"><br />

        <label>Post Code</label>
        <input id="postcode" value="" placeholder="X9X 9X9" type="postcode" name="postcode"><br />

        <label>Will you have lunch?</label>
        <input class="lunch" type="radio" value="yes" id="radio1" checked name="lunch">Yes
        &nbsp;&nbsp;&nbsp;&nbsp;
        <input class="lunch" type="radio" value="no" id="radio2" name="lunch">No
        <br />

        <label>Number of Tickets</label>
        <select name="tickets" id="tickets">
          <option value="">----- Select -----</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
        </select><br />

        <label>Which Campus?</label>
        <select name="campus" id="campus">
          <option value="">----- Select -----</option>
          <option value="Doon">Doon</option>
          <option value="Waterloo">Waterloo</option>
          <option value="Cambridge">Cambridge</option>
        </select>

        <br /><br />

        <input type="submit" value="Submit">
        <p id="errors">
        </p>
      </form>
    </section>
    <section class="w50">
      <div class="formData">
        <p id="formResult">
        </p>
      </div>
    </section>
    <div class="clear"></div>
  </main>
</body>

</html>