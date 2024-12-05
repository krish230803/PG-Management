<?php

//fetch_data.php

include('database_connection.php');

if(isset($_POST["action"]))
{
	$query = " SELECT * FROM pginfo WHERE status = '1' ";
	if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	{
		$query .= " AND price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
		";
	}
	if(isset($_POST["facility"]))
	{
		$facility_filter = implode("','", $_POST["facility"]);
		$query .= " AND facility IN('".$facility_filter."') ";
	}
	if(isset($_POST["gender"]))
	{
		$gender_filter = implode("','", $_POST["gender"]);
		$query .= " AND gender IN('".$gender_filter."') ";
	}
	if(isset($_POST["share"]))
	{
		$share_filter = implode("','", $_POST["share"]);
		$query .= " AND share IN('".$share_filter."') ";
	}
	if(isset($_POST["food"]))
	{
		$food_filter = implode("','", $_POST["food"]);
		$query .= " AND food IN('".$food_filter."') ";
	}

	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_row = $statement->rowCount();
	$output = '';
	if($total_row > 0)
	{
		foreach($result as $row)
		{
			$output .= '
			<style>
			#log1{
  
				width: 100%;
				height: 25px;
				border: none;
				outline: none;
				border-radius: 40px;
				cursor: pointer;
				font-size: 1em;
				color: #fff;
				font-weight: 500;
				background: #865b4b;
				transition: all 0.2s ease;
			  }
			  
			  #log1:hover{
				background: #70351f;
			  }
			</style>
			<div class="col-sm-4 col-lg-3 col-md-3">
    <div style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px; height:450px; display: flex; flex-direction: column;">
        <div style="flex-grow: 1;">
            <img src="DATA/'. $row['image'].'" alt="" class="img-responsive">
          
        </div>
		<h4 align="center"><strong><a href="#"> '. $row['pg_name'] .' </a></strong></h4>
		<p style="text-align:center;" class="text-danger">From: ₹ ' .$row['price'] . ' </p>
		
		<p>
                    Facility : '.$row['facility'] .' <br />
                    Gender : ' . $row['gender'] .' <br />
                    Sharing : Upto ' . $row['share'] .' Person<br />
                    Food : ' . $row['food'] .'
                </p>
        <button type="submit" id="log1" name="explore"><a href="pg_details.php?id='.$row['id'].'" style="text-decoration: none; color: inherit;">Explore</a></button>
    </div>
</div>
';
		}
	}
	else
	{
		$output = '<h3>No Data Found</h3>';
	}
	echo $output;
}

?>