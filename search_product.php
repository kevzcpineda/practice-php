<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "student_info";
    $con = mysqli_connect($servername,$username,$password,$db);

    $txt = $_POST['txt'];
    $html = "";
    
    if($txt == ""){
        $sql = "SELECT * FROM student";
        $result = mysqli_query($con,$sql) or die(mysqli_error($con));
        if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            $html.="
                <tr>
                    <td>".$row['id']."</td>
                    <td>".$row['product']."</td>
                    <td>".$row['category']."</td>
                    <td>".$row['brand']."</td>
                    <td>".$row['listing_price']."</td>
                    <td>".$row['retail_price']."</td>
                    <td>".$row['stock']."</td>
                    <td>                    
                        <button type = 'button'  class='btn btn-success edtitBtn'>Edit</button>
                        <button type = 'button' class ='btn btn-danger deleteBtn' >Delete</button>
                        <button type = 'button' class ='btn btn-primary addQuanBtn' >Add quantity</button>
                    </td>
                </tr>
            ";
        }
        echo $html;
        }
    }else{
        $sql = "SELECT * FROM student WHERE product LIKE '%".mysqli_real_escape_string($con,$txt)."%'";
        $result = mysqli_query($con,$sql) or die(mysqli_error($con));
        if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            $html.="
                <tr>
                    <td>".$row['id']."</td>
                    <td>".$row['product']."</td>
                    <td>".$row['category']."</td>
                    <td>".$row['brand']."</td>
                    <td>".$row['listing_price']."</td>
                    <td>".$row['retail_price']."</td>
                    <td>".$row['stock']."</td>
                    <td>                    
                        <button type = 'button'  class='btn btn-success edtitBtn'>Edit</button>
                        <button type = 'button' class ='btn btn-danger deleteBtn' >Delete</button>
                        <button type = 'button' class ='btn btn-primary addQuanBtn' >Add quantity</button>
                    </td>
                </tr>
            ";
        }
        echo $html;
        }else{
            echo "no data found";
        }
    }
    
    
?>