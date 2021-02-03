<?php

	session_start();

	if(@$_SESSION['valid_admin'] == "" )
	{
		@header("Location:login.php");
	}

	include_once("include/inc.php");

	$product_id = $_REQUEST['id'];
	
	$sqlsel=mysqli_query($db_handle,"SELECT sku FROM tbl_products WHERE id='".$product_id."'");
    $sqlsel1=mysqli_fetch_object($sqlsel);
    $sku=$sqlsel1->sku;
	$sqlupdate1 = mysqli_query($db_handle,"UPDATE tbl_sku SET product_id='0' WHERE id='".$sku."'");
	$sqldlt=mysqli_query($db_handle,"DELETE FROM tbl_products WHERE id='".$product_id."'");
	header("location:product_list.php?msg=3");

?>