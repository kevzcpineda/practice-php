<?php
    include("connect.php");

    if(isset($_POST['edit'])){
        $id = $_POST['editId'];
        $category = $_POST['edit_category'];            

        $sql = "UPDATE `category_table` SET 
        `category`='$category'
        WHERE id= $id";
        $prepareStatement = $con->prepare($sql);
        $result = $prepareStatement->execute();
    
        if($result){
            header("Location: index.php" );
        }
        else{
            echo "Failed to save";
        }
    }
?>