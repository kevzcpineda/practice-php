<?php
    include("connect.php");
    $id = $_POST['quantityId'];

    $edit_user = "SELECT * FROM `student` WHERE id = '$id'";
    $prepareStatement = $con->prepare($edit_user);
    $result = $prepareStatement->execute();
    $user = $prepareStatement->fetch();

    echo "<pre>";
    print_r($user);
    echo "</pre>";


    
    if(isset($_POST['add_quan_btn'])){
        
        
        $quantity = $_POST['quantity'];   
        $quantity =  $quantity+$user['stock'];
        
        $sql = "UPDATE `student` SET `stock`='$quantity' WHERE id= $id";
        $prepareStatement = $con->prepare($sql);
        $result = $prepareStatement->execute();
        

        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";

        if($result){
            header("Location: index.php" );
        }
        else{
            echo "Failed to save";
        }



    }
    


?>
