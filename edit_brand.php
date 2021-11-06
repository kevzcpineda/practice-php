<?php
    include("connect.php");

    if(isset($_POST['edit'])){
        $id = $_POST['editId'];
        $brand = $_POST['edit_brand'];            

        $sql = "UPDATE `brand_table` SET 
        `brand_name`='$brand'
        WHERE id= $id";
        $prepareStatement = $con->prepare($sql);
        $result = $prepareStatement->execute();
    
        if($result){
            header("Location: brand.php" );
        }
        else{
            echo "Failed to save";
        }
    }
?>