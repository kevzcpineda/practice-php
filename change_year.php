<?php
    include("connect.php");
    $product_sql = "SELECT * FROM student";
    $prepareStatement = $con->prepare($product_sql);
    $product_result = $prepareStatement->execute();
    $proucts = $prepareStatement->fetchAll();

    $sales_sql = "SELECT * FROM sale_record";
    $prepareStatement = $con->prepare($sales_sql);
    $sales_result = $prepareStatement->execute();
    $sale_records = $prepareStatement->fetchAll();

    $category_sql = "SELECT * FROM category_table";
    $prepareStatement = $con->prepare($category_sql);
    $category_result = $prepareStatement->execute();
    $categorys_records = $prepareStatement->fetchAll();
    
    $year_now = $_POST['value'];

    $number_of_category = 0;
    $total_product = 0;
    
    $total_listing = 0;
    $capital = 0;
    $total_capital = 0;
    $total_sold = 0;
    $total_revenue = 0;

    foreach ($categorys_records as $categorys_record){
        $number_of_category = $number_of_category + 1;
    }

    //total product
    foreach ($proucts as $index => $prouct){
        $total_product+=1;
    }

    // stock total capital
    foreach ($proucts as $prouct){
        $total_capital = $total_capital + ($prouct['listing_price'] * $prouct['stock']);
    }
    // sales total capital
    foreach ($sale_records as $sale_record){
        $total_listing = $total_listing + ($sale_record['total_listing_price'] * $sale_record['quantity']);
    }
    // total capital
    $capital = $total_capital + $total_listing;

    // total sold items
    foreach ($sale_records as $sale_record){
        $total_sold = $total_sold + $sale_record['total'];
    }
    // total revenue
    $total_revenue = $total_sold - $capital;

    // -------------------monthly sales report for january----------------
    $monthly_capital_sql = "SELECT * FROM add_quantity WHERE date>='".$year_now."-01-01' AND date<='".$year_now."-01-31'";
    $prepareStatement = $con->prepare($monthly_capital_sql);
    $monthly_capital_result = $prepareStatement->execute();
    $monthly_capital_records = $prepareStatement->fetchAll();

    $monthly_sale_sql = "SELECT * FROM sale_record WHERE date>='".$year_now."-01-01' AND date<='".$year_now."-01-31'";
    $prepareStatement = $con->prepare($monthly_sale_sql);
    $monthly_sales_result = $prepareStatement->execute();
    $monthly_sale_records = $prepareStatement->fetchAll();
    
    $january_capital = 0;
    $january_sold = 0;
    $january_revenue = 0;
    
    foreach ($monthly_capital_records as $monthly_capital_record){
        $january_capital = $january_capital + $monthly_capital_record['total_listing_price'];
    }
    foreach ($monthly_sale_records as $monthly_sale_record){
        $january_sold = $january_sold + $monthly_sale_record['total'];
    }
    $january_revenue = $january_sold - $january_capital;
    
    $data["january_capital"] = $january_capital;
    $data["january_sold"] = $january_sold;
    $data["january_revenue"] = $january_revenue;
    // -------------------monthly sales report for feb----------------
    $monthly_capital_sql = "SELECT * FROM add_quantity WHERE date>='".$year_now."-02-01' AND date<='".$year_now."-02-31'";
    $prepareStatement = $con->prepare($monthly_capital_sql);
    $monthly_capital_result = $prepareStatement->execute();
    $monthly_capital_records = $prepareStatement->fetchAll();

    $monthly_sale_sql = "SELECT * FROM sale_record WHERE date>='".$year_now."-02-01' AND date<='".$year_now."-02-31'";
    $prepareStatement = $con->prepare($monthly_sale_sql);
    $monthly_sales_result = $prepareStatement->execute();
    $monthly_sale_records = $prepareStatement->fetchAll();
    
    $feb_capital = 0;
    $feb_sold = 0;
    $feb_revenue = 0;
    
    foreach ($monthly_capital_records as $monthly_capital_record){
        $feb_capital = $feb_capital + $monthly_capital_record['total_listing_price'];
    }
    foreach ($monthly_sale_records as $monthly_sale_record){
        $feb_sold = $feb_sold + $monthly_sale_record['total'];
    }
    $feb_revenue = $feb_sold - $january_capital;
    
    $data["feb_capital"] = $feb_capital;
    $data["feb_sold"] = $feb_sold;
    $data["feb_revenue"] = $feb_revenue;
    // -------------------monthly sales report for march----------------
    $monthly_capital_sql = "SELECT * FROM add_quantity WHERE date>='".$year_now."-03-01' AND date<='".$year_now."-03-31'";
    $prepareStatement = $con->prepare($monthly_capital_sql);
    $monthly_capital_result = $prepareStatement->execute();
    $monthly_capital_records = $prepareStatement->fetchAll();

    $monthly_sale_sql = "SELECT * FROM sale_record WHERE date>='".$year_now."-03-01' AND date<='".$year_now."-03-31'";
    $prepareStatement = $con->prepare($monthly_sale_sql);
    $monthly_sales_result = $prepareStatement->execute();
    $monthly_sale_records = $prepareStatement->fetchAll();
    
    $march_capital = 0;
    $march_sold = 0;
    $march_revenue = 0;
    
    foreach ($monthly_capital_records as $monthly_capital_record){
        $march_capital = $march_capital + $monthly_capital_record['total_listing_price'];
    }
    foreach ($monthly_sale_records as $monthly_sale_record){
        $march_sold = $march_sold + $monthly_sale_record['total'];
    }
    $march_revenue = $march_sold - $march_capital;
    
    $data["march_capital"] = $march_capital;
    $data["march_sold"] = $march_sold;
    $data["march_revenue"] = $march_revenue;
    // -------------------monthly sales report for april----------------
    $monthly_capital_sql = "SELECT * FROM add_quantity WHERE date>='".$year_now."-04-01' AND date<='".$year_now."-04-31'";
    $prepareStatement = $con->prepare($monthly_capital_sql);
    $monthly_capital_result = $prepareStatement->execute();
    $monthly_capital_records = $prepareStatement->fetchAll();

    $monthly_sale_sql = "SELECT * FROM sale_record WHERE date>='".$year_now."-04-01' AND date<='".$year_now."-04-31'";
    $prepareStatement = $con->prepare($monthly_sale_sql);
    $monthly_sales_result = $prepareStatement->execute();
    $monthly_sale_records = $prepareStatement->fetchAll();
    
    $april_capital = 0;
    $april_sold = 0;
    $april_revenue = 0;
    
    foreach ($monthly_capital_records as $monthly_capital_record){
        $april_capital = $april_capital + $monthly_capital_record['total_listing_price'];
    }
    foreach ($monthly_sale_records as $monthly_sale_record){
        $april_sold = $april_sold + $monthly_sale_record['total'];
    }
    $april_revenue = $april_sold - $april_capital;
    
    $data["april_capital"] = $april_capital;
    $data["april_sold"] = $april_sold;
    $data["april_revenue"] = $april_revenue;
    // -------------------monthly sales report for may----------------
    $monthly_capital_sql = "SELECT * FROM add_quantity WHERE date>='".$year_now."-05-01' AND date<='".$year_now."-05-31'";
    $prepareStatement = $con->prepare($monthly_capital_sql);
    $monthly_capital_result = $prepareStatement->execute();
    $monthly_capital_records = $prepareStatement->fetchAll();

    $monthly_sale_sql = "SELECT * FROM sale_record WHERE date>='".$year_now."-05-01' AND date<='".$year_now."-05-31'";
    $prepareStatement = $con->prepare($monthly_sale_sql);
    $monthly_sales_result = $prepareStatement->execute();
    $monthly_sale_records = $prepareStatement->fetchAll();
    
    $may_capital = 0;
    $may_sold = 0;
    $may_revenue = 0;
    
    foreach ($monthly_capital_records as $monthly_capital_record){
        $may_capital = $may_capital + $monthly_capital_record['total_listing_price'];
    }
    foreach ($monthly_sale_records as $monthly_sale_record){
        $may_sold = $may_sold + $monthly_sale_record['total'];
    }
    $may_revenue = $may_sold - $may_capital;
    
    $data["may_capital"] = $may_capital;
    $data["may_sold"] = $may_sold;
    $data["may_revenue"] = $may_revenue;
    // -------------------monthly sales report for june----------------
    $monthly_capital_sql = "SELECT * FROM add_quantity WHERE date>='".$year_now."-06-01' AND date<='".$year_now."-06-31'";
    $prepareStatement = $con->prepare($monthly_capital_sql);
    $monthly_capital_result = $prepareStatement->execute();
    $monthly_capital_records = $prepareStatement->fetchAll();

    $monthly_sale_sql = "SELECT * FROM sale_record WHERE date>='".$year_now."-06-01' AND date<='".$year_now."-06-31'";
    $prepareStatement = $con->prepare($monthly_sale_sql);
    $monthly_sales_result = $prepareStatement->execute();
    $monthly_sale_records = $prepareStatement->fetchAll();
    
    $june_capital = 0;
    $june_sold = 0;
    $june_revenue = 0;
    
    foreach ($monthly_capital_records as $monthly_capital_record){
        $june_capital = $june_capital + $monthly_capital_record['total_listing_price'];
    }
    foreach ($monthly_sale_records as $monthly_sale_record){
        $june_sold = $june_sold + $monthly_sale_record['total'];
    }
    $june_revenue = $june_sold - $june_capital;
    
    $data["june_capital"] = $june_capital;
    $data["june_sold"] = $june_sold;
    $data["june_revenue"] = $june_revenue;
    // -------------------monthly sales report for july----------------
    $monthly_capital_sql = "SELECT * FROM add_quantity WHERE date>='".$year_now."-07-01' AND date<='".$year_now."-07-31'";
    $prepareStatement = $con->prepare($monthly_capital_sql);
    $monthly_capital_result = $prepareStatement->execute();
    $monthly_capital_records = $prepareStatement->fetchAll();

    $monthly_sale_sql = "SELECT * FROM sale_record WHERE date>='".$year_now."-07-01' AND date<='".$year_now."-07-31'";
    $prepareStatement = $con->prepare($monthly_sale_sql);
    $monthly_sales_result = $prepareStatement->execute();
    $monthly_sale_records = $prepareStatement->fetchAll();
    
    $july_capital = 0;
    $july_sold = 0;
    $july_revenue = 0;
    
    foreach ($monthly_capital_records as $monthly_capital_record){
        $july_capital = $july_capital + $monthly_capital_record['total_listing_price'];
    }
    foreach ($monthly_sale_records as $monthly_sale_record){
        $july_sold = $july_sold + $monthly_sale_record['total'];
    }
    $july_revenue = $july_sold - $july_capital;
    
    $data["july_capital"] = $july_capital;
    $data["july_sold"] = $july_sold;
    $data["july_revenue"] = $july_revenue;
    // -------------------monthly sales report for august----------------
    $monthly_capital_sql = "SELECT * FROM add_quantity WHERE date>='".$year_now."-08-01' AND date<='".$year_now."-08-31'";
    $prepareStatement = $con->prepare($monthly_capital_sql);
    $monthly_capital_result = $prepareStatement->execute();
    $monthly_capital_records = $prepareStatement->fetchAll();

    $monthly_sale_sql = "SELECT * FROM sale_record WHERE date>='".$year_now."-08-01' AND date<='".$year_now."-08-31'";
    $prepareStatement = $con->prepare($monthly_sale_sql);
    $monthly_sales_result = $prepareStatement->execute();
    $monthly_sale_records = $prepareStatement->fetchAll();
    
    $august_capital = 0;
    $agust_sold = 0;
    $august_revenue = 0;
    
    foreach ($monthly_capital_records as $monthly_capital_record){
        $august_capital = $august_capital + $monthly_capital_record['total_listing_price'];
    }
    foreach ($monthly_sale_records as $monthly_sale_record){
        $agust_sold = $agust_sold + $monthly_sale_record['total'];
    }
    $august_revenue = $agust_sold - $august_capital;
    
    $data["august_capital"] = $august_capital;
    $data["agust_sold"] = $agust_sold;
    $data["august_revenue"] = $august_revenue;
    // -------------------monthly sales report for september----------------
    $monthly_capital_sql = "SELECT * FROM add_quantity WHERE date>='".$year_now."-09-01' AND date<='".$year_now."-09-31'";
    $prepareStatement = $con->prepare($monthly_capital_sql);
    $monthly_capital_result = $prepareStatement->execute();
    $monthly_capital_records = $prepareStatement->fetchAll();

    $monthly_sale_sql = "SELECT * FROM sale_record WHERE date>='".$year_now."-09-01' AND date<='".$year_now."-09-31'";
    $prepareStatement = $con->prepare($monthly_sale_sql);
    $monthly_sales_result = $prepareStatement->execute();
    $monthly_sale_records = $prepareStatement->fetchAll();
    
    $september_capital = 0;
    $september_sold = 0;
    $september_revenue = 0;
    
    foreach ($monthly_capital_records as $monthly_capital_record){
        $september_capital = $september_capital + $monthly_capital_record['total_listing_price'];
    }
    foreach ($monthly_sale_records as $monthly_sale_record){
        $september_sold = $september_sold + $monthly_sale_record['total'];
    }
    $september_revenue = $september_sold - $september_capital;
    
    $data["september_capital"] = $september_capital;
    $data["september_sold"] = $september_sold;
    $data["september_revenue"] = $september_revenue;
    // -------------------monthly sales report for october----------------
    $monthly_capital_sql = "SELECT * FROM add_quantity WHERE date>='".$year_now."-10-01' AND date<='".$year_now."-10-31'";
    $prepareStatement = $con->prepare($monthly_capital_sql);
    $monthly_capital_result = $prepareStatement->execute();
    $monthly_capital_records = $prepareStatement->fetchAll();

    $monthly_sale_sql = "SELECT * FROM sale_record WHERE date>='".$year_now."-10-01' AND date<='".$year_now."-10-31'";
    $prepareStatement = $con->prepare($monthly_sale_sql);
    $monthly_sales_result = $prepareStatement->execute();
    $monthly_sale_records = $prepareStatement->fetchAll();
    
    $october_capital = 0;
    $october_sold = 0;
    $october_revenue = 0;
    $october_ending_inventory = 0;

    foreach ($monthly_capital_records as $monthly_capital_record){
        $october_capital = $october_capital + $monthly_capital_record['total_listing_price'];
    }
    foreach ($monthly_sale_records as $monthly_sale_record){
        $october_sold = $october_sold + $monthly_sale_record['total'];
    }
    $october_revenue = $october_sold - $october_capital;
    
    $data["october_capital"] = $october_capital;
    $data["october_sold"] = $october_sold;
    $data["october_revenue"] = $october_revenue;
    // -------------------monthly sales report for november----------------
    $monthly_capital_sql = "SELECT * FROM add_quantity WHERE date>='".$year_now."-11-01' AND date<='".$year_now."-11-31'";
    $prepareStatement = $con->prepare($monthly_capital_sql);
    $monthly_capital_result = $prepareStatement->execute();
    $monthly_capital_records = $prepareStatement->fetchAll();

    $monthly_sale_sql = "SELECT * FROM sale_record WHERE date>='".$year_now."-11-01' AND date<='".$year_now."-11-31'";
    $prepareStatement = $con->prepare($monthly_sale_sql);
    $monthly_sales_result = $prepareStatement->execute();
    $monthly_sale_records = $prepareStatement->fetchAll();
    
    $november_capital = 0;
    $november_sold = 0;
    $november_revenue = 0;
    
    foreach ($monthly_capital_records as $monthly_capital_record){
        $november_capital = $november_capital + $monthly_capital_record['total_listing_price'];
    }
    foreach ($monthly_sale_records as $monthly_sale_record){
        $november_sold = $november_sold + $monthly_sale_record['total'];
    }
    $november_revenue = $november_sold - $november_capital;
    
    $data["november_capital"] = $november_capital;
    $data["november_sold"] = $november_sold;
    $data["november_revenue"] = $november_revenue;
    // -------------------monthly sales report for december----------------
    $monthly_capital_sql = "SELECT * FROM add_quantity WHERE date>='".$year_now."-12-01' AND date<='".$year_now."-12-31'";
    $prepareStatement = $con->prepare($monthly_capital_sql);
    $monthly_capital_result = $prepareStatement->execute();
    $monthly_capital_records = $prepareStatement->fetchAll();

    $monthly_sale_sql = "SELECT * FROM sale_record WHERE date>='".$year_now."-12-01' AND date<='".$year_now."-12-31'";
    $prepareStatement = $con->prepare($monthly_sale_sql);
    $monthly_sales_result = $prepareStatement->execute();
    $monthly_sale_records = $prepareStatement->fetchAll();
    
    $december_capital = 0;
    $december_sold = 0;
    $december_revenue = 0;
    
    foreach ($monthly_capital_records as $monthly_capital_record){
        $december_capital = $december_capital + $monthly_capital_record['total_listing_price'];
    }
    foreach ($monthly_sale_records as $monthly_sale_record){
        $december_sold = $december_sold + $monthly_sale_record['total'];
    }
    $december_revenue = $december_sold - $december_capital;
    
    $data["december_capital"] = $december_capital;
    $data["december_sold"] = $december_sold;
    $data["december_revenue"] = $december_revenue;
    

    echo json_encode($data);
?>