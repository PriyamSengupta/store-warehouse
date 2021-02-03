<?php
include_once("config.php");
$product_id = $_POST['id'];
	
	$sqlsel=mysqli_query($db_handle,"SELECT sku FROM tbl_products WHERE id='".$product_id."'");
    $sqlsel1=mysqli_fetch_object($sqlsel);
    $sku=$sqlsel1->sku;
	$sqlupdate = mysqli_query($db_handle,"UPDATE tbl_sku SET product_id='0' WHERE id='".$sku."'");
	$sqldlt=mysqli_query($db_handle,"DELETE FROM tbl_products WHERE id='".$product_id."'");
	
	if($sqlupdate==true && $sqldlt==true)
        {
            $data['status']="Successfully deleted";
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