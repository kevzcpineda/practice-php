<?php
    include("connect.php");

    $product = $_POST['id'];
    $sql = "SELECT * FROM student WHERE product = '$product'";
    $prepareStatement = $con->prepare($sql);
    $result = $prepareStatement->execute();
    $students = $prepareStatement->fetch();


?>

<span><?php echo number_format($students['stock'])?></span>
