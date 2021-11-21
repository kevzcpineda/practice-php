<?php
    include("mysqli.php");

    $total_products = 0;
    $total_orders = 0;
    $low_stocks = 0;
    $out_of_stocks = 0;

    $total_products_sql = "SELECT * FROM student";
    $result = $con->query($total_products_sql);

    while($row = $result->fetch_assoc()) {
        $total_products = $total_products + 1;
    }
    $data["total_products"] = $total_products;

    $total_order_sql = "SELECT * FROM order_table";
    $result = $con->query($total_order_sql);

    while($row = $result->fetch_assoc()) {
        $total_orders = $total_orders + 1;
    }
    $data["total_orders"] = $total_orders;

    $out_of_stock_sql = "SELECT * FROM student WHERE stock = '0.00'";
    $result = $con->query($out_of_stock_sql);

    while($row = $result->fetch_assoc()) {
        $out_of_stocks = $out_of_stocks + 1;
    }
    $data["out_of_stocks"] = $out_of_stocks;


    echo json_encode($data);
?>