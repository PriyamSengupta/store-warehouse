<?php
	session_start();

	if(@$_SESSION['valid_admin'] == "" )
	{

		@header("Location:login.php");
	}

	include_once("include/inc.php");

// 	$product_id=$_REQUEST['product'];
//     $warehouse_id=$_REQUEST['warehouse'];
//     $rack_id=$_REQUEST['rack'];
    $id=$_REQUEST['id'];

	$sqlQuery=mysqli_query($db_handle,"SELECT rack_id,unit_price,quantity,total_price,status FROM tbl_product_to_warehouse WHERE id='".$id."'");
	if(mysqli_num_rows($sqlQuery)>0)
	{	
		$sqlResult=mysqli_fetch_object($sqlQuery);
		
    		$response=array(
    		    'unit_price'=>$sqlResult->unit_price,
    		    'rack_quant'=>$sqlResult->quantity,
    		    'rack_id'   =>$sqlResult->rack_id,
    		    'row_total' =>$sqlResult->total_price,
    		    'condition' =>($sqlResult->status=='0') ? 'Damaged' : 'Working'
    		    );
			    
	header('Content-Type: application/json');
    echo json_encode($response);
	   // echo $sqlResult->unit_price;
	}
	?>