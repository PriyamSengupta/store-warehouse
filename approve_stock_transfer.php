<?php 

	session_start();
	if(@$_SESSION['valid_admin'] == "" )
	{
	    @header("Location:login.php");
	}
	include_once("include/inc.php");
	$date = date('Y-m-d H:i:s');
    $transaction_type=$_GET['status'];
    $new_stock_id=$_REQUEST['new_stock_id'];
    // $product_to_warehouse=$_REQUEST['id'];
    // echo $new_stock_id;
    $sqlsel1=mysqli_query($db_handle,"SELECT * FROM tbl_stock_transfer_warehouse WHERE id='".$new_stock_id."'");
        if(mysqli_num_rows($sqlsel1)>0)
        {
            $sqlselect=mysqli_fetch_object($sqlsel1);
            // print_r($sqlselect);
            $unit_price=$sqlselect->unit_price;
            $product_id=$sqlselect->product_id;
            $combo_product_id=$sqlselect->combo_product_id;
            $product_to_warehouse=$sqlselect->product_to_warehouse_id;
            $new_warehouse=$sqlselect->to_warehouse;
            $new_rack=$sqlselect->to_rack;
            $prev_quant=$sqlselect->available_quant;
            $stock_quant=$sqlselect->stock_quant;
            
            $changed_quant=$prev_quant-$stock_quant;
            $new_total1=number_format(($changed_quant*$unit_price),'2','.','');
            $status=$sqlselect->sku_condition;
            $total1=number_format(($stock_quant*$unit_price),'2','.','');
            if($product_id!=0)
            {
                // echo "pro";
                    $sqlS=mysqli_query($db_handle,"SELECT * FROM tbl_product_to_warehouse WHERE product_id='".$product_id."' AND warehouse_id='".$new_warehouse."' AND rack_id='".$new_rack."' AND unit_price='".number_format($unit_price,'2','.','')."' AND status='".$status."'");
                    if(mysqli_num_rows($sqlS)>0)
                    {
                        $sqlS1=mysqli_fetch_object($sqlS);
                        $new_quant=$sqlS1->quantity+$stock_quant;
                        $new_total=$new_quant*$sqlS1->unit_price;
                        $new_total=number_format($new_total,'2','.','');
                        $ptw_id=$sqlS1->id;
                        $sqlupdate=mysqli_query($db_handle,"UPDATE tbl_product_to_warehouse SET quantity='".$new_quant."',total_price='".$new_total."' WHERE id='".$ptw_id."'");
                    }
                    else
                    {
                        $sqladd1=mysqli_query($db_handle,"INSERT INTO tbl_product_to_warehouse SET product_id='".$product_id."',warehouse_id='".$new_warehouse."',rack_id='".$new_rack."',unit_price='".number_format($unit_price,'2','.','')."',quantity='".$stock_quant."',total_price='".$total1."',status='".$status."',creation_date='".$date."'");
                    }
            }
            
            elseif($combo_product_id!=0)
            {
            	$sqlS=mysqli_query($db_handle,"SELECT * FROM tbl_product_to_warehouse WHERE combo_product_id='".$combo_product_id."' AND warehouse_id='".$new_warehouse."' AND rack_id='".$new_rack."' AND unit_price='".number_format($unit_price,'2','.','')."' AND status='".$status."'");
                if(mysqli_num_rows($sqlS)>0)
                {
                    $sqlS1=mysqli_fetch_object($sqlS);
                    $new_quant=$sqlS1->quantity+$stock_quant;
                    $new_total=$new_quant*$sqlS1->unit_price;
                    $new_total=number_format($new_total,'2','.','');
                    $ptw_id=$sqlS1->id;
                    $sqlupdate=mysqli_query($db_handle,"UPDATE tbl_product_to_warehouse SET quantity='".$new_quant."',total_price='".$new_total."' WHERE id='".$ptw_id."'");
                }
                else
                {
                // echo "com";
                    $sqladd1=mysqli_query($db_handle,"INSERT INTO tbl_product_to_warehouse SET combo_product_id='".$combo_product_id."',warehouse_id='".$new_warehouse."',rack_id='".$new_rack."',unit_price='".number_format($unit_price,'2','.','')."',quantity='".$stock_quant."',total_price='".$total1."',status='".$status."',creation_date='".$date."'");
                }
            }
            
            $sqlupdate12=mysqli_query($db_handle,"UPDATE tbl_product_to_warehouse SET quantity='".$changed_quant."',total_price='".$new_total1."' WHERE id='".$product_to_warehouse."'");
            $sqlupdte13=mysqli_query($db_handle,"UPDATE tbl_stock_transfer_warehouse SET status='1',approval_date='".$date."',approved_by='".$_SESSION['id']."' WHERE id='".$new_stock_id."'");
            header('Location:warehouse_transaction.php?msg=1');
        }
?>	