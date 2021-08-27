<?php
    try{
        $dbh="mysql:host=localhost;dbname=student_info";
        $username = "root";
        $password = "";

        $con = new PDO($dbh,$username,$password);

    }catch(PDOException $e){
        echo $e.getMessage();
    }



?>