<?php
    
    session_start();

	if(@$_SESSION['valid_admin'] == "" )
	{

		@header("Location:login.php");
	}

	include_once("include/inc.php");
	
	$sqlremove=mysqli_query($db_handle,"TRUNCATE TABLE tbl_opening_stock");
	
	$date = date('Y-m-d H:i:s');
	$sqlSKU=mysqli_query($db_handle,"SELECT * FROM tbl_sku WHERE product_id!=0 OR combo_product_id!=0");
	while($sqlgetval=mysqli_fetch_object($sqlSKU))
	{
	    $pro_id=$sqlgetval->product_id;
	    $combo_pro_id=$sqlgetval->combo_product_id;
	
	    $sku=$sqlgetval->id;
	    
	    if($pro_id!=0)
	    {
	        $sqlSS=mysqli_query($db_handle,"SELECT * FROM tbl_product_to_warehouse WHERE product_id='".$pro_id."'");
	        while($sqlSS1=mysqli_fetch_object($sqlSS))
	        {
	            $sqladd=mysqli_query($db_handle,"INSERT INTO tbl_opening_stock SET product_id='".mysqli_real_escape_string($db_handle,$pro_id)."',ptw_id='".$sqlSS1->id."',sku='".mysqli_real_escape_string($db_handle,$sku)."',warehouse_id='".mysqli_real_escape_string($db_handle,$sqlSS1->warehouse_id)."',rack_id='".mysqli_real_escape_string($db_handle,$sqlSS1->rack_id)."',quantity='".mysqli_real_escape_string($db_handle,$sqlSS1->quantity)."',unit_price='".mysqli_real_escape_string($db_handle,$sqlSS1->unit_price)."',total_price='".mysqli_real_escape_string($db_handle,$sqlSS1->total_price)."',status='".mysqli_real_escape_string($db_handle,$sqlSS1->status)."',date='".$date."'");    
	        }
	    }
	    else if($combo_pro_id!=0)
	    {
	        $sqlSS=mysqli_query($db_handle,"SELECT * FROM tbl_product_to_warehouse WHERE combo_product_id='".$combo_pro_id."'");
	        while($sqlSS1=mysqli_fetch_object($sqlSS))
	        {
	            $sqladd=mysqli_query($db_handle,"INSERT INTO tbl_opening_stock SET combo_product_id='".mysqli_real_escape_string($db_handle,$combo_pro_id)."',ptw_id='".$sqlSS1->id."',sku='".mysqli_real_escape_string($db_handle,$sku)."',warehouse_id='".mysqli_real_escape_string($db_handle,$sqlSS1->warehouse_id)."',rack_id='".mysqli_real_escape_string($db_handle,$sqlSS1->rack_id)."',quantity='".mysqli_real_escape_string($db_handle,$sqlSS1->quantity)."',unit_price='".mysqli_real_escape_string($db_handle,$sqlSS1->unit_price)."',total_price='".mysqli_real_escape_string($db_handle,$sqlSS1->total_price)."',status='".mysqli_real_escape_string($db_handle,$sqlSS1->status)."',date='".$date."'");    
	        }
	    }
	}    
	

?>