<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "student_info";
    $con = new mysqli($servername,$username,$password,$db);
    if(isset($_POST['product'])){
        $error_msg = "";
        $name_error = false;
        $order_error = false;
        $count = $_POST['count'];
        $customer_name = $_POST['customer_name'];
        $product = $_POST['product'];
        $brand = $_POST['brand'];
        $category = $_POST['category'];
        $item_category = $_POST['item_category'];
        $retail_price = $_POST['retail_price'];
        $quantity = $_POST['quantity'];
        $listing_price = $_POST['listing_price'];
        $total = $_POST['total'];
        $unit = $_POST['unit'];
        $date = date('Y-m-d');
        $total_order = $_POST['total_order'];

            $order_sql = "INSERT INTO `order_table`(`id`, `customer_name`,`total`,`date`) VALUES (null,'$customer_name','$total_order','$date')";
            $result = $con->query($order_sql);

            $order_id = $con->insert_id;

            foreach($product as $index => $products){
                $selectUsers = "SELECT * FROM student WHERE product='$products'";
                $users = $con->query($selectUsers);
                $row = $users->fetch_assoc();
                $sub = $row['stock'] - $quantity[$index];

                $update_product = "UPDATE `student` SET `stock` = '$sub' WHERE product='$products'";
                $prepareStatement = $con->query($update_product);

                $new_brand = $brand[$index];
                $new_category = $category[$index];
                $new_item_category = $item_category[$index];
                $new_retail_price = $retail_price[$index];
                $new_quantity = $quantity[$index];
                $new_listing_price = $listing_price[$index];
                $new_total = $total[$index];
                $new_unit = $unit[$index];

                $add_record = "INSERT INTO `sale_record`(`id`,`product_id`,`product_name`,`brand`,`category`,`item_category`,`price`,`quantity`,`total_listing_price`,`total`,`date`,`unit`) VALUES (null,'$order_id ','$products','$new_brand','$new_category','$new_item_category','$new_retail_price','$new_quantity','$new_listing_price','$new_total','$date','$new_unit')";
                $prepareStatements = $con->query($add_record);
                
                
            
        }
    }
?>