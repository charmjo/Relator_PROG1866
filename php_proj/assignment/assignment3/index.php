<?php require('includes/config.php'); 
      require('process.php');
      print_r($_POST);
?>
<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <?php include('includes/header.php'); ?>
    <main>
        <form method="post" action="">
            <div class="form-container">
                <div class="form-wrapper">
                    <div class="field-wrapper">
                        <div class="labels">
                            <label for="uname">Name</label>
                            <span id="nameError"></span>
                        </div>    
                        <input value="<?php echo $person["uname"]; ?>" type="text" name="uname" id="uname" placeholder="John Doe"> 
                    </div>
                    <div class="fieldWrapper">
                        <div class="labels">
                            <label for="uemail">Email</label>
                            <span id="emailError"></span>
                        </div>
                        <input value="<?php echo $person["uemail"];?>" type="text" name="uemail" id="uemail" placeholder="johndoe@test.com"> 
                    </div>
                    <div class="fieldWrapper">
                        <div class="labels">
                            <label for="uphone">Phone</label>
                            <span id="phoneError"></span>
                        </div>
                        <input value="<?php echo $person["uphone"];?>" type="text" name="uphone" id="uphone" placeholder="123-123-1234"> 
                    </div>
                    <div class="fieldWrapper">
                        <div class="labels">
                            <label for="upostcode">Post Code</label>
                            <span id="postCodeError"></span>
                        </div>
                        <input value="<?php echo $person["upostcode"];?>" type="text" name="upostcode" id="upostcode" placeholder="A1B2C3"> 
                    </div>
                    <div class="fieldWrapper">
                        <div class="labels">
                            <label for="uaddress">Address</label>
                            <span id="addressError"></span>
                        </div>
                        <input value="<?php echo $person["uaddress"];?>" type="text" name="uaddress" id="uaddress" placeholder="101 Redfox Grove">             
                    </div>
                    <div class="fieldWrapper">
                        <div class="labels">
                            <label for="ucity">City</label>
                            <span id="cityError"></span>
                        </div>
                        <input value="<?php echo $person["ucity"];?>" type="text" name="ucity" id="ucity" placeholder="Waterloo">
                    </div>
                    <div class="fieldWrapper">
                        <div class="labels">
                            <label for="uprovinces">Province</label>
                            <span id="provincesError"></span>
                        </div> 
                        <select name="uprovinces" id="uprovinces">
                            <option value="">-- SELECT PROVINCE --</option> 
                            <option value="AB">Alberta</option> 
                            <option value="BC">British Columbia</option> 
                            <option value="MB">Manitoba</option> 
                            <option value="NT">Northwest Territories</option> 
                            <option value="NU">Nunavut</option> 
                            <option value="QC">Quebec</option> 
                            <option value="SK">Saskatchewan</option> 
                            <option value="YT">Yukon</option> 
                            <option value="ON">Ontario</option> 
                            <option value="NB">New Brunswick</option>
                            <option value="NL">Newfoundland and Labrador</option> 
                            <option value="NS">Nova Scotia</option> 
                            <option value="PE">Prince Edward Island</option>
                        </select>
                    </div>
                    
                    <div class="creditCardSection">
                        <hr>
                        <h2 class="pad-20-all"> Credit Card Details</h2>
                        <div class="fieldWrapper">
                            <div class="labels">
                                <label for="ucred_num">Credit Card Number</label>
                                <span id="creditCardNumError"></span>
                            </div>
                            
                            <input value="<?php echo $person["ucred_num"];?>" type="text" name="ucred_num" id="ucred_num" placeholder="4111-1111-1111-1111">
                        </div>
            
                        <div class="fieldWrapper">
                            <h4>Credit Card Expiry</h4>
                                <div class="fieldWrapper">
                                    <div class="labels">
                                        <label for="ucreditExpiryMonth">Month:</label>
                                        <span id="creditExpiryMonthError"></span>
                                    </div>
                                    <input value="<?php echo $person["ucred_month"];?>" type="text" name="ucred_month" id="ucred_month" placeholder="JAN" minlength="3" maxlength="3">
                                </div>
                                <div class="fieldWrapper">
                                    <div class="labels">
                                        <label for="ucreditExpiryYear">Year:</label>
                                        <span id="creditExpiryYearError"></span>
                                    </div>
                                    <input value="<?php echo $person["ucred_year"];?>" type="text" name="ucred_year" id="ucred_year" placeholder="2010">
                                </div>              
                        </div>
                        <hr>
                    </div>

                    <div class="fieldWrapper"> 
                        <div class="labels">
                            <label for="upassword">Password</label>
                            <span id="passwordError"></span>
                        </div>    
                        <input value="<?php echo $person["upassword"];?>" type="password" name="upassword" id="upassword"> 
                    </div>
                    <div class="fieldWrapper"> 
                        <div class="labels">
                            <label for="uconfirmPassword">Confirm Password</label>
                            <span id="confirmPasswordError"></span>
                        </div>    
                        <input value="<?php echo $person["uconfirm_password"];?>" type="password" name="uconfirm_password" id="uconfirm_password"> 
                    </div>
                    
                </div>
                <div class="product-wrapper">

                </div>
            </div>    

            <?php if ($errors) include('includes/error-messages.php');?>
            
            <div class="submitWrapper pad-20-all">
                <input type="submit" value="Submit">
            </div>
        </form>

        <?php if ($errors) include('includes/receipt.php'); ?>

    </main>
    <?php require('includes/footer.php'); ?>
</body>
</html>