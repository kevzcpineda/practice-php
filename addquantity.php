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

        $product_id = $user['id'];
        $product_name = $user['product'];
        $categoty = $user['category'];
        $brand = $user['brand'];
        $listing_price = $user['listing_price'];
        $total_listing_price = $user_quantity * $listing_price;
        $date = date('Y-m-d');

        $add_quantity = "INSERT INTO `add_quantity`(`id`,`product_id`,`product`, `category`, `brand_name`, `quantity`,`listing_price`,`total_listing_price`, `date`) VALUES (null,'$product_id','$product_name','$categoty','$brand','$user_quantity','$listing_price','$total_listing_price','$date')";
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
