<?php
    try{
        $dbh="mysql:host=localhost;dbname=student_info";
        $username = "root";
        $password = "";

        $con = new PDO($dbh,$username,$password);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }catch(PDOException $e){
        echo $e.getMessage();
    }



?>