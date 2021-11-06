<?php
    include("connect.php");
    if(isset($_POST['add_btn'])){
        $category = trim($_POST['category']);  

        $add_user = "INSERT INTO `category_table`(`id`, `category`) VALUES (null,'$category')";
        $prepareStatement = $con->prepare($add_user);
        $result = $prepareStatement->execute();
        if($result){
            header("Location: category.php" );
            }
}
?>