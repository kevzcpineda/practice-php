<?php
    $username = "root";
    $password = "fx4cst";
    $db = "fx4_db";
    $dsn ="/cloudsql/inventory-333214:asia-southeast1:inventoryapp";
    // $dsn ="34.124.166.104";
    $con = mysqli_connect(null,$username,$password,$db,null,$dsn);

    echo"kevin";
?>