<?php
	session_start();

	if(@$_SESSION['valid_admin'] == "" )
	{
		@header("Location:login.php");
	}

	include_once("include/inc.php");

	$sku=$_REQUEST['sku'];
// 	$sqlss=mysqli_fetch_object(mysqli_query($db_handle,"SELECT id FROM tbl_sku WHERE name='".mysqli_real_escape_string($db_handle,$sku_name)."'"));
// 	$sku=$sqlss->id;
    $warehouse_id=$_REQUEST['warehouse'];
    
    $sqlQuery=mysqli_fetch_object(mysqli_query($db_handle,"SELECT product_id,combo_product_id FROM tbl_sku WHERE id='".$sku."'"));
	$pro_id=$sqlQuery->product_id;
	$combo_pro_id=$sqlQuery->combo_product_id; ?>
	<option value="">Select a Rack</option>
	<?php
	if($pro_id!=0)
	{
    
	    $sqlQuery=mysqli_query($db_handle,"SELECT ptw.quantity,r.name,ptw.rack_id,ptw.id FROM tbl_product_to_warehouse ptw LEFT JOIN tbl_rack r ON ptw.rack_id=r.id WHERE ptw.product_id='".$pro_id."' AND ptw.warehouse_id='".$warehouse_id."' AND ptw.quantity!='0' ORDER BY ptw.id ASC");
         
	    while($sqlResult=mysqli_fetch_object($sqlQuery))
		{ ?>
			<option value="<?php echo $sqlResult->id; ?>"><?php echo $sqlResult->name; ?></option>
		<?php
		}
	}
	elseif($combo_pro_id!=0)
	{
	    $sqlQuery=mysqli_query($db_handle,"SELECT r.name,ptw.rack_id,ptw.id FROM tbl_product_to_warehouse ptw LEFT JOIN tbl_rack r ON ptw.rack_id=r.id WHERE ptw.combo_product_id='".$combo_pro_id."' AND ptw.quantity!='0' AND ptw.warehouse_id='".$warehouse_id."' ORDER BY ptw.id ASC");
         
	    while($sqlResult=mysqli_fetch_object($sqlQuery))
		{ ?>
			<option value="<?php echo $sqlResult->id; ?>"><?php echo $sqlResult->name; ?></option>
		<?php
		}
	}
?>