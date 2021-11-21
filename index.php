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
            <div class="top_container">
                <div class="dashbord_content">
                    <h3 id="total_products"></h3>
                    <h5>Total Products</h5>
                </div>
            </div>
            <div class="top_container">
                <div class="dashbord_content">
                    <h3 id="total_orders">0</h3>
                    <h5>Total Orders</h5>
                </div>
            </div>
            <div class="top_container">
                <div class="dashbord_content">
                    <h3 id="low_stocks">0</h3>
                    <h5>Low Stocks</h5>
                </div>
            </div>
            <div class="top_container">
                <div class="dashbord_content">
                    <h3 id="out_of_stocks">0</h3>
                    <h5>Out Of Stocks</h5>
                </div>
            </div>
        </div>
        
        <div class="endingInventory" >
            <!-- <input type="text" class="form-control" name="datepicker" id="datepicker"/> -->
            <button class="btn btn-success" id="endingInventory">Get Ending Inventory</button>
        </div>
        <div class="charts">
            <input type="text" class="yearpicker form-control" id="picker"/>
            <!-- <select name="" id="select_year">
                <option value="2019">2019</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
            </select> -->
            <canvas id="myChart"></canvas>
        </div>

        <div class="schart">
            <select name="" id="category">
                <?php 
                    include("mysqli.php");
                    $catSql = "SELECT * FROM category_table";
                    $cat = $con->query($catSql);
    
                    while($row = $cat->fetch_assoc()){
                        echo '<option value="'.$row['category'].'">'.$row['category'].'</option>'; 
                ?>
                <?php } ?>
            </select>
            <canvas id="secondChart"></canvas>
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
            $.ajax({
                method:"POST",
                url:"dashboard.php",
                dataType:"JSON",
                success: function(res){
                    console.log(res.total_products);
                    $("#total_products").text(res.total_products);
                    $("#total_orders").text(res.total_orders);
                    $("#out_of_stocks").text(res.out_of_stocks);
                }
            });
            // btn get ending inventory
            $("#endingInventory").click(function(){
                $.ajax({
                    method:"POST",
                    url:"ending_inventory.php",
                    success: function(res){
                        alert("success");
                    }
                });
            });
            //first graph
            const labels = [
                    'January',
                    'February',
                    'March',
                    'April',
                    'May',
                    'June',
                    'July',
                    'August',
                    'September',
                    'October',
                    'November',
                    'December'
                ];
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Product purchased',
                        data: [],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)'
                            
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                        ],
                        borderWidth: 1
                    },{
                        label: 'Sales',
                        data: [],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)'
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                        ],
                        borderWidth: 1
                    },{
                        label: 'Ending Inventory',
                        data: [],
                        backgroundColor: [                            
                            'rgba(255, 206, 86, 0.2)',
                        ],
                        borderColor: [                           
                            'rgba(255, 206, 86, 1)',                            
                        ],
                        borderWidth: 1
                    },{
                        label: 'Profit',
                        data: [],
                        backgroundColor: [                      
                            'rgba(75, 192, 192, 0.2)',                           
                        ],
                        borderColor: [                       
                            'rgba(75, 192, 192, 1)',                           
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio:false,
                    scales: {
                        
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            //second graph
            const ctx1 = document.getElementById('secondChart').getContext('2d');
            const secondChart = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Product purchased',
                        data: [],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)'
                            
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                        ],
                        borderWidth: 1
                    },{
                        label: 'Sales',
                        data: [],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)'
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                        ],
                        borderWidth: 1
                    },{
                        label: 'Ending Inventory',
                        data: [],
                        backgroundColor: [                            
                            'rgba(255, 206, 86, 0.2)',
                        ],
                        borderColor: [                           
                            'rgba(255, 206, 86, 1)',                            
                        ],
                        borderWidth: 1
                    },{
                        label: 'Profit',
                        data: [],
                        backgroundColor: [                      
                            'rgba(75, 192, 192, 0.2)',                           
                        ],
                        borderColor: [                       
                            'rgba(75, 192, 192, 1)',                           
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio:false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            // $.ajax({
            //     type:"POST",
            //     url:"show_revenue.php",
            //     data:{year_now:year_now},
            //     dataType:"JSON",
            //     success: function(res){

            //     }
            // });
        
            
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
            //                 res.december_revenue
                                // ],
            //         }]
            //     };
                
            //     // 
               
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
            
            const d = new Date();
            let year_now = d.getFullYear();
            // ------------------------first chart----------------
            $.ajax({
                type:"POST",
                url:"show_revenue.php",
                data:{value:year_now},
                dataType:"JSON",
                success: function(res){
                    // console.log(year_now);
                    myChart.data.datasets[0].data = [
                        res.january_capital,
                        res.feb_capital,
                        res.march_capital,
                        res.april_capital,
                        res.may_capital,
                        res.june_capital,
                        res.july_capital,
                        res.august_capital,
                        res.september_capital,
                        res.october_capital,
                        res.november_capital,
                        res.december_capital,
                    ];
                    myChart.data.datasets[1].data = [
                        res.january_sold,
                        res.feb_sold,
                        res.march_sold,
                        res.april_sold,
                        res.may_sold,
                        res.june_sold,
                        res.july_sold,
                        res.agust_sold,
                        res.september_sold,
                        res.october_sold,
                        res.november_sold,
                        res.december_sold,
                    ];
                    myChart.data.datasets[2].data = [
                        res.january_ending_inventory,
                        res.feb_ending_inventory,
                        res.march_ending_inventory,
                        res.april_ending_inventory,
                        res.may_ending_inventory,
                        res.june_ending_inventory,
                        res.july_ending_inventory,
                        res.august_ending_inventory,
                        res.september_ending_inventory,
                        res.october_ending_inventory,
                        res.november_ending_inventory,
                        res.december_ending_inventory
                    ];
                    myChart.data.datasets[3].data = [
                        res.january_revenue,
                        res.feb_revenue,
                        res.march_revenue,
                        res.april_revenue,
                        res.may_revenue,
                        res.june_revenue,
                        res.july_revenue,
                        res.august_revenue,
                        res.september_revenue,
                        res.october_revenue,
                        res.november_revenue,
                        res.december_revenue
                    ];
                    myChart.update();
                }
            });
            // ------------------end first chart------------------

            // ---------------------second chart-------------------
            var selected_category = $("#category").val();
            $.ajax({   
                type:"POST",
                url:"change_year.php",
                data:{value:year_now,
                    selected_category:selected_category
                    },
                dataType:"JSON",
                success: function(res){
                    console.log(selected_category);
                    secondChart.data.datasets[0].data = [
                        res.january_capital,
                        res.feb_capital,
                        res.march_capital,
                        res.april_capital,
                        res.may_capital,
                        res.june_capital,
                        res.july_capital,
                        res.august_capital,
                        res.september_capital,
                        res.october_capital,
                        res.november_capital,
                        res.december_capital,
                    ];
                    secondChart.data.datasets[1].data = [
                        res.january_sold,
                        res.feb_sold,
                        res.march_sold,
                        res.april_sold,
                        res.may_sold,
                        res.june_sold,
                        res.july_sold,
                        res.agust_sold,
                        res.september_sold,
                        res.october_sold,
                        res.november_sold,
                        res.december_sold,
                    ];
                    secondChart.data.datasets[2].data = [
                        res.january_ending_inventory,
                        res.feb_ending_inventory,
                        res.march_ending_inventory,
                        res.april_ending_inventory,
                        res.may_ending_inventory,
                        res.june_ending_inventory,
                        res.july_ending_inventory,
                        res.august_ending_inventory,
                        res.september_ending_inventory,
                        res.october_ending_inventory,
                        res.november_ending_inventory,
                        res.december_ending_inventory
                    ];
                    secondChart.data.datasets[3].data = [
                        res.january_revenue,
                        res.feb_revenue,
                        res.march_revenue,
                        res.april_revenue,
                        res.may_revenue,
                        res.june_revenue,
                        res.july_revenue,
                        res.august_revenue,
                        res.september_revenue,
                        res.october_revenue,
                        res.november_revenue,
                        res.december_revenue
                    ];
                    secondChart.update();
                }
            });
            // ----------------------end second chart---------------
            
            // ------------------------change year---------------------
            $("#picker").yearpicker({
                year : year_now,
                onChange : function(value){
                    //first graph
                    $.ajax({
                        type:"POST",
                        url:"show_revenue.php",
                        data:{value:value},
                        dataType:"JSON",
                        success: function(res){
                            console.log(value);
                            myChart.data.datasets[0].data = [
                                res.january_capital,
                                res.feb_capital,
                                res.march_capital,
                                res.april_capital,
                                res.may_capital,
                                res.june_capital,
                                res.july_capital,
                                res.august_capital,
                                res.september_capital,
                                res.october_capital,
                                res.november_capital,
                                res.december_capital,
                            ];
                            myChart.data.datasets[1].data = [
                                res.january_sold,
                                res.feb_sold,
                                res.march_sold,
                                res.april_sold,
                                res.may_sold,
                                res.june_sold,
                                res.july_sold,
                                res.agust_sold,
                                res.september_sold,
                                res.october_sold,
                                res.november_sold,
                                res.december_sold,
                            ];
                            myChart.data.datasets[2].data = [
                                res.january_ending_inventory,
                                res.feb_ending_inventory,
                                res.march_ending_inventory,
                                res.april_ending_inventory,
                                res.may_ending_inventory,
                                res.june_ending_inventory,
                                res.july_ending_inventory,
                                res.august_ending_inventory,
                                res.september_ending_inventory,
                                res.october_ending_inventory,
                                res.november_ending_inventory,
                                res.december_ending_inventory
                            ];
                            myChart.data.datasets[3].data = [
                                res.january_revenue,
                                res.feb_revenue,
                                res.march_revenue,
                                res.april_revenue,
                                res.may_revenue,
                                res.june_revenue,
                                res.july_revenue,
                                res.august_revenue,
                                res.september_revenue,
                                res.october_revenue,
                                res.november_revenue,
                                res.december_revenue
                            ];
                            myChart.update();
                        }
                    });
                    // second graph
                    $.ajax({
                        type:"POST",
                        url:"change_year.php",
                        data:{value:value,
                            selected_category:selected_category
                            },
                        dataType:"JSON",
                        success: function(res){
                            console.log(selected_category);
                            
                            secondChart.data.datasets[0].data = [
                                res.january_capital,
                                res.feb_capital,
                                res.march_capital,
                                res.april_capital,
                                res.may_capital,
                                res.june_capital,
                                res.july_capital,
                                res.august_capital,
                                res.september_capital,
                                res.october_capital,
                                res.november_capital,
                                res.december_capital,
                            ];
                            secondChart.data.datasets[1].data = [
                                res.january_sold,
                                res.feb_sold,
                                res.march_sold,
                                res.april_sold,
                                res.may_sold,
                                res.june_sold,
                                res.july_sold,
                                res.agust_sold,
                                res.september_sold,
                                res.october_sold,
                                res.november_sold,
                                res.december_sold,
                            ];
                            secondChart.data.datasets[2].data = [
                                res.january_ending_inventory,
                                res.feb_ending_inventory,
                                res.march_ending_inventory,
                                res.april_ending_inventory,
                                res.may_ending_inventory,
                                res.june_ending_inventory,
                                res.july_ending_inventory,
                                res.august_ending_inventory,
                                res.september_ending_inventory,
                                res.october_ending_inventory,
                                res.november_ending_inventory,
                                res.december_ending_inventory
                            ];
                            secondChart.data.datasets[3].data = [
                                res.january_revenue,
                                res.feb_revenue,
                                res.march_revenue,
                                res.april_revenue,
                                res.may_revenue,
                                res.june_revenue,
                                res.july_revenue,
                                res.august_revenue,
                                res.september_revenue,
                                res.october_revenue,
                                res.november_revenue,
                                res.december_revenue
                            ];
                            secondChart.update();
                        }
                    });
                }
            });
            // --------------------second chart change category------------
            $("#category").on('change',function(){
                        var change_cat = $(this).val();
                        var year = $("#picker").val();
                        // console.log(year);
                        $.ajax({
                        type:"POST",
                        url:"change_year.php",
                        data:{value:year,
                            selected_category:change_cat
                            },
                        dataType:"JSON",
                        success: function(res){
                            // console.log(res.year_now);
                            secondChart.data.datasets[0].data = [
                                res.january_capital,
                                res.feb_capital,
                                res.march_capital,
                                res.april_capital,
                                res.may_capital,
                                res.june_capital,
                                res.july_capital,
                                res.august_capital,
                                res.september_capital,
                                res.october_capital,
                                res.november_capital,
                                res.december_capital,
                            ];
                            secondChart.data.datasets[1].data = [
                                res.january_sold,
                                res.feb_sold,
                                res.march_sold,
                                res.april_sold,
                                res.may_sold,
                                res.june_sold,
                                res.july_sold,
                                res.agust_sold,
                                res.september_sold,
                                res.october_sold,
                                res.november_sold,
                                res.december_sold,
                            ];
                            secondChart.data.datasets[2].data = [
                                res.january_ending_inventory,
                                res.feb_ending_inventory,
                                res.march_ending_inventory,
                                res.april_ending_inventory,
                                res.may_ending_inventory,
                                res.june_ending_inventory,
                                res.july_ending_inventory,
                                res.august_ending_inventory,
                                res.september_ending_inventory,
                                res.october_ending_inventory,
                                res.november_ending_inventory,
                                res.december_ending_inventory
                            ];
                            secondChart.data.datasets[3].data = [
                                res.january_revenue,
                                res.feb_revenue,
                                res.march_revenue,
                                res.april_revenue,
                                res.may_revenue,
                                res.june_revenue,
                                res.july_revenue,
                                res.august_revenue,
                                res.september_revenue,
                                res.october_revenue,
                                res.november_revenue,
                                res.december_revenue
                            ];
                            secondChart.update();
                            }
                        });

                    });
            // ----------------------end second chart change category-----------
            // console.log($('#picker').val());

            
            
            
        });
        
        
    </script>
</body>
</html>