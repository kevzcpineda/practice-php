<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "student_info";
$con = new mysqli($servername,$username,$password,$db);
require_once __DIR__ . '/vendor/autoload.php';

$id = $_GET['id'];
$customerName = "";
$total = "";
$order_table_sql = "SELECT * FROM order_table WHERE id='$id'";
$order_table_result = mysqli_query($con,$order_table_sql);
while($row = mysqli_fetch_array($order_table_result)){
    $customerName = $row['customer_name'];
    $total = $row['total'];
}

$sql = "SELECT * FROM sale_record WHERE product_id='$id'";
$result = mysqli_query($con,$sql);
$row_data = "";
$count = 0;
while($row = mysqli_fetch_array($result)){
    $count = $count + 1;
    $row_data = $row_data."
        <tr>
            <td>".$count."</td>
            <td>".$row['product_name']."</td>
            <td>".$row['quantity']."</td>
            <td>".$row['unit']."</td>
            <td>".$row['price']."</td>
            <td>".$row['total']."</td>
            
        </tr>
    ";
}
$html = '
    <link rel="stylesheet" href="pdf.css">
    <h5>Fx4 CONSTRUCTION SUPPLIES TRADING</h5>
    <h5>Office Add: BLCK#5 JASMINE ST. EL CANO SUBD. MC. ARTHUR H-WAY ANGELES CITY</h5>
    <h5>Email Add: fx4cst@gmail.com</h5>
    <h5>Contact no. 09663992457 or 09218502489</h5>
    
    
    <table class="ches">
        <tr>
            <td>NAME:'.$customerName.'</td>
            <td>DATE:</td>
        </tr>
        <tr>
            <td>ADDRESS:</td>
            <td>MOP:</td>
        </tr>
        <tr>
            <td>CONTACT DETAILS:</td>
            <td>ACCOUNT NAME:</td>
        </tr>
    </table>
    <table class="product">
        <tr>
            <td >Item no.</td>
            <td ></td>        
            <td >Ordered Qty</td>            
            <td >Unit</td>            
            <td >SRP/unit</td>            
            <td >Total Amount SRP</td>            
        </tr>
        
        '.$row_data.'
    </table>
    <table class="total">
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>TOTAL AMOUNT DUE:</td>
            <td>'.$total.'</td>
        </tr>
        
    </table>
    <table class="signature">
        <tr>
            <td>SALES EXECUTIVE SIG. OVER PRINTED NAME</td>
            <td>CUSTOMER SIG. OVER PRINTED NAME</td>
        </tr>
    </table>
';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output();

?>