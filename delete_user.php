<?php

	session_start();

	if(@$_SESSION['valid_admin'] == "" )
	{
		@header("Location:login.php");
	}

	include_once("include/inc.php");

	$user_id = $_REQUEST['id'];

// 	$sqldlt=mysqli_query($db_handle,"DELETE FROM tbl_user WHERE id='".$user_id."'");
	$sqlupdt=mysqli_query($db_handle,"UPDATE tbl_user SET flag='0' WHERE id='".$user_id."'");

	header("location:user_list.php?msg=3");

?>