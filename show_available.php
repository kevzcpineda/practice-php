<?php
    include("connect.php");

    $product = $_POST['id'];
    $sql = "SELECT * FROM student WHERE id = '$product'";
    $prepareStatement = $con->prepare($sql);
    $result = $prepareStatement->execute();
    $students = $prepareStatement->fetch();

    echo number_format($students['stock'])
?>


