<?php 
    include("connect.php");
    $product = $_POST['product'];  

    $selectUsers = "SELECT * FROM student WHERE product='$product'";
    $prepareStatement = $con->prepare($selectUsers);
    $result = $prepareStatement->execute();
    $users = $prepareStatement->fetch();

    
    
    $price = $users['retail_price'];
    $quantity = $_POST['quantity'];
    $total = $quantity * $price;
    $date = date('Y-m-d');

    if(isset($_POST['order'])){
            echo "<pre>";
            print_r($date);
            echo "</pre>";
            

            $add_record = "INSERT INTO `sale_record`(`id`, `product_name`, `price`,`quantity`,`total`,`date`) VALUES (null,'$product','$price','$quantity','$total','$date')";
            $prepareStatement = $con->prepare($add_record);
            $result = $prepareStatement->execute();

            $stock = $quantity - $users['stock'];
            $update_product = "UPDATE `student` SET `stock` = '$stock' WHERE product='$product'";
            $prepareStatement = $con->prepare($update_product);
            $result = $prepareStatement->execute();

            if($result){
                header("Location: index.php" );
            }
            else{
                echo "Failed to save";
            }



        }


?>