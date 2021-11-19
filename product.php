<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <script src="jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <!-- <link rel="stylesheet" href="assets/css/styles.css"> -->
    <link rel="stylesheet" href="style.css">
</head>
<body >
    <?php include("navbar.php");?>
    <?php
        $page = 'product';
        include("connect.php");
        $selectUsers = "SELECT * FROM student ORDER BY id DESC";
        $prepareStatement = $con->prepare($selectUsers);
        $result = $prepareStatement->execute();
        $users = $prepareStatement->fetchAll();

        $item_category_sql = "SELECT * FROM item_category";
        $prepareStatement = $con->prepare($item_category_sql);
        $result = $prepareStatement->execute();
        $item_categorys = $prepareStatement->fetchAll();

        $category_sql = "SELECT * FROM category_table";
        $prepareStatement = $con->prepare($category_sql);
        $result = $prepareStatement->execute();
        $categorys = $prepareStatement->fetchAll();

        $brand_sql = "SELECT * FROM brand_table";
        $prepareStatement = $con->prepare($brand_sql);
        $result = $prepareStatement->execute();
        $brands = $prepareStatement->fetchAll();


        // echo "<pre>";
        // print_r($users);
        // echo "</pre>";

    ?>
    <!-- <div class="bar">
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
    </div> -->
    
    <!-- ---------------------ADD MODAL------------------- -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="add.php" method="POST" id="addform">
                <div class="">
                    <label class="col-form-label">Product name:</label> 
                    <input type="text" class="form-control" name="product" id="product" placeholder="Product">
                    <span id="product_error"></span>  
                    
                </div>
                <div class="">
                    <label class="col-form-label" for="category">Product category</label>
                    <select name="" id="category" class="form-control">
                        <option value="">Select category</option>
                        <?php
                            foreach ($categorys as $category){?>
                                <option value="<?php echo $category['category']?>"><?php echo $category['category']?></option>
                            <?php }
                        ?>
                    </select>
                    <span id="cat_error"></span>  
                </div>
                <div class="">
                    <label class="col-form-label" for="item_category">Item category</label>
                    <select name="" id="item_category" class="form-control">
                        <option value="">Select category</option>
                        <?php
                            foreach ($item_categorys as $item_category){?>
                                <option value="<?php echo $item_category['item_category']?>"><?php echo $item_category['item_category']?></option>
                            <?php }
                        ?>
                    </select>
                    <span id="cat_error"></span>  
                </div>
                <div class="">
                    <label class="col-form-label">Brand</label>
                    <select name="" id="brand" class="form-control">
                        <option value="">Select brand</option>
                        <?php
                            foreach ($brands as $brand){?>
                                <option value="<?php echo $brand['brand_name']?>"><?php echo $brand['brand_name']?></option>
                            <?php }
                        ?>
                    </select>
                    <span id="brand_error"></span>   
                </div>
                <div class="">
                    <label class="col-form-label">Listing Price</label>
                    <input type="text" class="form-control" name="listing_price" id="listing_price" placeholder="Input listing price">
                    <span id="listing_error"></span> 
                </div>
                <div class="">
                    <label class="col-form-label">Retail Price</label>
                    <input type="text" class="form-control" name="retail_price" id="retail_price" placeholder="Input retail price">
                    <span id="retail_error"></span>
                </div>
                <div class="">
                    <label class="col-form-label" for="unit">Unit</label>
                    <select name="" id="unit" class="form-control">
                        <option value="">Select unit</option>
                        <option value="pcs">Pcs</option>
                        <option value="kgs">Kgs</option>
                        <option value="gross">Gross</option>
                        <option value="lnFT">LnFT</option>
                        <option value="sqFt">SqFt</option>
                        <option value="tubes">Tubes</option>
                    </select>
                    <span id="cat_error"></span>  
                </div>
                <div class="">
                    <label class="col-form-label">Stock</label>
                    <input type="number" class="form-control" name="stock" id="stock" placeholder="Input stock">
                    <span id="stock_error"></span>
                </div>
                <span id="error"></span>
            
            
            </div>
            <div class="modal-footer">
                <button type="submit" name="add"class="btn btn-primary" id="submit">Add product</button>
                <button type="button" class="btn btn-secondary"data-bs-dismiss="modal">Close</button>
                
                
            </div>
            </form>
            </div>
        </div>
    </div>
    <!-- ---------------------DELETE MODAL------------------- -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="delete.php" method="POST">
            <div class="modal-body">
                
                <input type="hidden" name = "deleteId" id="deleteId"> 
                <h3>are you sure you want to delete this</h3>    
                    
            </div>
            <div class="modal-footer">
                <button type="submit" name="deletedata"class="btn btn-primary">Yes</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                
                </form>
            </div>
            </div>
        </div>
    </div>
    <!-- ---------------------EDIT MODAL------------------- -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="edit.php" method="POST">
                <input type="hidden" name = "editId" id="edit_id"> 

                <label class="col-form-label">Product</label>
                <input type="text" name="product" id="edit_product" class="form-control">
                
                <label class="col-form-label">Product category</label>
                <select name="category" id="edit_cat" class="form-control">
                    <?php
                        include("mysqli.php");
                        $catSql = "SELECT * FROM category_table";
                        $cat = $con->query($catSql);
                        while($row = $cat->fetch_assoc()){
                            echo '<option value="'.$row['category'].'">'.$row['category'].'</option>'; 
                    ?>
                    <?php } ?>
                </select>

                <label class="col-form-label">Item category</label>
                <select name="item_category" id="edit_item_cat" class="form-control">
                    <?php
                        include("mysqli.php");
                        $catSql = "SELECT * FROM item_category";
                        $cat = $con->query($catSql);
                        while($row = $cat->fetch_assoc()){
                            echo '<option value="'.$row['item_category'].'">'.$row['item_category'].'</option>'; 
                    ?>
                    <?php } ?>
                </select>

                <label class="col-form-label">Brand</label> 
                <select name="brand" id="edit_brand" class="form-control">
                    <?php 
                        include("mysqli.php");
                        $brandSql = "SELECT * FROM brand_table";
                        $brand = $con->query($brandSql);
                        while($row = $brand->fetch_assoc()){
                            echo '<option value="'.$row['brand_name'].'">'.$row['brand_name'].'</option>'; 
                    ?>
                    <?php } ?>
                </select>
                
                <label class="col-form-label">Listing Price</label>
                <input type="text" name="listing_price" id="edit_listing_price" class="form-control">

                <label class="col-form-label">Retail Price</label>
                <input type="text" name="retail_price" id="edit_retail_price" class="form-control">
                
                <label class="col-form-label" for="unit">Unit</label>
                    <select name="" id="edit_unit" class="form-control">
                        <option value="">Select unit</option>
                        <option value="pcs">Pcs</option>
                        <option value="kgs">Kgs</option>
                        <option value="gross">Gross</option>
                        <option value="lnFT">LnFT</option>
                        <option value="sqFt">SqFt</option>
                        <option value="tubes">Tubes</option>
                    </select>
                

            
            </div>
            <div class="modal-footer">
                <button type="submit" name="edit"class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                
                </form>
            </div>
            </div>
        </div>
    </div>
    <!-- ---------------------ADD QUANTITY MODAL------------------- -->
    <div class="modal fade" id="addQuantityModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">add quantity</h5>
                
            </div>
            <div class="modal-body">
                <form action="addquantity.php" method="POST">
                
                <input type="hidden" name = "quantityId" id="quantityId"> 
                <input type="hidden" name = "product" id="product"> 
                <input type="hidden" name = "lastname" id="lname"> 
                <input type="hidden" name = "price" id="price"> 
                <label >quantity</label>
                <input type="number" name="quantity" id="quantity"><br>
                
                

            
            </div>
            <div class="modal-footer">
                <button type="submit" name="add_quan_btn"class="btn btn-primary">Add</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                
                </form>
            </div>
            </div>
        </div>
    </div>
    <!-- ----------------------END MODAL----------------------------- -->
        <!-- -------------------content----------------- -->
        <div class="container">
            
            <div class="header">  
                <div class="left">
                    <h3>Products</h3>
                </div>
                <div class="right">
                    <!-- <input type="text" id="search"> -->
                    <select name="" id="filter_category">
                        <option value="all">Select filter</option>
                        <?php 
                            include("mysqli.php");
                            $catSql = "SELECT * FROM category_table";
                            $cat = $con->query($catSql);
            
                            while($row = $cat->fetch_assoc()){
                                echo '<option value="'.$row['category'].'">'.$row['category'].'</option>'; 
                        ?>
                                
                        <?php } ?>
                    </select>   
                    <select name="" id="filter_item_category">
                        <option value="all">Select filter</option>
                        <?php 
                            include("mysqli.php");
                            $catSql = "SELECT * FROM item_category";
                            $cat = $con->query($catSql);
            
                            while($row = $cat->fetch_assoc()){
                                echo '<option value="'.$row['item_category'].'">'.$row['item_category'].'</option>'; 
                        ?>
                                
                        <?php } ?>
                    </select>   
                    <button type = "button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">Add product</button>
                </div>
                
            </div>

            <table class="table" id="table">
                <thead>
                    <tr>
                    <th scope="col">id</th>
                    <th scope="col">Product</th> 
                    <th scope="col">Product category</th>           
                    <th scope="col">Item category</th>           
                    <th scope="col">Brand</th>           
                    <th scope="col">Listing Price</th>
                    <th scope="col">Retail Price</th>
                    <th scope="col">Unit</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="table_body">
                <?php 
                foreach ($users as $user){?>
                    <tr>
                        <td><?php echo $user["id"]?></td>
                        <td><?php echo $user["product"]?></td>                
                        <td><?php echo $user["category"]?></td>                
                        <td><?php echo $user["item_category"]?></td>                
                        <td><?php echo $user["brand"]?></td>                
                        <td><?php echo number_format($user["listing_price"],'2','.',',')?></td>
                        <td><?php echo number_format($user["retail_price"],'2','.',',')?></td>
                        <td><?php echo $user["unit"]?></td>                
                        <td><?php echo number_format($user["stock"])?></td>
                        <td>                    
                            <button type = "button"  class="btn btn-success edtitBtn">Edit</button>
                            <button type = "button" class ="btn btn-danger deleteBtn" >Delete</button>
                            <button type = "button" class ="btn btn-primary addQuanBtn" >Add quantity</button>
                        </td>
                    </tr>
                
                <?php }?>

                </tbody>
            </table>
        </div>
    <!-- ===== IONICONS ===== -->
    <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>

    <!-- ===== MAIN JS ===== -->
    <!-- <script src="assets/js/main.js"></script> -->

    <!-- JavaScript Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready(function(){
            $('#table').DataTable();
            // -----------delete btn-----------
            $('.deleteBtn').on('click',function(){
                
                $('#deleteModal').modal('show');
                    $tr = $(this).closest('tr');
                    var data = $tr.children("td").map(function(){
                        return $(this).text();
                    }).get();
                    $('#deleteId').val(data[0]);
            });

            // ---------------edit btn--------------
            $('.edtitBtn').on('click',function(){
                
                $('#editModal').modal('show');
                    $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function(){
                        return $(this).text();
                    }).get();
                
                    $("#edit_id").val(data[0]);
                    $("#edit_product").val(data[1]);
                    $("#edit_cat").val(data[2]);
                    $("#edit_item_cat").val(data[3]);
                    $("#edit_brand").val(data[4]);
                    $("#edit_listing_price").val(data[5]);
                    $("#edit_retail_price").val(data[6]);
                    $("#edit_unit").val(data[7]);
                    
                    
                    
            });
            // --------------add quantity------------
            $('.addQuanBtn').on('click',function(){
                
                $('#addQuantityModal').modal('show');
                    $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function(){
                        return $(this).text();
                    }).get();

                    $('#quantityId').val(data[0]);
            });
            // ----------------ADD PRODUCT BTN-------------
            $("#addform").submit(function(event){
                event.preventDefault();
                var product = $("#product").val();
                var category = $("#category").val();
                var item_category = $("#item_category").val();
                var brand = $("#brand").val();
                var listing_price = $("#listing_price").val();
                var retail_price = $("#retail_price").val();
                var unit = $("#unit").val();
                var stock = $("#stock").val();
                var submit = $("#submit").val();
                $("#error").load("add.php",{
                    product:product,
                    category:category,
                    item_category:item_category,
                    brand:brand,
                    listing_price:listing_price,
                    retail_price:retail_price,
                    unit:unit,
                    stock:stock,
                    submit:submit
                });

            });

            // -------------------FILTER PRODUCT CATEGORY---------------
            $("#filter_category").on('change',function(){
                var value = $("#filter_category").val(); 
                var item_cat = $("#filter_item_category").val();  
                console.log(value);
                console.log(item_cat);
                $("#table_body").load("filter_category.php",{
                    value:value,
                    item_cat:item_cat
                });
                    
            });
            $("#filter_item_category").on('change',function(){
                var product_cat = $("#filter_category").val(); 
                var item_cat = $("#filter_item_category").val(); 
                
                console.log(product_cat);
                console.log(item_cat);
                $("#table_body").load("filter_item_category.php",{
                    value:product_cat,
                    item_cat:item_cat
                });
                    
            });
            //search product
            // $("#search").keyup(function(){
            //     var txt = $(this).val();
                
            //     $.ajax({
            //         url:"search_product.php",
            //         method:"POST",
            //         data:{txt:txt},
            //         success:function(data){
            //             $("#table_body").html(data);
            //             // -----------delete btn-----------
            //             $('.deleteBtn').on('click',function(){
                            
            //                 $('#deleteModal').modal('show');
            //                     $tr = $(this).closest('tr');
            //                     var data = $tr.children("td").map(function(){
            //                         return $(this).text();
            //                     }).get();
            //                     $('#deleteId').val(data[0]);
            //             });
            //             // ---------------edit btn--------------
            //             $('.edtitBtn').on('click',function(){
                            
            //                 $('#editModal').modal('show');
            //                     $tr = $(this).closest('tr');

            //                     var data = $tr.children("td").map(function(){
            //                         return $(this).text();
            //                     }).get();
                            
            //                     $("#edit_id").val(data[0]);
            //                     $("#edit_product").val(data[1]);
            //                     $("#edit_cat").val(data[2]);
            //                     $("#edit_brand").val(data[3]);
            //                     $("#edit_listing_price").val(data[4]);
            //                     $("#edit_retail_price").val(data[5]);
            //             });
            //             // --------------add quantity------------
            //             $('.addQuanBtn').on('click',function(){
                            
            //                 $('#addQuantityModal').modal('show');
            //                     $tr = $(this).closest('tr');

            //                     var data = $tr.children("td").map(function(){
            //                         return $(this).text();
            //                     }).get();

            //                     $('#quantityId').val(data[0]);
            //             });
                        
            //         }
            //     });
                
                
            // });


        });
    </script>
</body>
</html>