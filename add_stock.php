<?php 

	session_start();
	if(@$_SESSION['valid_admin'] == "" )
	{
	    @header("Location:login.php");
	}
	include_once("include/inc.php");

	if(isset($_POST["add1"]))
	{
        $sku=$_REQUEST['sku'];
        $product_id=$_REQUEST['pro_id'];
        $combo_product_id=$_REQUEST['combo_pro_id'];
        $prev_warehouse=$_REQUEST['warehouse1'];
        $prev_rack=$_REQUEST['rack1'];
        $new_rack=$_REQUEST['rack_id'];
        $new_warehouse=$_REQUEST['warehouse_id'];
        $prev_quant=$_REQUEST['quantity1'];
        $stock_quant=$_REQUEST['quantity'];
        $status=$_REQUEST['status'];
        $unit_price=$_REQUEST['row_unit_price'];
        $id=$_REQUEST['row_id'];
        
        if($product_id!=0){
        // print_r($_POST);
		    $sqladd=mysqli_query($db_handle,"INSERT INTO tbl_stock_transfer_warehouse SET product_id='".$product_id."',product_to_warehouse_id='".$id."',sku='".$sku."',from_warehouse='".$prev_warehouse."',from_rack='".$prev_rack."',to_warehouse='".$new_warehouse."',to_rack='".$new_rack."',stock_quant='".$stock_quant."',available_quant='".$prev_quant."',sku_condition='".$status."',unit_price='".number_format($unit_price,'2','.','')."',approval_date='',requested_by='".$_SESSION['id']."',creation_date=NOW(),created_by='".$_SESSION['id']."'");
            // $sqlupdate=mysqli_query($db_handle,"UPDATE tbl_product_to_warehouse SET quantity='".$changed_quant."',total_price='".$new_total."' WHERE id='".$id."'");
            // $sqladd1=mysqli_query($db_handle,"INSERT INTO tbl_product_to_warehouse SET product_id='".$product_id."',warehouse_id='".$new_warehouse."',rack_id='".$new_rack."',unit_price='".number_format($unit_price,'2','.','')."',quantity='".$stock_quant."',total_price='".$total_amount."',status='".$status."'");
            
        }
        elseif($combo_product_id!=0)
        {
            $sqladd=mysqli_query($db_handle,"INSERT INTO tbl_stock_transfer_warehouse SET combo_product_id='".$combo_product_id."',product_to_warehouse_id='".$id."',sku='".$sku."',from_warehouse='".$prev_warehouse."',from_rack='".$prev_rack."',to_warehouse='".$new_warehouse."',to_rack='".$new_rack."',stock_quant='".$stock_quant."',available_quant='".$prev_quant."',sku_condition='".$status."',unit_price='".number_format($unit_price,'2','.','')."',approval_date='',requested_by='".$_SESSION['id']."',creation_date=NOW(),created_by='".$_SESSION['id']."'");
            // $sqlupdate=mysqli_query($db_handle,"UPDATE tbl_product_to_warehouse SET quantity='".$changed_quant."',total_price='".$new_total."' WHERE id='".$id."'");
            // $sqladd1=mysqli_query($db_handle,"INSERT INTO tbl_product_to_warehouse SET combo_product_id='".$combo_product_id."',warehouse_id='".$new_warehouse."',rack_id='".$new_rack."',unit_price='".number_format($unit_price,'2','.','')."',quantity='".$stock_quant."',total_price='".$total_amount."',status='".$status."'");
        }
       
		echo "<script type='text/javascript'>window.parent.location.reload()</script>";

	}
	if(isset($_POST["add2"]))
	{
	    $sku=$_REQUEST['sku1'];
        $product_id=$_REQUEST['pro_id1'];
        $combo_product_id=$_REQUEST['combo_pro_id1'];
        $prev_warehouse=$_REQUEST['warehouse1'];
        $prev_rack=$_REQUEST['rack1'];
        $prev_quant=$_REQUEST['quantity1'];
        $stock_quant=$_REQUEST['quantity'];
        $wholeseller=$_REQUEST['ws_name'];
        $comment=$_REQUEST['comment'];
        
        $id=$_REQUEST['row_id'];
        $unit_price=$_REQUEST['row_unit_price'];
        $total_price=$unit_price*$stock_quant;
        $total_price=number_format($total_price,'2','.','');
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        if($product_id!=0){
            $sqladd=mysqli_query($db_handle,"INSERT INTO tbl_stock_transfer_wholeseller SET product_id='".$product_id."',product_to_warehouse_id='".$id."',sku='".$sku."',from_warehouse='".$prev_warehouse."',from_rack='".$prev_rack."',ws_name='".$wholeseller."',comment='".$comment."',stock_quant='".$stock_quant."',available_quant='".$prev_quant."',unit_price='".number_format($unit_price,'2','.','')."',total_price='".$total_price."',approval_date='',requested_by='".$_SESSION['id']."',creation_date=NOW(),created_by='".$_SESSION['id']."'");
        }
        elseif($combo_product_id!=0)
        {
            $sqladd=mysqli_query($db_handle,"INSERT INTO tbl_stock_transfer_wholeseller SET combo_product_id='".$combo_product_id."',product_to_warehouse_id='".$id."',sku='".$sku."',from_warehouse='".$prev_warehouse."',from_rack='".$prev_rack."',ws_name='".$wholeseller."',comment='".$comment."',stock_quant='".$stock_quant."',available_quant='".$prev_quant."',unit_price='".number_format($unit_price,'2','.','')."',total_price='".$total_price."',approval_date='',requested_by='".$_SESSION['id']."',creation_date=NOW(),created_by='".$_SESSION['id']."'");
        }
        echo "<script type='text/javascript'>window.parent.location.reload()</script>";
	}
	
?>