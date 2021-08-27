<?php
    include("connect.php");
    $deleteUser = "DELETE FROM `student` WHERE id=". $_GET["id"];
    $prepareStatement = $con->prepare($deleteUser);
    $result = $prepareStatement->execute();

    if($result){
        header("location: index.php");
    }

?>