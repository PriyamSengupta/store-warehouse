<?php
	session_start();

	if(@$_SESSION['valid_admin'] == "" )
	{
		@header("Location:login.php");
	}

	include_once("include/inc.php");

	$product_id=$_REQUEST['product'];

	$sqlQuery=mysqli_query($db_handle,"SELECT w.name,ptw.warehouse_id FROM tbl_product_to_warehouse ptw LEFT JOIN tbl_warehouse w ON ptw.warehouse_id=w.id WHERE ptw.product_id='".$product_id."' GROUP BY ptw.warehouse_id ORDER BY ptw.id ASC");
	if(mysqli_num_rows($sqlQuery)>0)
	{ 	
         ?>
		<option value="">Select a Warehouse</option>
	<?php
	    while($sqlResult=mysqli_fetch_object($sqlQuery))
		{ ?>
			<option value="<?php echo $sqlResult->warehouse_id; ?>"><?php echo $sqlResult->name; ?></option>
		<?php
		}
	}
	else 
	{ ?>
			<option value="">No warehouse found</option>
<?php
	}	
?>