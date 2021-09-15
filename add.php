
<?php
    include("connect.php");

    // echo "<pre><br>";
    // print_r($result);
    // echo "</pre>";

    if(isset($_POST['add'])){

        $product = $_POST['product'];            
        $listing_price = floatval($_POST['listing_price']);
        $retail_price = floatval($_POST['retail_price']);
        $quantity = $_POST['quantity'];

        $add_user = "INSERT INTO `student`(`id`, `product`, `listing_price`,`retail_price`,`stock`) VALUES (null,'$product','$listing_price','$retail_price','$quantity')";
        $prepareStatement = $con->prepare($add_user);
        $result = $prepareStatement->execute();

        
        if($result){
        header("Location: index.php" );
        }
        else{
            echo "Failed to save";
        }


    }
    


?>


