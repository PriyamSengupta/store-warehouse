<?php 

	session_start();

	if(@$_SESSION['valid_admin'] == "" )
	{
		@header("Location:login.php");
	}

	include_once("include/inc.php");

	$product_id = $_REQUEST['id'];

	$sqldlt1=mysqli_query($db_handle,"DELETE FROM tbl_returned_product WHERE id='".$product_id."'");
	header("location:returned_stock_list.php?msg=3");
?>