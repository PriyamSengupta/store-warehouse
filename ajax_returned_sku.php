<?php
	session_start();

	if(@$_SESSION['valid_admin'] == "" )
	{
		@header("Location:login.php");
	}

	include_once("include/inc.php");

	$sku=$_REQUEST['sku'];

// 	$sqlQuery=mysqli_query($db_handle,"SELECT * FROM tbl_sku s LEFT JOIN tbl_products p ON p.sku=s.id WHERE s.name='".mysqli_real_escape_string($db_handle,$sku)."'");
// 	$sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_sku s LEFT JOIN tbl_combo_product cp ON cp.sku=s.id WHERE s.name='".mysqli_real_escape_string($db_handle,$sku)."'");

    $sqlQ=mysqli_query($db_handle,"SELECT * FROM tbl_sku WHERE name='".mysqli_real_escape_string($db_handle,$sku)."' AND (product_id!='0' OR combo_product_id!='0') AND flag='1'");
// 	$count=mysqli_num_rows($sqlQ);
	if(mysqli_num_rows($sqlQ)>0)
	{ 	
         	$response=1;
	}	
	else
	{
		$response=0;
	}
	echo $response;
?>