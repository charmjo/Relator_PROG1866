<?php

class Orders {
    public function getOrdersList () {
        $conn = new Database ();
        $conn->connectDb();
        $sqlQuery = "SELECT * FROM `orders`";

        $conn->retrieveDataList($sqlQuery);
    }

    // TODO: postOrder
    public function postOrder ($order) {
        // ,$_province,$yarn_qty, $_needle_qty
        // only escape name, there's no way yarn_qty and needle_qty will be infected because I restricted the inputs to number;

        $conn = new Database ();
        $conn->connectDb();

        //  To prepared statements or to escape strings?
        // https://www.w3schools.com/php/php_mysql_prepared_statements.asp
        // https://stackoverflow.com/questions/15786295/should-i-use-mysqli-real-escape-string-or-should-i-use-prepared-statements
        // [ ]: convert the whole query to prepared statements

        // TODO: add order - add action

        $escapedName = $conn->dbConn->real_escape_string($order['ordered_by']);
        $escapedEmail = $conn->dbConn->real_escape_string($order['email']);
        $escapedPhone = $conn->dbConn->real_escape_string($order['phone']);
        $escapedPostcode = $conn->dbConn->real_escape_string($order['postcode']);
        $escapedAddress = $conn->dbConn->real_escape_string($order['address']);
        $escapedCity = $conn->dbConn->real_escape_string($order['city']);
        $escapedProvince = $conn->dbConn->real_escape_string($order['province']);
        $escapedCredNum = $conn->dbConn->real_escape_string($order['cred_num']);
        $escapedMonth = $conn->dbConn->real_escape_string($order['cred_month']);
        $escapedYear = $conn->dbConn->real_escape_string($order['cred_year']);

        // https://alvinalexander.com/php/php-date-formatted-sql-timestamp-insert/
        $timestamp = date('Y-m-d H:i:s');
        $sqlQuery = "INSERT INTO `orders` (`ordered_by`
                                ,`email`
                                ,`phone`
                                ,`postcode`
                                ,`address`
                                ,`city`
                                ,`province`
                                ,`credit_num`
                                ,`credit_month`
                                ,`credit_year`
                                ,`subtotal`
                                ,`sales_tax`
                                ,`grand_total`
                                ,`order_date`) 
                            VALUES ('$escapedName'
                                ,'$escapedEmail'
                                ,'$escapedPhone'
                                ,'$escapedPostcode'
                                ,'$escapedAddress'
                                ,'$escapedCity'
                                ,'$escapedProvince'
                                ,'$escapedCredNum'
                                ,'$escapedMonth'
                                ,'$escapedYear'
                                ,'".$order['subtotal']."'
                                ,'".$order['sales_tax']."'
                                ,'".$order['grand_total']."'
                                ,'$timestamp')";
        $sqlResult = $conn->dbConn->query($sqlQuery);
        if (!$sqlResult) {
            return ["error",$conn->dbConn->error];
        } 
        return [];

        $conn->closeConnection();
    }

    // TODO: Fix order
    public function processOrder ($_formData) {
        $order = $this->processProducts($_formData['yarn_qty'],$_formData['needle_qty'],$_formData['province']);
        $order['ordered_by'] = $_formData['name'];
        $order['province'] = $_formData['province'];
        $order['email'] = $_formData['email'];
        $order['phone'] = $_formData['phone'];
        $order['postcode'] = $_formData['postcode'];
        $order['address'] = $_formData['address'];
        $order['city'] = $_formData['city'];
        $order['province'] = $_formData['province'];
        $order['cred_num'] = $_formData['cred_num'];
        $order['cred_month'] = $_formData['cred_month'];
        $order['cred_year'] = $_formData['cred_year'];

        // put the order into the database
        $result = $this->postOrder($order);
        if (in_array("error",$result)) {
            return $result;
        } 

        return ["success",$order];
    }
 //   $result = $order->processOrder($name,$yarnQty,$needleQty,$province);
    public function processProducts ($yarn_qty,$needle_qty,$province) {
        $products = $this->setProductList($yarn_qty,$needle_qty);
        $prodsWithSubtotal = $this->calcPrice($products);
        $productsWithTax = $this->calcTax($prodsWithSubtotal,$province);

        return $productsWithTax;
    }

    protected function setProductList($yarn_qty,$needle_qty) {
        return [[
            "id" => "yarn",
            "name" => "Yarn",
            "qty" => $yarn_qty,
            "unit_price" => 2.00,
            "total_price" => 0.00,
        ],[
            "id" => "needle",
            "name" => "Knitting Needles",
            "qty" => $needle_qty,
            "unit_price" => 3.75,
            "total_price" => 0.00,
        ]];
    }

    protected function calcPrice ($prods) {
        $index = 0;
        $subtotal = 0.00;
    
        foreach ($prods as $product) {
            $price = 0.00;
            $price = $product["qty"] * $product["unit_price"];
            $prods[$index]["total_price"] = $price;
    
            $subtotal += $prods[$index]["total_price"];
    
            $index++;
        }
    
        $productsWithSubtotal["products"] = $prods;
        $productsWithSubtotal["subtotal"] = $subtotal;
    
        return $productsWithSubtotal;
    }

    private function calcTax ($prods, $provAbbr) {
        // get the tax value
        if(!$this->getProvince($provAbbr)){
            return false;
        }
        $province = $this->getProvince($provAbbr);

        $taxRate = $province["tax_percent"];
        $salesTax = $taxRate * $prods["subtotal"];
        $newTotal = $salesTax + $prods["subtotal"];
    
        $prods["tax_rate"] = $taxRate;
        $prods["sales_tax"] = $salesTax;
        $prods["grand_total"] = $newTotal;
    
        return $prods;
    }

    private function getProvince ($provAbbr) {
        foreach (PROVINCES as $province) {
            if ($province["abbr"] == $provAbbr) return $province;
        }
        return false;
    }
    
}