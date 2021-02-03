<?php 

	session_start();
	if(@$_SESSION['valid_admin'] == "" )
	{
		@header("Location:login.php");
	}
	include_once("include/inc.php");

	if(isset($_POST["edit"]))
	{
	    $date = date('Y-m-d H:i:s');
	    $quantity=$_REQUEST['quantity1'];
	    $condition=$_REQUEST['condition1'];
	    $unit= $_REQUEST['unit_price1'];
	    $product_id=$_REQUEST['pro_id'];
	    $prev_quant=$_REQUEST['quant'];
	    $id=$_REQUEST['tab_id'];
	    $prev_total=number_format($_REQUEST['total'],'2','.','');
	    $new_total=number_format($quantity*$unit,'2','.','');
	   // echo $new_total;
	    $sqlupdt1=mysqli_query($db_handle,"UPDATE tbl_product_to_warehouse SET unit_price='".number_format($unit,'2','.','')."',quantity='".$quantity."',total_price='".$new_total."',status='".$condition."' WHERE id='".$id."'");
	    
// 	    $sqlC=mysqli_fetch_object(mysqli_query($db_handle,"SELECT quantity,total_price FROM tbl_goods_inward WHERE sku='".$_REQUEST['sku_id']."'"));
// 		$new_quantity1=$sqlC->quantity+$quantity;
// 		$new_total1=$new_total+$sqlC->total_price;
		$sqlupdt2=mysqli_query($db_handle,"UPDATE tbl_stock_in SET unit_price='".number_format($unit,'2','.','')."',quantity='".$quantity."',total_price='".$new_total."',status='".$condition."',creation_date='".$date."' WHERE ptw_id='".$id."'");
        
        $sqlSel=mysqli_fetch_object(mysqli_query($db_handle,"SELECT * FROM tbl_products WHERE id='".$product_id."'"));
        
        $total_amount=$sqlSel->total_price;
        $total_quant=$sqlSel->quantity;
        
        $total_amount1=$total_amount-$prev_total;
        $final_total=$total_amount1+$new_total;
        
        $total_quant1=$total_quant-$prev_quant;
        $final_quant=$total_quant1+$quantity;
        // echo $final_total."<br>".$final_quant;
        $sqlupdt1=mysqli_query($db_handle,"UPDATE tbl_products SET total_price='".number_format($final_total,'2','.','')."',quantity='".$final_quant."',modification_date='".$date."',modified_by='".$_SESSION['id']."' WHERE id='".$product_id."'");
        $sqlupdt3=mysqli_query($db_handle,"UPDATE tbl_goods_inward SET quantity='".$final_quant."',total_price='".number_format($final_total,'2','.','')."',creation_date='".$date."' WHERE sku='".$_REQUEST['sku_id']."'");
        
		
		header('Location:edit_transaction.php?id='.$product_id.'&msg=1');
// 		echo "<script type='text/javascript'>window.parent.location.reload()</script>";

	}

    // print_r($_POST);

?>