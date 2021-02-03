<?php
	session_start();

	if(@$_SESSION['valid_admin'] == "" )
	{

		@header("Location:login.php");
	}

	include_once("include/inc.php");

	$product_id=$_REQUEST['product'];

	$sqlQuery=mysqli_query($db_handle,"SELECT unit_price,quantity FROM tbl_products WHERE id='".$product_id."'");
	if(mysqli_num_rows($sqlQuery)>0)
	{	
		$sqlResult=mysqli_fetch_object($sqlQuery);
		$response=array(
		    'unit_price'=>$sqlResult->unit_price,
		    'quantity'=>$sqlResult->quantity
		    ); 
	header('Content-Type: application/json');
    echo json_encode($response);
	   // echo $sqlResult->unit_price;
	}
	?>