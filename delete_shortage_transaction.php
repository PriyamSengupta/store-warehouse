<?php 

	session_start();

	if(@$_SESSION['valid_admin'] == "" )
	{
		@header("Location:login.php");
	}

	include_once("include/inc.php");

	    $id = $_REQUEST['id'];
	    $sqldlt=mysqli_query($db_handle,"UPDATE tbl_shortage_transaction SET status='0' WHERE id='".$id."'");    
	    header("location:shortage_transaction.php?msg=3");

?>