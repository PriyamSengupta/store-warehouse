<?php 

	session_start();

	if(@$_SESSION['valid_admin'] == "" )
	{
		@header("Location:login.php");
	}

	include_once("include/inc.php");

	$warehouse_id = $_REQUEST['id'];
	
	$sqlcheck=mysqli_query($db_handle,"SELECT * FROM tbl_rack WHERE warehouse_id='".$warehouse_id."'");
	if(mysqli_num_rows($sqlcheck)==0)
	{
	   // $sqldlt1=mysqli_query($db_handle,"DELETE FROM tbl_warehouse WHERE id='".$warehouse_id."'");
	    $sqlupdt=mysqli_query($db_handle,"UPDATE tbl_warehouse SET flag='0' WHERE id='".$warehouse_id."'");
	   // $sqldlt2=mysqli_query($db_handle,"DELETE FROM tbl_warehouse_to_rack WHERE warehouse_id='".$warehouse_id."'");
	    header("location:warehouse_list.php?msg=3");
	}
    else
    {
        header("location:warehouse_list.php?msg=4");
    }
	
// 	$sqlupdt=mysqli_query($db_handle,"UPDATE tbl_rack SET warehouse_id='0' WHERE warehouse_id = '".$warehouse_id."'");
	
?>