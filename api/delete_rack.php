<?php
include_once("config.php");
    $data=array();	
	
	$rack_id = $_POST['rack_id'];

	$sqldlt=mysqli_query($db_handle,"DELETE FROM tbl_rack WHERE id='".$rack_id."'");
	$sqldlt1=mysqli_query($db_handle,"DELETE FROM tbl_warehouse_to_rack WHERE rack_id='".$rack_id."'");
	
	if($sqldlt==true && $sqldlt1==TRUE)
	{
	    $data['status']="Successfully removed";
        print(json_encode($data));
        mysqli_close($db_handle);
	}
	else
	{
	    $data['status']="Error";
	    print(json_encode($data));
        mysqli_close($db_handle);
	}
?>	