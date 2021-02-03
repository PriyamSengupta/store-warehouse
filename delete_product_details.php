<?php 

	session_start();

	if(@$_SESSION['valid_admin'] == "" )

	{

	@header("Location:login.php");

	}

	include_once("include/inc.php");

	$productid = $_REQUEST['id'];
	
	
	$sqldlt=mysql_query("DELETE FROM ".TBL_PRODUCT." WHERE referance_number='".$productid."'");
	
	$sqldlt=mysql_query("DELETE FROM  tbl_reference_stockin WHERE reference_no='".$productid."'");

	header("location:product_list.php?msg=3");

?>

