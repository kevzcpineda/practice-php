<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit</title>
</head>
<body> -->
    <?php
        include("connect.php");
            

            // $edit_user = "SELECT * FROM `student` WHERE id = '$id'";
            // $prepareStatement = $con->prepare($edit_user);
            // $result = $prepareStatement->execute();
            // $user = $prepareStatement->fetch();

        

        if(isset($_POST['edit'])){
            $id = $_POST['editId'];
            $product = $_POST['product'];            
            $category = $_POST['category'];            
            $brand = $_POST['brand'];            
            $listing_price = $_POST['listing_price'];
            $retail_price = $_POST['retail_price'];
            

            

            $sql = "UPDATE `student` SET 
            `product`='$product',
            `category`='$category',
            `brand`='$brand',
            `listing_price`='$listing_price',
            `retail_price`='$retail_price' WHERE id= $id";
            $prepareStatement = $con->prepare($sql);
            $result = $prepareStatement->execute();
            

            echo "<pre>";
            print_r($user);
            echo "</pre>";

            if($result){
                header("location: product.php");
            }
            else{
                echo "Failed to save";
            }



        }
        

    
    ?>
       <!-- <form method="POST">
        <h1>edit</h1>
        <label >firstname</label>
        <input type="text" name="firstname"valu ><br>
        <label >lastname</label>
        <input type="text" name="lastname" value=""><br>
        <label >email</label>
        <input type="email" name="email" value=""><br>
        <button type = "submit" name="edit">edit</button>

    </form>
    
</body>
</html> -->