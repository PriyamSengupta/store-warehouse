<?php
include_once("config.php");
    $data=array();

    $id=$_POST['user_id'];

    $sqlupdate = mysqli_query($db_handle,"UPDATE tbl_products SET name='".mysqli_real_escape_string($db_handle,$_POST['name'])."',warehouse_id='".mysqli_real_escape_string($db_handle,$_POST['warehouse_id'])."',rack_id='".mysqli_real_escape_string($db_handle,$_POST['rack_id'])."',sku='".mysqli_real_escape_string($db_handle,$_POST['sku'])."',colour_id='".mysqli_real_escape_string($db_handle,$_POST['colour'])."',unit_price='".mysqli_real_escape_string($db_handle,$_POST['unit_price'])."',quantity='".mysqli_real_escape_string($db_handle,$_POST['quantity'])."',total_price='".mysqli_real_escape_string($db_handle,$_POST['total_price'])."',modification_date=NOW(),modified_by='".$id."' WHERE id='".$_POST['product_id']."'");
    $sqlupdate1 = mysqli_query($db_handle,"UPDATE tbl_sku SET product_id='".mysqli_real_escape_string($db_handle,$_POST['product_id'])."' WHERE id='".$_POST['sku']."'");
    
    if($sqlupdate==true && $sqlupdate1==true)
        {
            $data['status']="Successfully updated";
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