<?php
    include("connect.php");
    $firstName = $_POST['first'];
    $middleName = $_POST['middle'];
    $lastName = $_POST['last'];
    $date = $_POST['date'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    if(isset($_POST['add'])){
        $sql = "INSERT INTO `student`(`firstname`, `middlename`, `lastname`, `birthday`, `gender`, `email`) VALUES ('$firstName','$middleName','$lastName','$date','$gender','$email')";
    $prepareStatement = $con->prepare($sql);
    $result = $prepareStatement->execute();

    }
    
    

?>