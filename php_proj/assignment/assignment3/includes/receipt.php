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
    <div class="no-receipt">
        <h3>Your receipt cannot be displayed because the total cost of items you bought is less than 10. We apologize.</h3>
    </div>
    <!-- if subtotal is more than 10 -->
    <?php
        } else {
            $personInfo = $output["person_info"];
            // CHARM DO NOT FORGET TO PUT THE DOLLARS coz it caused you your grade. okay?
    ?>
    <!-- insert html here -->
    <section class="user-info">
        <div class="person-info">
            <ul>
                <li>Sold to: <?php echo $personInfo["uname"]; ?></li>
                <li>Email: <?php echo $personInfo["uemail"]; ?></li>
                <li>Phone: <?php echo $personInfo["uphone"]; ?></li>
                <li>Address: <?php echo "{$personInfo["uaddress"]}, {$personInfo["ucity"]}, {$personInfo["uprovince"]}, {$personInfo["upostcode"]}";?></li>  
            </ul>
        </div>
        <div class="credit-info">
            <ul>
                <li>Number: <?php echo $personInfo["ucred_num"];?></li>
                <li>Expiry: <?php echo "{$personInfo["ucred_month"]}/{$personInfo["ucred_year"]}"; ?></li>
            </ul>
        </div>
    </section>
    <table class="product-info">
        <tr>
            <th>Product Name</th>
            <th>Unit Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
        <!-- insert php for loop here for tables -->
        <?php
        $productInfo = $output["product_info"];
        $products = $productInfo["products"];
        foreach ($products as $row) {
        ?>
            <tr>
                <td><?php echo $row["name"];?></td>
                <td>$<?php echo $row["unit_price"];?></td>
                <td><?php echo $row["qty"];?></td>
                <td>$<?php echo $row["price"];?></td>
            </tr>
        <?php
        }
        ?>
        <!-- end of for loop tables -->
    </table>
    <section class="total">
    <!-- try to align this on the right -->
        <ul>
            <li>Subtotal: $<?php echo $productInfo["subtotal"];?></li>
            <li>Sales Tax: (<?php echo $productInfo["tax_rate"];?>%): $<?php echo $productInfo["sales_tax"];?></li>
            <li>Grand Total: $<?php echo $productInfo["total"];?></li>
        </ul>
    </section>
    <!-- end tag for else -->
    <?php 
        }
    ?>
</div>
