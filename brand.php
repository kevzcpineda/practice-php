<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>category</title>
</head>
<body>
    <?php
        $page = 'brand';
        include("connect.php");
        $selectUsers = "SELECT * FROM brand_table ORDER BY id DESC";
        $prepareStatement = $con->prepare($selectUsers);
        $result = $prepareStatement->execute();
        $users = $prepareStatement->fetchAll();
    ?>
    <?php include("navbar.php");?>
    <!-- ---------------------EDIT MODAL------------------- -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="edit_brand.php" method="POST">
                <input type="hidden" name = "editId" id="edit_id"> 
                <label >Category</label>
                <input type="text" name="edit_brand" id="edit_brand"><br>                  
            </div>
            <div class="modal-footer">
                <button type="submit" name="edit"class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            
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
            <form action="delete_brand.php" method="POST">
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
    <!-- ---------------------ADD BRAND MODAL------------------- -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="add_brand.php" method="POST">
                <div class="modal-body">
                    <label >Brand</label>
                    <span id="product_error"></span>   
                    <input type="text" name="brand" id="brand" placeholder="Brand"><br>  

                </div>
                <div class="modal-footer">
                    <button type="submit" name="add_btn"class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- ---------------------ADD CATEGORY MODAL------------------- -->
    <div class="container">
        <div class="header">
            <h3>Brand</h3>
        </div>
        <button type = "button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">Add</button>
        <table class="table" id="table">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Brand</th>           
                            <th scope="col">Action</th>           
                        </tr>
                    </thead>
                    <tbody id="table_body">
                    <?php 
                    foreach ($users as $user){?>
                        <tr>
                            <td><?php echo $user["id"]?></td>               
                            <td><?php echo $user["brand_name"]?></td>                
                            <td>                    
                                <button type = "button"  class="btn btn-success edtitBtn">Edit</button>
                                <button type = "button" class ="btn btn-danger deleteBtn" >Delete</button>
                            </td>
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
                    $("#edit_brand").val(data[1]);
            });
        })
    </script>
</body>
</html>