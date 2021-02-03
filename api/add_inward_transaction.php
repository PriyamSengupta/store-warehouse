<?php
include_once("config.php");
    $statusdata=array();
    $json=$_POST['data'];
	$data=json_decode($json, TRUE);
	$user_id=$data['user_id'];
	$sku=$data['skuid'];
	$unit=$data['unit'];
	
	$data1=$data['wares'];
	$total_price=0;
	$total_quantity=0;
	$i=0;
	$j=0;
	foreach($data1 as $key)
	{
	    $quant=$key['quantity'];
	    $total_quantity=$quantity+$quant;
	    //$unit_price=$unit;
	    $total=$unit*$quant;
	    $total_price=$total_price+$total;
	}
	    
	    $total_price=number_format($total_price,'2','.','');
	    
	    $sqladd=mysqli_query($db_handle,"INSERT INTO tbl_products SET name='',barcode_no='',sku='".$sku."',colour_id='',unit_price='".number_format($unit,'2','.','')."',quantity='".$total_quantity."',total_price='".$total_price."',creation_date=NOW(),created_by='".$user_id."',modification_date=NOW(),modified_by='".$user_id."'");
		$lastID=mysqli_insert_id($db_handle);
		$rand_code = $lastID;
		$bar_code=str_pad($rand_code,10,"0",STR_PAD_LEFT);	 
		$barcode_upd=mysqli_query($db_handle,"UPDATE tbl_products SET barcode_no='".$bar_code."' where id='".$lastID."'");
		$skuupd=mysqli_query($db_handle,"UPDATE tbl_sku SET product_id='".$lastID."' WHERE id='".$sku."'");
		if($sqladd==true)
		{
		    $i++;
		}
		foreach($data1 as $product)
		{
		    $product_id = $lastID;
		    $warehouse = $product['ware_id'];
		    $rack= $product['rack_id'];
		    $quantity = $product['quantity'];
		    //$unit = $product['unit'];
		    $total = number_format(($product['quantity']*$unit),'2','.','');
		    $stat = $product['status'];   
		    $sqladd1=mysqli_query($db_handle,"INSERT INTO tbl_product_to_warehouse SET product_id='".$product_id."',warehouse_id='".$warehouse."',rack_id='".$rack."',unit_price='".number_format($unit,'2','.','')."',quantity='".$quantity."',total_price='".$total."',status='".$stat."'");
		
		    if($sqladd1==true)
		    {
		        $j++;
		    }
		}    
		if($i>0 && $j>0)
		{
		    $statusdata['status']="Successfully added";
        	print(json_encode($statusdata));
            mysqli_close($db_handle);
		}
        else
        {
            $statusdata['status']="Error";
        	print(json_encode($statusdata));
            mysqli_close($db_handle);
        }
?>