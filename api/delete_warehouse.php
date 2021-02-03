<?php
include_once("config.php");
        $warehouse_id = $_POST['id'];

    	$sqldlt1=mysqli_query($db_handle,"DELETE FROM tbl_warehouse WHERE id='".$warehouse_id."'");
    	$sqldlt2=mysqli_query($db_handle,"DELETE FROM tbl_warehouse_to_rack WHERE warehouse_id='".$warehouse_id."'");
    	$sqlupdt=mysqli_query($db_handle,"UPDATE tbl_rack SET warehouse_id='0' WHERE warehouse_id = '".$warehouse_id."'");
        
        if($sqldlt1==true)
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