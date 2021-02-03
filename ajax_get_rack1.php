<?php
	session_start();

	if(@$_SESSION['valid_admin'] == "" )
	{

		@header("Location:login.php");
	}

	include_once("include/inc.php");

	$warehouse_id=$_REQUEST['warehouse'];
	$sku=$_REQUEST['sku'];

	$sqlQuery=mysqli_query($db_handle,"SELECT ptw.id,r.name FROM tbl_product_to_warehouse ptw LEFT JOIN tbl_rack r ON ptw.rack_id=r.id WHERE ptw.warehouse_id='".$warehouse_id."' AND ptw.sku='".$sku."'");
	if(mysqli_num_rows($sqlQuery)>0)
	{?>	
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