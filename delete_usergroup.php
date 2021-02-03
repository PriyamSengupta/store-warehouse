<?php

	session_start();

	if(@$_SESSION['valid_admin'] == "" )
	{
		@header("Location:login.php");
	}

	include_once("include/inc.php");

	$user_id = $_REQUEST['id'];

	$sqldlt=mysqli_query($db_handle,"DELETE FROM tbl_usergroup WHERE id='".$user_id."'");

	header("location:usergroup_list.php?msg=3");

?>