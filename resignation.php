<?php
    include("connect.php");
    $firstName = $_POST['first'];
    
    $lastName = $_POST['last'];
   
    $email = $_POST['email'];

    if(isset($_POST['add'])){
        $sql = "INSERT INTO `student`(`firstname`, `lastname`, `email`) VALUES ('$firstName','$lastName','$email')";
    $prepareStatement = $con->prepare($sql);
    $result = $prepareStatement->execute();

    }
    
    

?>