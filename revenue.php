<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="jquery-3.5.1.min.js"></script>
    <title>Revenue</title>
</head>
<body>
    <h1>total capital <span class="total_capital"></span></h1>
    <h1>total sold <span class="total_sold"></span></h1>
    <h1>total revenue <span class="total_revenue"></span></h1>

    <h1>monthly capital <span class="monthly_capital"></span></h1>
    <h1>monthly sold <span class="monthly_sold"></span></h1>
    <h1>monthly revenue <span class="monthly_revenue"></span></h1>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $(".total_capital").load("show_revenue.php");
        })
    </script>
</body>
</html>