<?php
    include("connect.php");
    
    if(isset($_POST['product_id'])){
        $quantity = $_POST['quantity'];
        $id = $_POST['product_id'];
        $available_stock = $_POST['available_stock'];
        
        // if($quantity>=$available_stock){
        //     $data["error"] = TRUE;
        //     echo json_encode($data);
        // }else{
            $student = "SELECT * FROM student WHERE id = $id";
            $prepareStatement = $con->prepare($student);
            $result = $prepareStatement->execute();
            $students = $prepareStatement->fetch();

            $total = $quantity * $students['retail_price'];

            $data["id"] = $id;
            $data["product"] = $students['product'];
            $data["brand"] = $students['brand'];
            $data["category"] = $students['category'];
            $data["listing_price"] = $students['listing_price'];
            $data["retail_price"] = $students['retail_price'];
            $data["quantity"] = $quantity ;
            $data["total"] = $total ;

            echo json_encode($data);
        // }
        
        
    }
        // $product_count = 0;
        // $full_table="";
        // $all_purchase = new ArrayObject();

        // $all_purchase->append(array($id,$students['product'],$students['brand'],$students['category'],$students['retail_price'],$quantity,$total));
        
        // for($i=0; $i<$all_purchase->count();$i++){
        //     $full_table.="<tr>";
        //     for($j=0;$j<$all_purchase[$i]->count();$j++){
        //         $full_table .= "<td>" . $all_purchase[$i][$j] . "</td>";
        //     }
        //     $full_table .= "</tr>"; 
        // }
        // echo $full_table;
 
    
    // }
    
?>
