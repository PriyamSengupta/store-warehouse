<?php 

	session_start();

	if(@$_SESSION['valid_admin'] == "" )

	{

	@header("Location:login.php");

	}

	include_once("include/inc.php");
	
// 	if(isset($_POST["add"]))
// 	{
	    $name=$_REQUEST['name'];
	    $sku=$_REQUEST['sku'];
		$colour=$_REQUEST['colour'];
		$unit_price=number_format((round($_REQUEST['unit_price'])),'2','.','');
		$sqladd=mysqli_query($db_handle,"INSERT INTO tbl_products SET name='".mysqli_real_escape_string($db_handle,$name)."',barcode_no='',sku='".mysqli_real_escape_string($db_handle,$sku)."',colour_id='".mysqli_real_escape_string($db_handle,$colour)."',unit_price='".mysqli_real_escape_string($db_handle,$unit_price)."',creation_date=NOW(),created_by='".$_SESSION['id']."',modification_date=NOW(),modified_by='".$_SESSION['id']."'");
		$lastID=mysqli_insert_id($db_handle);
		$rand_code = $lastID;
		$bar_code=str_pad($rand_code,10,"0",STR_PAD_LEFT);	 
		$barcode_upd=mysqli_query($db_handle,"UPDATE tbl_products SET barcode_no='".$bar_code."' where id='".$lastID."'");
		$skuupd=mysqli_query($db_handle,"UPDATE tbl_sku SET product_id='".$lastID."' WHERE id='".$sku."'");
		
		$json['name']=$name;
		$json['colour']=$colour;
		$json['sku']=$sku;
		$json['unit_price']=$unit_price;
		$json['id']=$lastID;
		$json['status']="successfully added";
		header('Content-Type: application/json');
        print(json_encode($json));
// 	}
	
// 	if(isset($_POST["add"]))
// 	{
// 		$name=$_REQUEST['name'];
// 		$warehouse=$_REQUEST['warehouse_id'];
// 		$rack=$_REQUEST['rack_id'];
// 		$sku=$_REQUEST['sku'];
// 		$colour=$_REQUEST['colour'];
// 		$unit_price=number_format((round($_REQUEST['unit_price'])),'2','.','');
// 		$quantity=$_REQUEST['quantity'];
// 		$total_price=number_format((round($_REQUEST['total_price'])),'2','.','');

// 		$sqladd=mysqli_query($db_handle,"INSERT INTO tbl_products SET name='".mysqli_real_escape_string($db_handle,$name)."',barcode_no='',sku='".mysqli_real_escape_string($db_handle,$sku)."',colour_id='".mysqli_real_escape_string($db_handle,$colour)."',unit_price='".mysqli_real_escape_string($db_handle,$unit_price)."',quantity='".mysqli_real_escape_string($db_handle,$quantity)."',total_price='".mysqli_real_escape_string($db_handle,$total_price)."',creation_date=NOW(),created_by='".$_SESSION['id']."',modification_date=NOW(),modified_by='".$_SESSION['id']."'");

// 		$lastID=mysqli_insert_id($db_handle);
		
// 		$sqladd1=mysqli_query($db_handle,"INSERT INTO tbl_product_to_warehouse SET product_id='".$lastID."',rack_id='".mysqli_real_escape_string($db_handle,$rack)."',warehouse_id='".mysqli_real_escape_string($db_handle,$warehouse)."',quantity='".mysqli_real_escape_string($db_handle,$quantity)."',total_price='".mysqli_real_escape_string($db_handle,$total_price)."'");
		
// 		$rand_code = $lastID;
// 		$bar_code=str_pad($rand_code,10,"0",STR_PAD_LEFT);	 
// 		$barcode_upd=mysqli_query($db_handle,"UPDATE tbl_products SET barcode_no='".$bar_code."' where id='".$lastID."'");
// 		$skuupd=mysqli_query($db_handle,"UPDATE tbl_sku SET product_id='".$lastID."' WHERE id='".$sku."'");
// 		echo "<script type='text/javascript'>window.parent.location.reload()</script>";
// // 		echo "<script type='text/javascript'>window.opener.location.href = window.opener.location.href + '?msg=1'</script>";
// 		//header("location:product_list.php?msg=1");

// 	}
	//print_r($_POST);
?>	