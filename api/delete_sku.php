<?php
include_once("config.php");
    $data=array();	
	
	$sku_id = $_POST['sku_id'];

	$sqlcheck=mysqli_fetch_object(mysqli_query($db_handle,"SELECT product_id,combo_product_id FROM tbl_sku WHERE id='".$sku_id."'"));
	
	if($sqlcheck->product_id==0 && $sqlcheck->combo_product_id==0)
	{
	    $sqldlt=mysqli_query($db_handle,"DELETE FROM tbl_sku WHERE id='".$sku_id."'");    
	    $data['status']="Successfully removed";
        print(json_encode($data));
        mysqli_close($db_handle);
	}
    else
    {
        $data['status']="Can't remove! Product has been already assigned to this SKU.";
        print(json_encode($data));
        mysqli_close($db_handle);
    }
?>	