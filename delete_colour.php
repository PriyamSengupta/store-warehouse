<?php

	session_start();

	if(@$_SESSION['valid_admin'] == "" )
	{
		@header("Location:login.php");
	}

	include_once("include/inc.php");

	$colour_id = $_REQUEST['id'];

	$sqldlt=mysqli_query($db_handle,"DELETE FROM tbl_colour WHERE id='".$colour_id."'");
	//$sqldlt1=mysqli_query($db_handle,"DELETE FROM tbl_warehouse_to_rack WHERE rack_id='".$colour_id."'");

	header("location:colour_list.php?msg=3");

?>