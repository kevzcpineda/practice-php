<?php
    include("mysqli.php");

    $product_categorys = array();
    
    $sql = "SELECT * FROM category_table";
    $result = $con->query($sql);

    $date = date('Y-m-d');
    while($row = $result->fetch_assoc()) {
        array_push($product_categorys,$row['category']);
    }
    // echo print_r($product_categorys[1]);
    foreach ($product_categorys as $index => $product_category){
        
        $sql = "SELECT * FROM student WHERE category = '$product_category'";
        $result_product = $con->query($sql);
        $ending_inventory = 0;
        while($row = $result_product->fetch_assoc()){
            
            $ending_inventory = $ending_inventory + ($row['listing_price'] * $row['stock']);
        }
        echo $ending_inventory;
        $ending_inventory_sql = "INSERT INTO `ending_inventory`(`id`, `product_category`,`ending_inventory`,`date`) VALUES (null,'$product_category','$ending_inventory','$date')";
        $prepareStatements = $con->query($ending_inventory_sql);
    }
?>