<?php 

//index.php

include('database_connection.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Search PG</title>

    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href = "css/jquery-ui.css" rel = "stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <style>
        h2,h3{
            color: #70351f;
        }
    </style>
</head>

<body>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
        	<br />
        	<h2 align="center">SEARCH PG</h2>
        	<br />
            <div class="col-md-3">                				
				<div class="list-group">
					<h3>Price</h3>
					<input type="hidden" id="hidden_minimum_price" value="0" />
                    <input type="hidden" id="hidden_maximum_price" value="10000" />
                    <p id="price_show">₹0 - ₹10000</p>
                    <div id="price_range"></div>
                </div>				
                <div class="list-group">
					<h3>Facility</h3>
                    <div style="height: 100px; overflow-y: auto; overflow-x: hidden;">
					<?php

                    $query = "SELECT DISTINCT(facility) FROM pginfo WHERE status = '1' ORDER BY id DESC";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector facility" value="<?php echo $row['facility']; ?>"  > <?php echo $row['facility']; ?></label>
                    </div>
                    <?php
                    }

                    ?>
                    </div>
                </div>

				<div class="list-group">
					<h3>Gender</h3>
                    <?php
                    $query = "SELECT DISTINCT(gender) FROM pginfo WHERE status = '1' ORDER BY gender DESC";
                   
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector gender" value="<?php echo $row['gender']; ?>" > <?php echo $row['gender']; ?></label>
                    </div>
                    <?php    
                    }

                    ?>
                </div>
				
				<div class="list-group">
					<h3>Sharing</h3>
                    <?php
                   $query = "SELECT DISTINCT(share) FROM pginfo WHERE status = '1' ORDER BY share ASC";
                   
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector share" value="<?php echo $row['share']; ?>" > <?php echo $row['share']; ?></label>
                    </div>
                    <?php    
                    }

                    ?>
                </div>

                <div class="list-group">
					<h3>Food</h3>
					<?php
                    $query = " SELECT DISTINCT(food) FROM pginfo WHERE status = '1' ORDER BY food DESC ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector food" value="<?php echo $row['food']; ?>"  > <?php echo $row['food']; ?></label>
                    </div>
                    <?php
                    }
                    ?>	
                </div>
            </div>

            <div class="col-md-9">
            	<br />
                <div class="row filter_data">

                </div>
            </div>
        </div>

    </div>
<style>
#loading
{
	text-align:center; 
	background: url('loader.gif') no-repeat center; 
	height: 150px;
}
</style>

<script>
$(document).ready(function(){

    filter_data();

    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var facility = get_filter('facility');
        var gender = get_filter('gender');
        var share = get_filter('share');
        var food = get_filter('food');

        var min_share = Math.min.apply(Math, share); // Find the minimum selected sharing value
        var adjusted_share = []; // Adjusted array to include all numbers down to min_share
        for (var i = min_share; i <= 5; i++) { // Assuming 5 is the maximum possible sharing value
            adjusted_share.push(i);
        }
     
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{action:action, 
            minimum_price:minimum_price, 
            maximum_price:maximum_price, 
            facility:facility, 
            gender:gender,  
            share:adjusted_share, 
            food:food},
            success:function(data){
                $('.filter_data').html(data);
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

    $('#price_range').slider({
        range:true,
        min:0,
        max:10000,
        values:[0, 10000],
        step:500,
        slide:function(event, ui) {
            $('#price_show').html('₹' + ui.values[0] + ' - ₹' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
        },
        stop:function(event, ui) {
            
            filter_data();
            
            
        }
    });
    $('#price_show').html('₹' + $('#price_range').slider('values', 0) + ' - ₹' + $('#price_range').slider('values', 1));
    $('#price_range').slider("values", [0, 10000]);
});
</script>

</body>

</html>
