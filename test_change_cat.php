<?php
    include("mysqli.php");
    $year_now = $_POST['value'];
    $selected_category = $_POST['selected_category'];
    $data["year_now"] = $year_now;

    $october_capital_sql = "SELECT * FROM add_quantity WHERE date>='".$year_now."-10-01' AND date<='".$year_now."-10-31' AND category='$selected_category'";

    $october_sale_sql = "SELECT * FROM sale_record WHERE date>='".$year_now."-10-01' AND date<='".$year_now."-10-31' AND category='$selected_category'";

    $october_capital = 0;
    $october_sold = 0;
    $october_revenue = 0;
    
    $october_capital_records = $con->query($october_capital_sql);
    while($row = $october_capital_records->fetch_assoc()) {
        $october_capital = $october_capital + $row['total_listing_price'];
    }
    $october_sale_records = $con->query($october_sale_sql);
    while($row = $october_sale_records->fetch_assoc()) {
        $october_sold = $october_sold + $row['total'];
    }
    $october_revenue = $october_sold - $october_capital;

    $data["october_capital"] = $october_capital;
    $data["october_sold"] = $october_sold;
    $data["october_revenue"] = $october_revenue;
    // -------------------november----------------
    $november_capital_sql = "SELECT * FROM add_quantity WHERE date>='".$year_now."-11-01' AND date<='".$year_now."-11-31' AND category='$selected_category'";

    $november_sale_sql = "SELECT * FROM sale_record WHERE date>='".$year_now."-11-01' AND date<='".$year_now."-11-31' AND category='$selected_category'";

    $november_capital = 0;
    $november_sold = 0;
    $november_revenue = 0;

    $november_capital_records = $con->query($november_capital_sql);
    while($row = $november_capital_records->fetch_assoc()) {
        $november_capital = $november_capital + $row['total_listing_price'];
    }
    $november_sale_records = $con->query($november_sale_sql);
    while($row = $november_sale_records->fetch_assoc()) {
        $november_sold = $november_sold + $row['total'];
    }
    $november_revenue = $november_sold - $november_capital;

    $data["november_capital"] = $november_capital;
    $data["november_sold"] = $november_sold;
    $data["november_revenue"] = $november_revenue;

    echo json_encode($data);
?>