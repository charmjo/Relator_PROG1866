<!-- 
- I wanted to minimize the number of PHP tags as possible so it is easier to read. 
- The thing is, I prefer the presence of php tags rather than echoing html tags inside php. I find it harder to read html tags in strings.
- This little template will show the output.
- personal notes: do this last coz I know you have the most experience when it comes to things like this.
-->
<div class="output-wrapper">
    <!-- if subtotal is lesser than 10 -->
    <?php
        if(isset($output["key"])) {
    ?>
    <!-- insert html here -->
    <div class="no-receipt error-messages">
        <p>Your receipt cannot be displayed because the total cost of items you bought is less than 10. We apologize.</p>
    </div>
    <!-- if subtotal is more than 10 -->
    <?php
        } else {
            $personInfo = $output["person_info"];
            // CHARM DO NOT FORGET TO PUT THE DOLLARS coz it caused you your grade. okay?
    ?>
    <!-- insert html here -->
    <h3 class="pad-20-vertical">Customer Receipt</h3>
    <section class="user-info pad-20-vertical">
        <div class="person-info">
            <ul>
                <li><b>Sold to:</b> <?php echo $personInfo["uname"]; ?></li>
                <li><b>Email:</b> <?php echo $personInfo["uemail"]; ?></li>
                <li><b>Phone:</b> <?php echo $personInfo["uphone"]; ?></li>
                <li><b>Address:</b> <?php echo "{$personInfo["uaddress"]}, {$personInfo["ucity"]}, {$personInfo["uprovince"]}, {$personInfo["upostcode"]}";?></li>  
            </ul>
        </div>
        <div class="credit-info">
            <ul>
                <li><b>Credit Number:</b> <?php echo $personInfo["ucred_num"];?></li>
                <li><b>Credit Expiry:</b> <?php echo "{$personInfo["ucred_month"]}/{$personInfo["ucred_year"]}"; ?></li>
            </ul>
        </div>
    </section>

    <section class="products">
        <div class="table-list">
            <table class="product-list">
                <tr>
                <th class="table-padding">Quantity</th>
                    <th class="table-padding">Description</th>
                    <th class="table-padding">Unit Price</th>
                    <th class="table-padding">Total</th>
                </tr>
                <!-- insert php for loop here for tables -->
                <?php
                    $productInfo = $output["product_info"];
                    $products = $productInfo["products"];
                    foreach ($products as $row) {
                ?>
                    <tbody>
                    <td class="table-padding align-center"><?php echo $row["qty"];?></td>
                        <td class="table-padding"><?php echo $row["name"];?></td>
                        <td class="table-padding align-right">$<?php echo $row["unit_price"];?></td>
                        <td class="table-padding align-right">$<?php echo number_format($row["price"],2);?></td>
                    </tbody>
                <?php
                    }
                ?>
                <!-- end of for loop tables -->
            </table>
        </div>
    
        <div class="total pad-20-vertical">
        <!-- try to align this on the right -->
            <table>
                <tr>
                    <td class="table-padding bold">Subtotal:</td>
                    <td class="table-padding align-right">$<?php echo number_format($productInfo["subtotal"],2);?></td>
                </tr>
                <tr>
                    <td class="table-padding bold">Sales Tax (<?php echo $productInfo["tax_rate"]*100;?>%):</td>
                    <td class="table-padding align-right">$<?php echo number_format($productInfo["sales_tax"],2);?></td>
                </tr>
                <tr>
                    <td class="table-padding bold">Grand Total:</td>
                    <td class="table-padding align-center bigger bold">$<?php echo number_format($productInfo["total"],2);?></td>
                </tr>
            </table>
        </div>
    </section>
    <p class="end-tag"> Thank you for shopping with us. Hope to see you soon!</p>
    <!-- end tag for else -->
    <?php 
        }
    ?>
</div>
