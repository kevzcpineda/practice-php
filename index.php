<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <script src="jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <?php
        include("connect.php");
        $selectUsers = "SELECT * FROM student";
        $prepareStatement = $con->prepare($selectUsers);
        $result = $prepareStatement->execute();
        $users = $prepareStatement->fetchAll();

        // echo "<pre>";
        // print_r($users);
        // echo "</pre>";

    ?>
    <!-- ---------------------ADD MODAL------------------- -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">add</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="add.php" method="POST">
                
            
                
                <label >Product</label>
                <input type="text" name="product"value="" ><br>            
                <label >Listing Price</label>
                <input type="number" name="listing_price" value=""><br>
                <label >Retail Price</label>
                <input type="number" name="retail_price" value=""><br>
                

            
            </div>
            <div class="modal-footer">
                <button type="submit" name="add"class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary"data-bs-dismiss="modal">Close</button>
                
                </form>
            </div>
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
                <h5 class="modal-title" id="exampleModalLabel">edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="edit.php" method="POST">
                
            
                <input type="hidden" name = "editId" id="editId"> 
                <label >Product</label>
                <input type="text" name="product" id="product"><br>            
                <label >Listing Price</label>
                <input type="number" name="listing_price" id="listing_price"><br>
                <label >Retail Price</label>
                <input type="number" name="retail_price" id="retail_price"><br>
                
                

            
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
    
  
    <button type = "button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">add</button>

    <a href="sales.php"><button type = "button" class="btn btn-success" >sales</button></a>

    <table class="table">
        <thead>
            <tr>
            <th scope="col">id</th>
            <th scope="col">Product</th>        
            <th scope="col">Listing Price</th>
            <th scope="col">Retail Price</th>
            <th scope="col">quantity</th>
            <th scope="col">Handle</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($users as $user){?>
                <tr>
                    <td><?php echo $user["id"]?></td>
                    <td><?php echo $user["product"]?></td>                
                    <td><?php echo $user["listing_price"]?></td>
                    <td><?php echo $user["retail_price"]?></td>
                    <td><?php echo $user["stock"]?></td>
                    <td>                    
                        
                        <button type = "button"  class="btn btn-success edtitBtn">edit</button>
                        <button type = "button" class ="btn btn-danger deleteBtn" >delete</button>
                        <button type = "button" class ="btn btn-primary addQuanBtn" >add quantity</button>
                
                    </td>
                </tr>
            
            <?php }?>
        </tbody>
    </table>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){
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

                    $('#editId').val(data[0]);
                    $('#product').val(data[1]);
                    $('#listing_price').val(data[2]);
                    $('#retail_price').val(data[3]);
                    
                    
            });
            // --------------add quantity------------
            $('.addQuanBtn').on('click',function(){
                
                $('#addQuantityModal').modal('show');
                    $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function(){
                        return $(this).text();
                    }).get();

                    $('#quantityId').val(data[0]);
                    // $('#product').val(data[1]);
                    // $('#listing_price').val(data[2]);
                    // $('#retail_price').val(data[3]);
                    // $('#quantity').val(data[4]);
                    
                    
            });
        });
    </script>
</body>
</html>