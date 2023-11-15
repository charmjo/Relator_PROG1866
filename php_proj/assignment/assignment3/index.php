<!-- Notes
 - I tried researching on how to do {{$variable}} in html. Apparently, to implement this, a tempating engine like blade or twig have to be used.
 - Another way is to make a feature for this but that would be overkill.
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Charm Relator: Assignment 3</title>
</head>
<body>
    <?php 
        require('includes/config.php'); 
        require('process.php');
    ?>
    <?php include('includes/header.php'); ?>
    <main class="pad-20-all">
        <form class="" method="post" action="">
            <div class="form-container">
                <section class="form-wrapper">
                    <div class="form-wrap pad-20-all">
                        <h1>Order Form</h1>
                        <div class="field-wrapper">
                            <div class="labels">
                                <label for="uname">Name</label>
                            </div>    
                            <input value="<?php echo $person["uname"];?>" type="text" name="uname" id="uname" placeholder="John Doe"> 
                        </div>
                        <div class="field-wrapper">
                            <div class="labels">
                                <label for="uemail">Email</label>
                            </div>
                            <input value="<?php echo $person["uemail"];?>" type="text" name="uemail" id="uemail" placeholder="johndoe@test.com"> 
                        </div>
                        <div class="field-wrapper">
                            <div class="labels">
                                <label for="uphone">Phone</label>
                            </div>
                            <input value="<?php echo $person["uphone"];?>" type="text" name="uphone" id="uphone" placeholder="123-123-1234"> 
                        </div>
                        <div class="field-wrapper">
                            <div class="labels">
                                <label for="upostcode">Post Code</label>
                            </div>
                            <input value="<?php echo $person["upostcode"];?>" type="text" name="upostcode" id="upostcode" placeholder="A1B2C3"> 
                        </div>
                        <div class="field-wrapper">
                            <div class="labels">
                                <label for="uaddress">Address</label>
                            </div>
                            <input value="<?php echo $person["uaddress"];?>" type="text" name="uaddress" id="uaddress" placeholder="101 Redfox Grove">             
                        </div>
                        <div class="field-wrapper">
                            <div class="labels">
                                <label for="ucity">City</label>
                            </div>
                            <input value="<?php echo $person["ucity"];?>" type="text" name="ucity" id="ucity" placeholder="Waterloo">
                        </div>
                        <div class="field-wrapper">
                            <div class="labels">
                                <label for="uprovinces">Province</label>
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
                        
                        <div class="pad-20-vertical">
                            <hr>
                        </div>
                        <div class="creditCardSection">
                            <h3> Credit Card Details</h3>
                            <div class="field-wrapper">
                                <div class="labels">
                                    <label for="ucred_num">Credit Card Number</label>
                                </div>
                                <input value="<?php echo $person["ucred_num"];?>" type="text" name="ucred_num" id="ucred_num" placeholder="4111-1111-1111-1111">
                            </div>
                
                            <div class="expiry-section">
                                <p>Credit Card Expiry</p>
                                <div class="expiry-fields">
                                    <div class="field-wrapper">
                                        <div class="labels">
                                            <label for="ucred_month">Month:</label>
                                        </div>
                                        <input value="<?php echo $person["ucred_month"];?>" type="text" name="ucred_month" id="ucred_month" placeholder="JAN" minlength="3" maxlength="3">
                                    </div>
                                    <div class="field-wrapper">
                                        <div class="labels">
                                            <label for="ucred_year">Year:</label>
                                        </div>
                                        <input value="<?php echo $person["ucred_year"];?>" type="text" name="ucred_year" id="ucred_year" placeholder="2010">
                                    </div> 
                                </div>                    
                            </div>
                        </div>
                        <div class="pad-20-vertical">
                            <hr>
                        </div>

                        <div class="password-fields">
                            <div class="field-wrapper"> 
                                <div class="labels">
                                    <label for="upassword">Password</label>
                                </div>    
                                <input value="<?php echo $person["upassword"];?>" type="password" name="upassword" id="upassword"> 
                            </div>
                            <div class="field-wrapper"> 
                                <div class="labels">
                                    <label for="uconfirm_password">Confirm Password</label>
                                </div>    
                                <input value="<?php echo $person["uconfirm_password"];?>" type="password" name="uconfirm_password" id="uconfirm_password"> 
                            </div>
                        </div>
                        
                    </div>
                </section>
                <section class="product-wrapper pad-20-all">
                    <h1>Product List</h1>
                    <ul>
                        <li class="pad-20-all">
                            <img src="assets/images/ffxiv_cookbook.JPG" alt="The Ultimate Final Fantasy XIV Cookbook by Victoria Rosenthal">
                            <div class="productInfo pad-20-horizontal">
                                <h3 class="product-title">The Ultimate Final Fantasy XIV Cookbook</h3>
                                <p class="product-subtitle">by Victoria Rosenthal</p>
                                <h3 class="price">$2.25</h3>
                                <div class="qtySelect">
                                    <label for="cookbook_qty" hidden> Cookbook Qty</label>
                                    <input class="qtyField" type="number" name="cookbook_qty" id="cookbook_qty" min="0" max="999" value="0" placeholder="0">
                                </div>
                            </div>
                        </li>
                        <hr>
                        <li class="pad-20-all">
                            <img src="assets/images/saad_book.JPG" alt="Systems Analysis and Design in a Changing World">
                            <div class="productInfo pad-20-horizontal">
                                <h3 class="product-title">Systems Analysis and Design in a Changing World</h3>
                                <p class="product-subtitle">by John Satzinger</p>
                                <h3 class="price">$3.75</h3>
                                <div class="qtySelect">
                                    <label for="saadbook_qty" hidden> Cookbook Qty</label>
                                    <input class="qtyField" type="number" name="saadbook_qty" id="saadbook_qty" min="0" max="999" value="0" placeholder="0">
                                </div>
                            </div>
                        </li>
                    </ul>
                </section>
            </div>    
            <div class="submitWrapper pad-20-all">
                <input type="submit" value="Submit">
            </div>
        </form>
        <?php if ($errors) include('includes/error-messages.php');?>
        <?php if ($output) include('includes/receipt.php'); ?>

    </main>
    <?php require('includes/footer.php'); ?>
</body>
</html>