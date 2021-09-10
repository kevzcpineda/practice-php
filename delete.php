<?php
    include("connect.php");

    if(isset($_POST['deletedata'])){

        $id = $_POST['deleteId'];
        $deleteUser = "DELETE FROM `student` WHERE id='$id'";
        $prepareStatement = $con->prepare($deleteUser);
        $result = $prepareStatement->execute();

        if($result){
            echo "<script> alert('deleted'); </script>";
            header("location: index.php");
        }
    }
   

?>