<?php 

	session_start();

	if(@$_SESSION['valid_admin'] == "" )

	{

	@header("Location:login.php");

	}

	include_once("include/inc.php");

	

	if(isset($_POST["add"]))
	{
	    $date = date('Y-m-d H:i:s');
	    $username=base64_encode(trim($_REQUEST['username']));
	    $password=base64_encode(trim($_REQUEST['password']));
	    

		$sqladd=mysqli_query($db_handle,"INSERT INTO tbl_user SET fname='".mysqli_real_escape_string($db_handle,$_REQUEST['fname'])."',lname='".mysqli_real_escape_string($db_handle,$_REQUEST['lname'])."',username='".mysqli_real_escape_string($db_handle,$username)."',password='".mysqli_real_escape_string($db_handle,$password)."',phone='".mysqli_real_escape_string($db_handle,$_REQUEST['phone'])."',email='".mysqli_real_escape_string($db_handle,$_REQUEST['email'])."',role='".mysqli_real_escape_string($db_handle,$_REQUEST['usergroup'])."',status='".mysqli_real_escape_string($db_handle,$_REQUEST['status_check'])."',flag='1',creation_date='".$date."'");

		header("location:user_list.php?msg=1");
		//echo "<script type='text/javascript'>window.parent.location.reload()</script>";

	}
?>