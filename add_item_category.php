<?php
    include("connect.php");
    if(isset($_POST['add_btn'])){
        $item_category = trim($_POST['item_category']);  

        $add_user = "INSERT INTO `item_category`(`id`, `item_category`) VALUES (null,'$item_category')";
        $prepareStatement = $con->prepare($add_user);
        $result = $prepareStatement->execute();
        if($result){
            header("Location: item_category.php" );
            }
}
?>