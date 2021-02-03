<?php
	session_start();

	if(@$_SESSION['valid_admin'] == "" )
	{

		@header("Location:login.php");
	}

	include_once("include/inc.php");

	$id=$_REQUEST['id'];

	$sqlQuery=mysqli_query($db_handle,"SELECT unit_price,status FROM tbl_product_to_warehouse WHERE id='".$id."'");
	if(mysqli_num_rows($sqlQuery)>0)
	{	
		$sqlResult=mysqli_fetch_object($sqlQuery);
		$response=array(
		    'unit'=>$sqlResult->unit_price,
		    'status'=>($sqlResult->status=='0') ? 'Damaged' : 'Working'
		    ); 
	header('Content-Type: application/json');
    echo json_encode($response);
	   // echo $sqlResult->unit_price;
	}
	?>