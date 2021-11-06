<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="jquery-year-picker/css/yearpicker.css" />
    <link rel="stylesheet" href="style.css">
    <!-- <link href="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
    <title>Dashboard</title>
</head>
<?php
    $page = "index";
?>
<body>
    <?php include("navbar.php");?>

    <div class="container">
        <div class="header">
            <h3>Dashboard</h3>
        </div>
        <div class="top">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <h1 id="kev"></h1>
        <div class="endingInventory" >
            <!-- <input type="text" class="form-control" name="datepicker" id="datepicker"/> -->
            <button class="btn btn-success" id="endingInventory">Get ending inventory</button>
        </div>
        <div class="chart">
            <input type="text" class="yearpicker form-control" id="picker"/>
            <canvas id="myChart"></canvas>
        </div>

    </div>
   
    <!-- ===== IONICONS ===== -->
    <!-- <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script> -->
    <!-- ===== MAIN JS ===== -->
    <!-- <script src="assets/js/main.js"></script> -->
    <!-- JavaScript Bundle with Popper -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" -->
        <!-- integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- <script src="jquery-year-picker/js/core.js"></script> -->
    <script src="jquery-year-picker/js/yearpicker.js"></script>
    <!-- <script src="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script> -->

    <script>
        $(document).ready(function(){
            const d = new Date();
            let year_now = d.getFullYear();
            $("#endingInventory").click(function(){
                $.ajax({
                    method:"POST",
                    url:"ending_inventory.php",
                    success: function(res){
                        console.log(res);
                    }
                });
            });
            
            $.ajax({
                type:"POST",
                url:"show_revenue.php",
                data:{year_now:year_now},
                dataType:"JSON",
                success: function(res){
                    const ctx = document.getElementById('myChart').getContext('2d');
                    const myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                            datasets: [{
                                label: '# of Votes',
                                data: [res.october_capital, res.october_sold, res.october_revenue, res.october_capital, res.october_sold, res.october_revenue],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }
            });
            // $.ajax({
            // type:"POST",
            // url:"show_revenue.php",
            // data:{year_now:year_now},
            // dataType:"JSON",
            // success: function(res){
            //     const labels = [
            //         'January',
            //         'February',
            //         'March',
            //         'April',
            //         'May',
            //         'June',
            //         'July',
            //         'August',
            //         'September',
            //         'October',
            //         'November',
            //         'December'
            //     ];
            //     const data = {
            //         labels: labels,
            //         datasets: [{
            //             label: 'Product purchased',
            //             backgroundColor: 'rgb(255, 99, 132)',
            //             borderColor: 'rgb(255, 99, 132)',
            //             data: [
            //                 res.january_capital,
            //                 res.feb_capital,
            //                 res.march_capital,
            //                 res.april_capital,
            //                 res.may_capital,
            //                 res.june_capital,
            //                 res.july_capital,
            //                 res.august_capital,
            //                 res.september_capital,
            //                 res.october_capital,
            //                 res.november_capital,
            //                 res.december_capital,
            //                 ]
            //         },{
            //             label: 'Sales',
            //             backgroundColor: 'rgb(255, 99, 132)',
            //             borderColor: 'rgb(255, 99, 132)',
            //             data: [
            //                 res.january_sold,
            //                 res.feb_sold,
            //                 res.march_sold,
            //                 res.april_sold,
            //                 res.may_sold,
            //                 res.june_sold,
            //                 res.july_sold,
            //                 res.agust_sold,
            //                 res.september_sold,
            //                 res.october_sold,
            //                 res.november_sold,
            //                 res.december_sold,
            //                 ]
            //         },{
            //             label: 'Ending inventory',
            //             backgroundColor: 'rgb(255, 99, 132)',
            //             borderColor: 'rgb(255, 99, 132)',
            //             data: [
            //                 res.january_ending_inventory,
            //                 res.feb_ending_inventory,
            //                 res.march_ending_inventory,
            //                 res.april_ending_inventory,
            //                 res.may_ending_inventory,
            //                 res.june_ending_inventory,
            //                 res.july_ending_inventory,
            //                 res.august_ending_inventory,
            //                 res.september_ending_inventory,
            //                 res.october_ending_inventory,
            //                 res.november_ending_inventory,
            //                 res.december_ending_inventory
            //                 ]
            //         },{
            //             label: 'Profit',
            //             backgroundColor: 'rgb(255, 99, 132)',
            //             borderColor: 'rgb(255, 99, 132)',
            //             data: [
            //                 res.january_revenue,
            //                 res.feb_revenue,
            //                 res.march_revenue,
            //                 res.april_revenue,
            //                 res.may_revenue,
            //                 res.june_revenue,
            //                 res.july_revenue,
            //                 res.august_revenue,
            //                 res.september_revenue,
            //                 res.october_revenue,
            //                 res.november_revenue,
            //                 res.december_revenue],
            //         }]
            //     };
            //     const config = {
            //         type: 'bar',
            //         data: data,
            //         options: {}
            //     };
            //     var myChart = new Chart(
            //     document.getElementById('myChart'),
            //     config
            //     );
            // }
            // });
            $("#picker").yearpicker({
                year : year_now,
                onChange : function(value){
                    $.ajax({
                        type:"POST",
                        url:"change_year.php",
                        data:{value:value},
                        dataType:"JSON",
                        success: function(res){
                            // myChart.data.datasets[0].data = [
                            //     4,5,6,7,8,9
                            // ];
                            // myChart.update();
                            console.log("skefsndjfn");
                        }
                    });
                }
            });
            
            
            
        });
        
        
    </script>
</body>
</html>