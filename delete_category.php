<?php
    include("connect.php");

    if(isset($_POST['deletedata'])){

        $id = $_POST['deleteId'];
        $deleteUser = "DELETE FROM `category_table` WHERE id='$id'";
        $prepareStatement = $con->prepare($deleteUser);
        $result = $prepareStatement->execute();

        if($result){
            header("Location: category.php" );
        }
    }
?>