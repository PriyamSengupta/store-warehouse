<?php
	session_start();

	if(@$_SESSION['valid_admin'] == "" )
	{
		@header("Location:login.php");
	}

	include_once("include/inc.php");

	$sku=$_REQUEST['sku'];

	$sqlQuery=mysqli_query($db_handle,"SELECT s.name FROM tbl_sku s LEFT JOIN tbl_products p ON p.sku=s.id WHERE s.name LIKE '%".mysqli_real_escape_string($db_handle,$sku)."%'");
	$sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_sku s LEFT JOIN tbl_combo_product cp ON cp.sku=s.id WHERE s.name LIKE '%".mysqli_real_escape_string($db_handle,$sku)."%'");
	
	if(mysqli_num_rows($sqlQuery)>0 || mysqli_num_rows($sqlQuery1)>0)
	{ 	
         	$response=1;
	}	
	else
	{
		    $response=0;
	}
	echo $response;
?>