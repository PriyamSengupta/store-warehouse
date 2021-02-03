<?php

	session_start();

	if(@$_SESSION['valid_admin'] == "" )
	{
		@header("Location:login.php");
	}

	include_once("include/inc.php");

	$rack_id = $_REQUEST['id'];
	
	$sqlselect=mysqli_query($db_handle,"SELECT * FROM tbl_product_to_warehouse WHERE rack_id='".$rack_id."'");
	
	if(mysqli_num_rows($sqlselect)>0)
	{
	    header("location:rack_list.php?msg=4");
	}
	else
	{
	   // $sqldlt=mysqli_query($db_handle,"DELETE FROM tbl_rack WHERE id='".$rack_id."'");
	    $sqlupdt=mysqli_query($db_handle,"UPDATE tbl_rack SET flag='0' WHERE id='".$rack_id."'");
	   // $sqldlt1=mysqli_query($db_handle,"DELETE FROM tbl_warehouse_to_rack WHERE rack_id='".$rack_id."'");
	   $sqludt1=mysqli_query($db_handle,"UPDATE tbl_warehouse_to_rack SET flag='0' WHERE rack_id='".$rack_id."'");
        header("location:rack_list.php?msg=3");
	}
	

?>