<?php
    include("connect.php");
    $id = $_POST['quantityId'];

    $edit_user = "SELECT * FROM `student` WHERE id = '$id'";
    $prepareStatement = $con->prepare($edit_user);
    $result = $prepareStatement->execute();
    $user = $prepareStatement->fetch();

    


    
    if(isset($_POST['add_quan_btn'])){
        
        
        $user_quantity = $_POST['quantity'];   
        $quantity =  $user_quantity + $user['stock'];
        
        $sql = "UPDATE `student` SET `stock`='$quantity' WHERE id= $id";
        $prepareStatement = $con->prepare($sql);
        $result = $prepareStatement->execute();

        $product_name = $user['product'];
        $categoty = $user['category'];
        $brand = $user['brand'];
        $total_listing_price = $user_quantity * $user['listing_price'];
        $date = date('Y-m-d');

        $add_quantity = "INSERT INTO `add_quantity`(`id`, `product`, `category`, `brand_name`, `quantity`, `total_listing_price`, `date`) VALUES (null,'$product_name','$categoty','$brand','$user_quantity','$total_listing_price','$date')";
        $prepareStatement_ = $con->prepare($add_quantity);
        $result_ = $prepareStatement_->execute();
        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";

        if($result){
            header("Location: product.php" );
        }
        else{
            echo "Failed to save";
        }



    }
    


?>
