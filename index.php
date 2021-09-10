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
    <!-- ---------------------add modal------------------- -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">add</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="add.php" method="POST">
            
        
            
            <label >firstname</label>
            <input type="text" name="firstname"value="" ><br>
            <label >lastname</label>
            <input type="text" name="lastname" value=""><br>
            <label >email</label>
            <input type="email" name="email" value=""><br>
            

        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="add"class="btn btn-primary">Save changes</button>
            </form>
        </div>
        </div>
    </div>
    </div>
     <!-- ---------------------delete modal------------------- -->
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
    <!-- ---------------------edit modal------------------- -->
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
            <label >firstname</label>
            <input type="text" name="firstname" id="fname"><br>
            <label >lastname</label>
            <input type="text" name="lastname" id="lname"><br>
            
            

        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="edit"class="btn btn-primary">Save changes</button>
            </form>
        </div>
        </div>
    </div>
    </div>
    
  
    <button type = "button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">add</button>
    
        <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Handle</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach ($users as $user){?>
            <tr>
                <td><?php echo $user["id"]?></td>
                <td><?php echo $user["firstname"]?></td>
                <td><?php echo $user["lastname"]?></td>
                <td>                    
                    
                    <button type = "button"  class="btn btn-success edtitBtn">edit</button>
                    <button type = "button" class ="btn btn-danger deleteBtn" >delete</button>
            
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
                    $('#fname').val(data[1]);
                    $('#lname').val(data[2]);
                    
                    
            });
        });
    </script>
</body>
</html>