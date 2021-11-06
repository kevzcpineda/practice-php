<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>sales</title>
</head>
<body>
    <?php
        $page = 'sales';
        include("connect.php");
        $sale_record = "SELECT * FROM order_table ORDER BY id DESC";
        $prepareStatement = $con->prepare($sale_record);
        $result = $prepareStatement->execute();
        $order_records = $prepareStatement->fetchAll();

        $student = "SELECT * FROM student WHERE stock>0";
        $prepareStatement = $con->prepare($student);
        $result = $prepareStatement->execute();
        $students = $prepareStatement->fetchAll();

        
        // echo "<pre>";
        // print_r($users);
        // echo "</pre>";

    ?>
    <div class="bar">
        <div class="container">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="product.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sales.php">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="category.php">Categorys</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="brand.php">Brands</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- ---------------------ORDER MODAL------------------- -->
     <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="order.php" method="POST">
                    <div>
                        
                        <select id="product" name="product" class="form-control">
                            <option value="">Select product</option>
                            <?php 
                            foreach ($students as $student){?>
                            <option value="<?php echo $student['product']?>"> <?php echo $student['product']?> | <?php echo $student['brand']?> </option>
                            <?php }?>
                        </select>
                        <label>quantity</label>
                        <input type="number" name="quantity" id="quantity"><br>
                        <label>avalable quantity:</label>
                        <label id="avalable"></label>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" name="order"class="btn btn-primary">Add Order</button>
                <button type="submit" name="order"class="btn btn-primary">Order</button>
                <button type="button" class="btn btn-secondary"data-bs-dismiss="modal">Close</button>
                
                </form>
            </div>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="header">
            <h3>Orders</h3>
        </div>
        <a href="add_order.php"><button type="button" class="btn btn-primary">Add Order</button></a> 
    
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Customer Name</th>        
                    <th scope="col">Date</th>            
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ($order_records as $order_record){?>
                    <tr>
                        <td><?php echo $order_record["id"]?></td>
                        <td><?php echo $order_record["customer_name"]?></td>                
                        <td><?php echo $order_record["date"]?></td>                
                        <td><button class="btn btn-info print_btn">Print</button></td>                
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </div>               
    <!-- ===== IONICONS ===== -->
    <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>

    <!-- ===== MAIN JS ===== -->
    <script src="assets/js/main.js"></script>  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $('#product').change(function(){
                var product = $('#product').val();
                console.log(product);

                $.ajax({
                url:"show_available.php",
                method:"POST",
                data:{
                    id:product,
                },
                success:function(data){
                    $('#avalable').html(data);
                }
                    

                });
            });
            //print button
            $(".print_btn").click(function(){
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();
                console.log(data[0]);

                window.location.href = "pdf.php?id="+data[0]+"";
                
            });
            
            
        });
    </script>
</body>
</html>