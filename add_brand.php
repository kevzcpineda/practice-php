<?php
    include("connect.php");
    if(isset($_POST['add_btn'])){
        $brand = trim($_POST['brand']);  

        $add_user = "INSERT INTO `brand_table`(`id`, `brand_name`) VALUES (null,'$brand')";
        $prepareStatement = $con->prepare($add_user);
        $result = $prepareStatement->execute();
        if($result){
            header("Location: brand.php" );
            }
}
?>