<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>sales</title>
</head>
<body>
    <?php
        include("connect.php");
        $sale_record = "SELECT * FROM sale_record ORDER BY id DESC";
        $prepareStatement = $con->prepare($sale_record);
        $result = $prepareStatement->execute();
        $sale_records = $prepareStatement->fetchAll();

        $student = "SELECT * FROM student";
        $prepareStatement = $con->prepare($student);
        $result = $prepareStatement->execute();
        $students = $prepareStatement->fetchAll();

        // echo "<pre>";
        // print_r($users);
        // echo "</pre>";

    ?>
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
                    
                    <label>Product</label>
                    <select id="" name="product">
                    <?php 
                    foreach ($students as $student){?>
                    <option name=""><?php echo $student['product']?></option>
                    <?php }?>
                    </select>
                    <label>quantity</label>
                    <input type="number" name="quantity" id="quantity"><br>
            </div>
            <div class="modal-footer">
                <button type="submit" name="order"class="btn btn-primary">Order</button>
                <button type="button" class="btn btn-secondary"data-bs-dismiss="modal">Close</button>
                
                </form>
            </div>
            </div>
        </div>
    </div>

    <button type = "button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#orderModal">order</button>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">id</th>
            <th scope="col">Product</th>        
            <th scope="col">Price</th>            
            <th scope="col">quantity</th>
            <th scope="col">total</th>
            <th scope="col">date</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($sale_records as $sale_record){?>
                <tr>
                    <td><?php echo $sale_record["id"]?></td>
                    <td><?php echo $sale_record["product_name"]?></td>                
                    <td><?php echo $sale_record["price"]?></td>
                    <td><?php echo $sale_record["quantity"]?></td>
                    <td><?php echo $sale_record["total"]?></td>
                    <td><?php echo $sale_record["date"]?></td>
                    
                </tr>
            
            <?php }?>
        </tbody>
    </table>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>