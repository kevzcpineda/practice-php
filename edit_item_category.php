<?php
    include("connect.php");

    if(isset($_POST['edit'])){
        $id = $_POST['editId'];
        $category = $_POST['edit_category'];            

        $sql = "UPDATE `item_category` SET 
        `item_category`='$category'
        WHERE id= $id";
        $prepareStatement = $con->prepare($sql);
        $result = $prepareStatement->execute();
    
        if($result){
            header("Location: item_category.php" );
        }
        else{
            echo "Failed to save";
        }
    }
?>