<?php 

	session_start();

	if(@$_SESSION['valid_admin'] == "" )
	{
		@header("Location:login.php");
	}

	include_once("include/inc.php");

	$sku_id = $_REQUEST['id'];
	
	$sqlcheck=mysqli_fetch_object(mysqli_query($db_handle,"SELECT product_id,combo_product_id FROM tbl_sku WHERE id='".$sku_id."'"));
	
	if($sqlcheck->product_id==0 && $sqlcheck->combo_product_id==0)
	{
	   // $sqldlt=mysqli_query($db_handle,"DELETE FROM tbl_sku WHERE id='".$sku_id."'");
	    $sqldlt=mysqli_query($db_handle,"UPDATE tbl_sku SET flag='0' WHERE id='".$sku_id."'");
	    header("location:sku_list.php?msg=3");
	}
    else
    {
        header("location:sku_list.php?msg=4");
    }
?>