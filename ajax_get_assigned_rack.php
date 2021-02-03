<?php
	session_start();

	if(@$_SESSION['valid_admin'] == "" )
	{
		@header("Location:login.php");
	}

	include_once("include/inc.php");

	$product_id=$_REQUEST['product'];
    $warehouse_id=$_REQUEST['warehouse'];
    
	$sqlQuery=mysqli_query($db_handle,"SELECT r.name,ptw.rack_id,ptw.id FROM tbl_product_to_warehouse ptw LEFT JOIN tbl_rack r ON ptw.rack_id=r.id WHERE ptw.product_id='".$product_id."' AND ptw.warehouse_id='".$warehouse_id."' AND r.flag='1' ORDER BY ptw.id ASC");
	if(mysqli_num_rows($sqlQuery)>0)
	{ 	
         ?>
		<option value="">Select a Rack</option>
	<?php
	    while($sqlResult=mysqli_fetch_object($sqlQuery))
		{ ?>
			<option value="<?php echo $sqlResult->id; ?>"><?php echo $sqlResult->name; ?></option>
		<?php
		}
	}
	else 
	{ ?>
			<option value="">No Rack found</option>
<?php
	}	
?>