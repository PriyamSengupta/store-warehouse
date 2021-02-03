<?php 

	session_start();

	if(@$_SESSION['valid_admin'] == "" )

	{

	@header("Location:login.php");

	}

	include_once("include/inc.php");

	

	if(isset($_POST["add"]))

	{

		$sqladd=mysqli_query($db_handle,"INSERT INTO tbl_colour SET name='".mysqli_real_escape_string($db_handle,$_REQUEST['colour_name'])."',creation_date=NOW(),created_by='".$_SESSION['id']."',modification_date=NOW(),modified_by='".$_SESSION['id']."'");

		//	header("location:colour_list.php?msg=1");
		echo "<script type='text/javascript'>window.parent.location.reload()</script>";

	}
	?>