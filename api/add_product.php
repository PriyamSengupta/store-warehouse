<?php
include_once("config.php");
                $data=array();
        		
        		$name=$_POST['name'];
        		$warehouse=$_POST['warehouse_id'];
        		$rack=$_POST['rack_id'];
        		$sku=$_POST['sku'];
        		$id=$_POST['user_id'];
        		$colour=$_POST['colour'];
        		$unit_price=number_format((round($_POST['unit_price'])),'2','.','');
        		$quantity=$_POST['quantity'];
        		$total_price=number_format((round($_POST['total_price'])),'2','.','');

		$sqladd=mysqli_query($db_handle,"INSERT INTO tbl_products SET name='".mysqli_real_escape_string($db_handle,$name)."',barcode_no='',warehouse_id='".mysqli_real_escape_string($db_handle,$warehouse)."',rack_id='".mysqli_real_escape_string($db_handle,$rack)."',sku='".mysqli_real_escape_string($db_handle,$sku)."',colour_id='".mysqli_real_escape_string($db_handle,$colour)."',unit_price='".mysqli_real_escape_string($db_handle,$unit_price)."',quantity='".mysqli_real_escape_string($db_handle,$quantity)."',total_price='".mysqli_real_escape_string($db_handle,$total_price)."',creation_date=NOW(),created_by='".$id."',modification_date=NOW(),modified_by='".$id."'");

		$lastID=mysqli_insert_id($db_handle);
		$rand_code = $lastID;
		$bar_code=str_pad($rand_code,10,"0",STR_PAD_LEFT);	 
		$barcode_upd=mysqli_query($db_handle,"UPDATE tbl_products SET barcode_no='".$bar_code."' where id='".$lastID."'");
		$skuupd=mysqli_query($db_handle,"UPDATE tbl_sku SET product_id='".$lastID."' WHERE id='".$sku."'");
        if($sqladd==true)
        {
            $data['status']="Successfully added";
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