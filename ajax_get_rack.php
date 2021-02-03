<?php
	session_start();

	if(@$_SESSION['valid_admin'] == "" )
	{

		@header("Location:login.php");
	}

	include_once("include/inc.php");

	$warehouse_id=$_REQUEST['warehouse'];

	$sqlQuery=mysqli_query($db_handle,"SELECT id,name FROM tbl_rack WHERE warehouse_id='".$warehouse_id."' AND flag='1'");
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