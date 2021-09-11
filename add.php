<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add</title>
</head>
<body>
    <?php
        include("connect.php");

        echo "<pre><br>";
        print_r($result);
        echo "</pre>";

        if(isset($_POST['add'])){

            $product = $_POST['product'];            
            $listing_price = $_POST['listing_price'];
            $retail_price = $_POST['retail_price'];

            $add_user = "INSERT INTO `student`(`id`, `product`, `listing_price`,`retail_price`) VALUES (null,'$product','$listing_price','$retail_price')";
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
  
    
</body>
</html>