<?php
	session_start();

	if(@$_SESSION['valid_admin'] == "" )
	{
		@header("Location:login.php");
	}

	include_once("include/inc.php");

	$sku=$_REQUEST['sku'];

	$sqlQuery=mysqli_fetch_object(mysqli_query($db_handle,"SELECT product_id,combo_product_id FROM tbl_sku WHERE id='".$sku."'"));
	$pro_id=$sqlQuery->product_id;
	$combo_pro_id=$sqlQuery->combo_product_id; ?>
	<option value="">Select a Warehouse</option>
	<?php
	if($pro_id!=0)
	{
	    $sqlSelect1=mysqli_query($db_handle,"SELECT w.name,ptw.warehouse_id FROM tbl_product_to_warehouse ptw LEFT JOIN tbl_warehouse w ON ptw.warehouse_id=w.id WHERE ptw.product_id='".$pro_id."' AND ptw.quantity!=0 GROUP BY ptw.warehouse_id ORDER BY ptw.id ASC"); 
         
	    while($sqlResult=mysqli_fetch_object($sqlSelect1))
		{ ?>
			<option value="<?php echo $sqlResult->warehouse_id; ?>"><?php echo $sqlResult->name; ?></option>
		<?php
		}
	}
	elseif($combo_pro_id!=0)
	{
	    $sqlSelect1=mysqli_query($db_handle,"SELECT w.name,ptw.warehouse_id FROM tbl_product_to_warehouse ptw LEFT JOIN tbl_warehouse w ON ptw.warehouse_id=w.id WHERE ptw.combo_product_id='".$combo_pro_id."' GROUP BY ptw.warehouse_id ORDER BY ptw.id ASC"); 
         
	    while($sqlResult=mysqli_fetch_object($sqlSelect1))
		{ ?>
			<option value="<?php echo $sqlResult->warehouse_id; ?>"><?php echo $sqlResult->name; ?></option>
		<?php
		}
	}
?>