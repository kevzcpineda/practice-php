<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Add order</title>
</head>
<body>
    <?php
        include("connect.php");
        $student = "SELECT * FROM student WHERE stock>0";
        $prepareStatement = $con->prepare($student);
        $result = $prepareStatement->execute();
        $students = $prepareStatement->fetchAll();
    ?>
    <?php include("navbar.php")?>
    </div>
    <div class="container">
        <input type="text" id="customer_name"  placeholder="Customer name" class="form-control w-25 mb-3">
        <select name="" id="select" class="w-25">
            <option value="">Select product</option>
            <?php foreach($students as $student){?>
                <option value=<?php echo $student['id']?>><?php echo $student['product']?> | <?php echo $student['brand']?></option>
            <?php }?>
        </select>
        <h5>Available stock:<span id="available_stock"></span></h5>
        
        <input type="number" id="quantity">
        <button type="button" id="submit" class="btn btn-primary">Add product</button>
    
        <table class="table mt-3" id="t" >
            <thead>
                <tr>      
                    <th scope="col">Product</th>                   
                    <th scope="col">Product category</th>
                    <th scope="col">Item category</th>
                    <th scope="col">Brand</th> 
                    <th scope="col">Listing price</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col">Unit</th>
                    <th scope="col">Action</th>
                </tr>
            </thead >
            <tbody id="tbody">
            </tbody>
        </table>
        <hr>
        <div class="order_and_total">
            <button class="btn btn-success" id="save_btn">Order</button>
            <h6 class="total_purchased">Total: <span id="total_order"></span></h6>
            
        </div>
        
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="jquery-tabledit-1.2.3/jquery.tabledit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
<script>
    $(document).ready(function(){
        
        var count = 0;
        $("#select").chosen();
        $("#select").on('change',function(){
            var id = $(this).val();  
            $.ajax({
                type:"POST",
                url:"show_available.php",
                data:{id:id},
                success:function(data){
                    console.log(data);
                    $("#available_stock").text(data);
                }
            });
        
        });


        $("#submit").click(function(){
        
            var product_id = $("select").val();
            var add_product_btn = $("#submit").val();
            var quantity = $("#quantity").val();
            var available_stock = parseFloat($("#available_stock").text());
            var total_orders = [];
            var total = 0;
            count = count+1;
            // $("#tbody").append(html);
            
            console.log(quantity);
            console.log(available_stock);
            // if(available_stock>quantity){
            //     console.log("order");
            // }else{
            //     console.log("cant order");
            // }
            console.log(total_orders);
            $.ajax({
                type:"POST",
                url:"add_product_table.php",
                data:{product_id:product_id,
                    quantity:quantity,
                    available_stock:available_stock
                },
                dataType:"JSON",
                success:function(res){
                    if(quantity>0 && quantity<=available_stock){
                        // display table data
                        $("#tbody").append('<tr row_id="'+product_id+'"><td class="product">'+res.product+'</td><td class="category">'+res.category+'</td><td class="item_category">'+res.item_category+'</td><td class="brand">'+res.brand+'</td><td class="listing_price">'+res.listing_price+'</td><td><div class="retail_price row_data" edit_type="click" col_name="retail_price">'+res.retail_price+'</div></td><td class="quantity">'+res.quantity+'</td><td class="total">'+res.total+'</td><td class="unit">'+res.unit+'</td><td><button type="button"class="btn btn-success edit" data-row="row'+count+'" name="edit'+count+'">Edit</button></td> <td><button type="button" class="btn btn-primary save_edit" row_id="'+product_id+'" name="edit'+count+'">Save</button></td><td><button type="button" class="btn btn-secondary cancel_edit" row_id="'+product_id+'" name="edit'+count+'">Cancel</button></td><td><button type="button"class="btn btn-danger delete" data-row="row'+count+'" name="remove'+count+'">Delete</button></td></tr>');
                        // reset quantity value
                        $("#quantity").val("");
                        //display new available stock
                        var new_available_stock = available_stock - quantity;
                        $("#available_stock").text(new_available_stock);
                        //get total order
                        $('.total').each(function(){
                            total_orders.push(parseFloat($(this).text()));
                        });
                        total_orders.forEach(myFunction);
                        function myFunction(item){
                            total += item;
                        }
                        //display total order
                        $("#total_order").text(total);
                        console.log($("#total_order").text());

                        $(document).find('.save_edit').hide();
                        $(document).find('.cancel_edit').hide();
                        
                    }else{
                        alert("error");
                    }
                    
                },
                error:function(data, textStatus,errorThrown){
                    console.log(data.error);
                }
            });
        });   

        // $('#editTable').Tabledit({
        //     url: 'example.php',
        //     columns: {
        //         identifier: [0, 'id'],   
        //         editable: [[1, 'col1']]

        //     },
        // });
        
        $(document).on('click','.edit', function(event){
            event.preventDefault();
            var tbl_row = $(this).closest('tr');
            // var data = $tr.children("td").map(function(){
            //     return $(this).text();
            // }).get();

            var row_id = tbl_row.attr("row_id");

            tbl_row.find('.save_edit').show();
            tbl_row.find('.cancel_edit').show();

            tbl_row.find('.edit').hide();
            
            tbl_row.find('.row_data')
            .attr('contenteditable','true')
            .attr('edit_type','button')
            .addClass('bg-warning')
            .css('padding','3px')

            tbl_row.find('.row_data').each(function(index,val){
                $(this).attr('original_entry',$(this).html());
            });
            // tbl_row.find('.row_data').attr('original_entry',$(this).html());

            console.log(row_id);
        });

        $(document).on('click','.cancel_edit', function(event){
            event.preventDefault();

            var tbl_row = $(this).closest('tr');
            var row_id = tbl_row.attr("row_id");

            tbl_row.find('.save_edit').hide();
            tbl_row.find('.cancel_edit').hide();

            tbl_row.find('.edit').show();

            tbl_row.find('.row_data')
            .attr('edit_type','click')
            .removeAttr('contenteditable')
            .removeClass('bg-warning')
            .css('padding','')

            tbl_row.find('.row_data').each(function(index, val){
                $(this).html($(this).attr('original_entry'));
            });
            // tbl_row.find('.row_data').$(this).html($(this).attr('original_entry'));
        });
        
        $(document).on('click','.save_edit', function(event){
            event.preventDefault();
            var tbl_row = $(this).closest('tr');
            var data = tbl_row.children("td").map(function(){
                return $(this).text();
            }).get();
            
            var row_id = tbl_row.attr("row_id");
            var col = tbl_row.attr("col_name");

            tbl_row.find('.save_edit').hide();
            tbl_row.find('.cancel_edit').hide();

            tbl_row.find('.edit').show();

            tbl_row.find('.row_data')
            .attr('edit_type','click')
            .removeAttr('contenteditable')
            .removeClass('bg-warning')
            .css('padding','')

            // tbl_row.find('.row_data').each(function(index, val){
            //     var col_name = $(this).attr('col_name');
            //     var col_val = $(this).html;
            //     console.log(col_name);
            //     console.log(row_id);
            // });
    
            var price = parseFloat(data[5]);
            var qty = parseFloat(data[6]);
            var total = data[7];
            var total_order = $('#total_order').text();
            console.log(price);
            console.log(qty);
            console.log(total);
            console.log(total_order);
            var new_total_order = total_order - total;
            console.log(new_total_order);
            var new_total = price * qty;
            var new_total_order = new_total_order + new_total;
            tbl_row.find('.total').text(new_total.toFixed(2));
            console.log(new_total_order);
            $("#total_order").text(new_total_order.toFixed(2));
        });
        

        $(document).on('click','.delete', function(){
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function(){
                return $(this).text();
            }).get();
            console.log(data);
            var product_total = data[7];
            var total = $('#total_order').text();
            var update_total = total - product_total;
            $("#total_order").text(update_total);
            
            var quantity = parseFloat(data[6]);
            var available_stock = parseFloat($("#available_stock").text());
            var update_quantity = quantity + available_stock;
            $("#available_stock").text(update_quantity);
            $(this).closest('tr').remove();
        }); 


        $("#save_btn").click(function(){
            var total_order = $("#total_order").text();
            var customer_name = $("#customer_name").val();
            var product = [];
            var brand = [];
            var category = [];
            var item_category = [];
            var retail_price = [];
            var quantity = [];
            var listing_price = [];
            var total = [];
            var unit = [];
            

            $('.product').each(function(){
                product.push($(this).text());
            });
            $('.brand').each(function(){
                brand.push($(this).text());
            });
            $('.category').each(function(){
                category.push($(this).text());
            });
            $('.item_category').each(function(){
                item_category.push($(this).text());
            });
            $('.listing_price').each(function(){
                listing_price.push($(this).text());
            });
            
            $('.retail_price').each(function(){
                retail_price.push($(this).text());
            });
            $('.total').each(function(){
                total.push($(this).text());
            });
            $('.quantity').each(function(){
                quantity.push($(this).text());
            });
            $('.unit').each(function(){
                unit.push($(this).text());
            });

            if(customer_name == ""){
                alert("input customer name");
            }else{
                if(count>0){
                    console.log(listing_price);
                    console.log(retail_price);
                    console.log(item_category);
                    $.ajax({
                    url:"insert_order.php",
                    method:"POST",
                    data:{
                        customer_name:customer_name,
                        product:product,
                        brand:brand,
                        category:category,
                        item_category:item_category,
                        retail_price:retail_price,
                        quantity:quantity,
                        listing_price:listing_price,
                        total:total,
                        total_order:total_order,
                        unit:unit,
                        count:count
                    },
                    success:function(data){
                        window.location.href = "sales.php";
                    }
                    });
                }else{
                    alert("no item addded");
                }
                
            }
            
            
        });
    });

</script>
</html>