

<?php
    $con = mysqli_connect("localhost","root","","student_info");

    if(isset($_POST['submit'])){
        $product = trim($_POST['product']); 
        $category = trim($_POST['category']);  
        $brand = trim($_POST['brand']);  

        $selectUsers = "SELECT * FROM student WHERE product='$product' AND category='$category' AND brand='$brand'";
        $prepareStatement = mysqli_query($con,"SELECT * FROM student WHERE product='$product' AND category='$category' AND brand='$brand'");
        $result=mysqli_num_rows($prepareStatement);

        $date = date('Y-m-d');
        $listing_price = trim($_POST['listing_price']);
        $retail_price = trim($_POST['retail_price']);
        $stock = trim($_POST['stock']);
        $total_listing_price = $listing_price * $stock;
        
        $product_error = false;
        $category_error = false;
        $brand_error = false;
        $listing_error = false;
        $retail_error = false;
        $stock_error = false;
        $success_error = false;

        $product_msg = "";
        $category_msg = "";
        $brand_msg = "";
        $listing_msg = "";
        $retail_msg = "";
        $stock_msg = "";
        $already_exist = "";
        
        
        if(empty($product)){
            $product_msg = "input product";
            $product_error = true;
        }else{
            $product_error = false;
        }

        if(empty($category)){
            $category_msg = "input category";
            $category_error = true;
        }else{
            $category_error = false;
        }

        if(empty($brand)){
            $brand_msg = "input brand";
            $brand_error = true;
        }else{
            $brand_error = false;
        }

        if(empty($listing_price)){
            $listing_msg = "input listing price";
            $listing_error = true;
        }else{
            if(preg_match("/[0-9]+\.?[0-9]*/",$listing_price)){
                $listing_error = false;
            }else{
                $listing_msg = "number only";
                $listing_error = true;
                }
        }

        if(empty($retail_price)){
            $retail_msg = "input retail";
            $retail_error = true;
        }else{
            if(preg_match("/[0-9]+\.?[0-9]*/",$retail_price)){
                $retail_error = false;
            }else{
                $retail_msg = "number only";
                $retail_error = true;
            }
        }

        if(empty($stock)){
            $stock_msg = "input stock";
            $stock_error = true;
        }else{
            $stock_error = false;
        }
        if($result > 0){
            $already_exist = "this item is already exist";
            $success_error = true;
        }else{
            $success_error = false;
        }

        
        if(($listing_error == false) && ($product_error == false) && ($retail_error == false) && ($category_error == false) && ($stock_error == false) && ($success_error == false) && ($brand_error == false)){
            $add_user = "INSERT INTO `student`(`id`, `product`,`category`,`brand`,`listing_price`,`retail_price`,`stock`) VALUES (null,'$product','$category','$brand','$listing_price','$retail_price','$stock')";
            $prepareStatement_user = $con->prepare($add_user);
            $user_result = $prepareStatement_user->execute();

            $add_quantity_sql = "INSERT INTO `add_quantity`(`id`,`product`,`category`,`brand_name`,`quantity`,`total_listing_price`,`date`) VALUES (null,'$product','$category','$brand','$stock','$total_listing_price','$date')";
            $prepareStatement = $con->prepare($add_quantity_sql);
            $quantity_result = $prepareStatement->execute();
            
        }
        
    }
    


?>
<script> 
    
    var product_error ="<?php echo $product_error?>";
    var category_error ="<?php echo $category_error?>";
    var brand_error ="<?php echo $brand_error?>";
    var listing_error ="<?php echo $listing_error?>";
    var retail_error ="<?php echo $retail_error?>";
    var stock_error ="<?php echo $stock_error?>";
    var success_error = "<?php echo $success_error?>";

    var product_msg = "<?php echo $product_msg?>";
    var category_msg = "<?php echo $category_msg?>";
    var brand_msg = "<?php echo $brand_msg?>";
    var listing_msg = "<?php echo $listing_msg?>";
    var retail_msg = "<?php echo $retail_msg?>";
    var stock_msg = "<?php echo $stock_msg?>";
    var already_exist = "<?php echo $already_exist?>";
    
    console.log(success_error);
    console.log(already_exist);
    if(product_error || category_error || brand_error || listing_error || retail_error || stock_error || success_error){
        if(product_error){
        $("#product_error").text(product_msg);
        }else{
            $("#product_error").text("");
        }
        if(category_error){
            $("#cat_error").text(category_msg);
        }else{
            $("#cat_error").text("");
        }
        if(brand_error){
            $("#brand_error").text(brand_msg);
        }else{
            $("#brand_error").text("");
        }

        if(listing_error){
            $("#listing_error").text(listing_msg);
        }else{
            $("#listing_error").text("");
        }
        
        if(retail_error){
            $("#retail_error").text(retail_msg);
        }else{
            $("#retail_error").text("");
        }
        if(stock_error){
        $("#stock_error").text(stock_msg);
        }else{
            $("#stock_error").text("");
        }
        if(success_error){
        $("#error").text(already_exist);
        }else{
            $("#error").text("");
        }
    }
    else{
        location.reload();
        $("#product,#listing_price,#retail_price,#alet_message,#stock").val("");
        $("#alert").addClass("alert alert-success");
        $('#addModal').modal('hide');
        $("#alet_message").text("success");
        

        setInterval(() => {
            $("#alet_message").text("");
            $("#alert").removeClass("alert alert-primary");
        }, 5000);
    }
    // if(success_error){
    //     $("#product,#listing_price,#retail_price,#category,#stock").val("");
    //     $("#alert").addClass("alert alert-success");
    //     $("#alet_message").text("success");
    //     $('#addModal').modal('hide');
    //     location.reload();
        
    //     setInterval(() => {
    //         $("#alet_message").text("");
    //         $("#alert").removeClass("alert alert-primary");
    //     }, 5000);
    // }
    

</script>


