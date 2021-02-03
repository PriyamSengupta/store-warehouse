<?php 

	session_start();

	if(@$_SESSION['valid_admin'] == "" )
	{

		@header("Location:login.php");
	}

	include_once("include/inc.php");
	$id=$_REQUEST['id'];
	if ($id==0) {
		
		$sqladd=mysqli_query($db_handle,"SELECT * FROM tbl_sku WHERE name='".mysqli_real_escape_string($db_handle,$_REQUEST['name'])."'");
		if(mysqli_num_rows($sqladd)>0)
		{
			echo "false";
		}
		else 
		{
			echo "true";
		}		
	}
	else
	{
		$sqladd=mysqli_query($db_handle,"SELECT name FROM tbl_sku WHERE name='".mysqli_real_escape_string($db_handle,$_REQUEST['name'])."' AND id!='".$id."'");
		if(mysqli_num_rows($sqladd)>0)
		{
			echo "false";
		}
		else 
		{
			echo "true";
		}
	}	
	?>