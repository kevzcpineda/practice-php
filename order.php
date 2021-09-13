
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
    $stock = $users['stock'];
    $sub = $stock - $quantity;

    if(isset($_POST['order'])){
            
            

            echo "<pre>";            
            print_r($users['stock']);            
            echo "</pre>";
            if($quantity>$stock){
                
            header("Location: sales.php?error=highQuantity" );
            exit();
                
            }else{
                $update_product = "UPDATE `student` SET `stock` = '$sub' WHERE product='$product'";
                $prepareStatement = $con->prepare($update_product);
                $result = $prepareStatement->execute();
            

                $add_record = "INSERT INTO `sale_record`(`id`, `product_name`, `price`,`quantity`,`total`,`date`) VALUES (null,'$product','$price','$quantity','$total','$date')";
                $prepareStatement = $con->prepare($add_record);
                $results = $prepareStatement->execute();
            }
       
           


            
           

            if($results){
                header("Location: index.php" );
            }
            else{
                echo "Failed to save";
            }



        }


?>
