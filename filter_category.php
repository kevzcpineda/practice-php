<?php
    include("connect.php");
    if(isset($_POST['value'])){
        $value = $_POST['value'];
        $item_cat = $_POST['item_cat'];
        
        if($value != "all" and $item_cat == "all"){
            $sql = "SELECT * FROM student WHERE category ='$value'";
            $prepareStatement = $con->prepare($sql);
            $result = $prepareStatement->execute();
            $users = $prepareStatement->fetchAll();

            foreach ($users as $user){
            echo   "<tr>";
            echo      " <td>" .$user['id']."</td>";
            echo       "  <td>". $user['product']."</td>    " ;           
            echo       "  <td>".$user['category']."</td>    ";            
            echo       "  <td>".$user['item_category']."</td>    ";            
            echo       "  <td>".$user['brand']."</td>    ";            
            echo       "  <td>".number_format($user['listing_price'],'2','.',',')."</td>";
            echo       "  <td>".number_format($user['retail_price'],'2','.',',')."</td>";
            echo       "  <td>".$user['unit']."</td>    ";   
            echo         "<td> ".number_format($user['stock'],'2','.',',')."</td>";
            echo        " <td>       ";                          
            echo            " <button type = 'button'  class='btn btn-success edtitBtn'><i class='fas fa-edit'></i></button>";
            echo           "  <button type = 'button' class ='btn btn-danger deleteBtn' ><i class='fas fa-trash-alt'></i></button>";
            echo          "   <button type = 'button' class ='btn btn-primary addQuanBtn' ><i class='fas fa-plus'></i></button>";
                
            echo       "  </td>";
            echo     "</tr>";
        
        }

        }elseif($value == "all" and $item_cat != "all"){
            $sql = "SELECT * FROM student WHERE item_category = '$item_cat'";
            $prepareStatement = $con->prepare($sql);
            $result = $prepareStatement->execute();
            $users = $prepareStatement->fetchAll();

            foreach ($users as $user){
            echo   "<tr>";
            echo      " <td>" .$user['id']."</td>";
            echo       "  <td>". $user['product']."</td>    " ;           
            echo       "  <td>".$user['category']."</td>    ";            
            echo       "  <td>".$user['item_category']."</td>    ";            
            echo       "  <td>".$user['brand']."</td>    ";            
            echo       "  <td>".number_format($user['listing_price'],'2','.',',')."</td>";
            echo       "  <td>".number_format($user['retail_price'],'2','.',',')."</td>";
            echo       "  <td>".$user['unit']."</td>    ";   
            echo         "<td> ".number_format($user['stock'],'2','.',',')."</td>";
            echo        " <td>       ";                          
            echo            " <button type = 'button'  class='btn btn-success edtitBtn'><i class='fas fa-edit'></i></button>";
            echo           "  <button type = 'button' class ='btn btn-danger deleteBtn' ><i class='fas fa-trash-alt'></i></button>";
            echo          "   <button type = 'button' class ='btn btn-primary addQuanBtn' ><i class='fas fa-plus'></i></button>";
                
            echo       "  </td>";
            echo     "</tr>";
        
            }
        }
        elseif($value != "all" and $item_cat != "all"){
            $sql = "SELECT * FROM student WHERE category ='$value' AND item_category = '$item_cat'";
            $prepareStatement = $con->prepare($sql);
            $result = $prepareStatement->execute();
            $users = $prepareStatement->fetchAll();

            foreach ($users as $user){
            echo   "<tr>";
            echo      " <td>" .$user['id']."</td>";
            echo       "  <td>". $user['product']."</td>    " ;           
            echo       "  <td>".$user['category']."</td>    ";            
            echo       "  <td>".$user['item_category']."</td>    ";            
            echo       "  <td>".$user['brand']."</td>    ";            
            echo       "  <td>".number_format($user['listing_price'],'2','.',',')."</td>";
            echo       "  <td>".number_format($user['retail_price'],'2','.',',')."</td>";
            echo       "  <td>".$user['unit']."</td>    ";   
            echo         "<td> ".number_format($user['stock'],'2','.',',')."</td>";
            echo        " <td>       ";                          
            echo            " <button type = 'button'  class='btn btn-success edtitBtn'><i class='fas fa-edit'></i></button>";
            echo           "  <button type = 'button' class ='btn btn-danger deleteBtn' ><i class='fas fa-trash-alt'></i></button>";
            echo          "   <button type = 'button' class ='btn btn-primary addQuanBtn' ><i class='fas fa-plus'></i></button>";
                
            echo       "  </td>";
            echo     "</tr>";
        
            }
        }else{
            $sql = "SELECT * FROM student ORDER BY id DESC";
            $prepareStatement = $con->prepare($sql);
            $result = $prepareStatement->execute();
            $users = $prepareStatement->fetchAll();

            foreach ($users as $user){
            echo   "<tr>";
            echo      " <td>" .$user['id']."</td>";
            echo       "  <td>". $user['product']."</td>    " ;           
            echo       "  <td>".$user['category']."</td>    ";            
            echo       "  <td>".$user['item_category']."</td>    ";            
            echo       "  <td>".$user['brand']."</td>    ";            
            echo       "  <td>".number_format($user['listing_price'],'2','.',',')."</td>";
            echo       "  <td>".number_format($user['retail_price'],'2','.',',')."</td>";
            echo       "  <td>".$user['unit']."</td>    ";   
            echo         "<td> ".number_format($user['stock'],'2','.',',')."</td>";
            echo        " <td>       ";                          
            echo            " <button type = 'button'  class='btn btn-success edtitBtn'><i class='fas fa-edit'></i></button>";
            echo           "  <button type = 'button' class ='btn btn-danger deleteBtn' ><i class='fas fa-trash-alt'></i></button>";
            echo          "   <button type = 'button' class ='btn btn-primary addQuanBtn' ><i class='fas fa-plus'></i></button>";
                
            echo       "  </td>";
            echo     "</tr>";
        
        }

        }
        
    
    }
?>
<script>
    $(document).ready(function(){
        // ----------------DELETE BTN------------
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
        // -------------------ADD QUANTITY BTN------------------
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

