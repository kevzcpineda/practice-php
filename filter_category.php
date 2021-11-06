<?php
    include("connect.php");
    if(isset($_POST['value'])){
        $value = $_POST['value'];

        if($value == "all"){
            $sql = "SELECT * FROM student ORDER BY id DESC";
            $prepareStatement = $con->prepare($sql);
            $result = $prepareStatement->execute();
            $users = $prepareStatement->fetchAll();

            foreach ($users as $user){
            echo   "<tr>";
            echo      " <td>" .$user['id']."</td>";
            echo       "  <td>". $user['product']."</td>    " ;           
            echo       "  <td>".$user['category']."</td>    ";            
            echo       "  <td>".$user['brand']."</td>    ";            
            echo       "  <td>".number_format($user['listing_price'],'2','.',',')."</td>";
            echo       "  <td>".number_format($user['retail_price'],'2','.',',')."</td>";
            echo         "<td> ".number_format($user['stock'])."</td>";
            echo        " <td>       ";                          
            echo            " <button type = 'button'  class='btn btn-success edtitBtn'>edit</button>";
            echo           "  <button type = 'button' class ='btn btn-danger deleteBtn' >delete</button>";
            echo          "   <button type = 'button' class ='btn btn-primary addQuanBtn' >add quantity</button>";
                
            echo       "  </td>";
            echo     "</tr>";
        
        }

        }else{
            $sql = "SELECT * FROM student WHERE category ='$value'";
            $prepareStatement = $con->prepare($sql);
            $result = $prepareStatement->execute();
            $users = $prepareStatement->fetchAll();

            foreach ($users as $user){
            echo   "<tr>";
            echo      " <td>" .$user['id']."</td>";
            echo       "  <td>". $user['product']."</td>    " ;           
            echo       "  <td>".$user['category']."</td>    ";            
            echo       "  <td>".$user['brand']."</td>    ";            
            echo       "  <td>".number_format($user['listing_price'],'2','.',',')."</td>";
            echo       "  <td>".number_format($user['retail_price'],'2','.',',')."</td>";
            echo         "<td> ".number_format($user['stock'])."</td>";
            echo        " <td>       ";                          
            echo            " <button type = 'button'  class='btn btn-success edtitBtn'>Edit</button>";
            echo           "  <button type = 'button' class ='btn btn-danger deleteBtn' >Delete</button>";
            echo          "   <button type = 'button' class ='btn btn-primary addQuanBtn' >Add quantity</button>";
                
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
        // --------------------EDIT BTN------------------
        $('.edtitBtn').on('click',function(){
            
            $('#editModal').modal('show');
                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();
                console.log(data[0]);
                console.log(data[1]);
                console.log(data[2]);
                console.log(data[3]);

                $("#edit_id").val(data[0]);
                $("#edit_product").val(data[1]);
                $("#edit_cat").val(data[2]);
                $("#edit_brand").val(data[3]);
                $("#edit_listing_price").val(data[4]);
                $("#edit_retail_price").val(data[5]);
                
                
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

