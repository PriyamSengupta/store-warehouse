<?php
session_start();

	if(@$_SESSION['valid_admin'] == "" )
	{
	    @header("Location:login.php");
	}

	include_once("include/inc.php");
	if(isset($_POST["add"]))
	{
	    $date = date('Y-m-d H:i:s');
	   // echo "<pre>";
	   // print_r($_POST);
	   // echo "</pre>";
	    $sku=$_POST['sku'];
	    $sku_name=$_POST['sku_name'];
	    $warehouse=$_POST['warehouse_id'];
        $rack=$_POST['rack_id'];
        $unit=number_format($_POST['unit_price'],'2','.','');
        $quantity=$_POST['quantity'];
        $total=number_format(($unit*$quantity),'2','.','');
        $status=$_POST['condition'];
        $reason=$_POST['reason'];
        
        $sqlsel=mysqli_fetch_object(mysqli_query($db_handle,"SELECT product_id,combo_product_id FROM tbl_sku WHERE flag='1' AND id='".$sku."'"));
        $pro_id=$sqlsel->product_id;
	    $combo_pro_id=$sqlsel->combo_product_id;
	    
	    if($pro_id!=0)
	    {
	        $sqlsel1=mysqli_query($db_handle,"SELECT * FROM tbl_product_to_warehouse WHERE product_id='".$pro_id."' AND status='".$status."' AND warehouse_id='".$warehouse."' AND rack_id='".$rack."' AND unit_price='".$unit."'");
	        if(mysqli_num_rows($sqlsel1)>0)
	        {
	            $sqlrec1=mysqli_fetch_object($sqlsel1);
	            $ptw_id=$sqlrec1->id;
	            $new_quant=$sqlrec1->quantity+$quantity;
	            $new_total=number_format(($new_quant*$unit),'2','.','');
	            $sqlupdt1=mysqli_query($db_handle,"UPDATE tbl_product_to_warehouse SET quantity='".$new_quant."',total_price='".$new_total."' WHERE id='".$ptw_id."'");
	        }
	        else
	        {
	            $sqladd1=mysqli_query($db_handle,"INSERT INTO tbl_product_to_warehouse SET product_id='".$pro_id."',warehouse_id='".$warehouse."',rack_id='".$rack."',unit_price='".$unit."',quantity='".$quantity."',total_price='".$total."',status='".$status."',creation_date='".$date."'");
	            $ptw_id=mysqli_insert_id($db_handle);
	        }
	        $sqlsel2=mysqli_fetch_object(mysqli_query($db_handle,"SELECT * FROM tbl_products WHERE id='".$pro_id."'"));
	        $updated_quant=$sqlsel2->quantity+$quantity;
	        $updated_total=$sqlsel2->total_price+$total;
	        $updated_total=number_format($updated_total,'2','.','');
	        $sqlupdt2=mysqli_query($db_handle,"UPDATE tbl_products SET quantity='".$updated_quant."',total_price='".$updated_total."' WHERE id='".$pro_id."'");
	       // $sql_inward=mysqli_query($db_handle,"INSERT INTO tbl_goods_inward SET sku='".$sku."',sku_name='".$sku_name."',quantity='".$quantity."',total_price='".$total."',creation_date='".$date."'");
	        
	        $sqlC=mysqli_fetch_object(mysqli_query($db_handle,"SELECT id,quantity,total_price FROM tbl_goods_inward WHERE sku='".$sku."'"));
    		$new_quantity1=$sqlC->quantity+$quantity;
    		$new_total1=$total+$sqlC->total_price;
    		$inward_id=$sqlC->id;
    		$sqladd4=mysqli_query($db_handle,"UPDATE tbl_goods_inward SET quantity='".$new_quantity1."',total_price='".number_format($new_total1,'2','.','')."',creation_date='".$date."' WHERE id='".$inward_id."'");
	        
	        $sqladd3=mysqli_query($db_handle,"INSERT INTO tbl_inward_adjustment SET sku='".$sku."',sku_name='".mysqli_real_escape_string($db_handle,$sku_name)."',warehouse='".$warehouse."',rack='".$rack."',ptw_id='".$last_id."',quantity='".$quantity."',unit_price='".$unit."',total_price='".$total."',creation_date='".$date."',reason='".mysqli_real_escape_string($db_handle,$reason)."'");
	    	$sqladd2=mysqli_query($db_handle,"INSERT INTO tbl_stock_in SET ptw_id='".$ptw_id."',sku='".$sku."',warehouse_id='".$warehouse."',rack_id='".$rack."',unit_price='".$unit."',quantity='".$quantity."',total_price='".$total."',status='".$status."',type='2',creation_date='".$date."'");
	    	header("location:stock_adjustment.php?msg=1");
	    }
	    elseif($combo_pro_id!=0)
	    {
	        $sqlsel1=mysqli_query($db_handle,"SELECT * FROM tbl_product_to_warehouse WHERE combo_product_id='".$combo_pro_id."' AND status='".$status."' AND warehouse_id='".$warehouse."' AND rack_id='".$rack."' AND unit_price='".$unit."'");
	        if(mysqli_num_rows($sqlsel1)>0)
	        {
	            $sqlrec1=mysqli_fetch_object($sqlsel1);
	            $ptw_id=$sqlrec1->id;
	            $new_quant=$sqlrec1->quantity+$quantity;
	            $new_total=number_format(($new_quant*$unit),'2','.','');
	            $sqlupdt1=mysqli_query($db_handle,"UPDATE tbl_product_to_warehouse SET quantity='".$new_quant."',total_price='".$new_total."' WHERE id='".$ptw_id."'");
	        }
	        else
	        {
	            $sqladd1=mysqli_query($db_handle,"INSERT INTO tbl_product_to_warehouse SET combo_product_id='".$combo_pro_id."',warehouse_id='".$warehouse."',rack_id='".$rack."',unit_price='".$unit."',quantity='".$quantity."',total_price='".$total."',status='".$status."',creation_date='".$date."'");
	            $ptw_id=mysqli_insert_id($db_handle);
	        }
	        $sqlpro=mysqli_query($db_handle,"SELECT quantity,total_price FROM tbl_combo_product WHERE id='".$combo_pro_id."'");
            $sqlpro1=mysqli_fetch_object($sqlpro);
            // $wh_id=$sqlpro1->warehouse_id;
            $current_quantity=$sqlpro1->quantity;
            $total_price1=$sqlpro1->total_price;
            $sql_combo_details=mysqli_query($db_handle,"SELECT * FROM tbl_combo_product_details WHERE combo_product_id='".$combo_pro_id."'");
            // echo mysqli_num_rows($sql_combo_details);
            while($sql_combo=mysqli_fetch_object($sql_combo_details))
            {
                    $combo_detail_quantity=$sql_combo->quantity;
                    $combo_detail_unit=$sql_combo->unit_price;
                    $com_detail_product_id=$sql_combo->product_id;
                    $qty_per_combo=$sql_combo->qty_per_combo;
                    $combo_detail_id=$sql_combo->id;
                    
                    // $added_combo_quant=$combo_detail_quantity/$current_quantity;
                    $new_combo_quant1=$qty_per_combo*$quantity;
                    $new_combo_quant=$new_combo_quant1+$combo_detail_quantity;
                    $new_combo_total1=number_format(($new_combo_quant*$combo_detail_unit),'2','.','');
                    // $new_combo_total=number_format(($new_combo_total1+$sql_combo->total_price),'2','.','');
                    $sql_updt_combo_details=mysqli_query($db_handle,"UPDATE tbl_combo_product_details SET quantity='".$new_combo_quant."',total_price='".$new_combo_total1."' WHERE id='".$combo_detail_id."'");

            }

                
            $new_quantity=$current_quantity+$quantity;
            $added_price=number_format(($quantity*$unit),'2','.','');
            $total_price=number_format(($total_price1+$added_price),'2','.','');
            $sql_pro_updt= mysqli_query($db_handle,"UPDATE tbl_combo_product SET quantity='".$new_quantity."',total_price='".$total_price."',modification_date='".$date."',modified_by='".$_SESSION['id']."' WHERE id='".$combo_pro_id."'");
            
            /*$sqlC=mysqli_fetch_object(mysqli_query($db_handle,"SELECT quantity,total_price FROM tbl_goods_inward WHERE sku='".$sku_id."'"));
    		$new_quantity1=$sqlC->quantity+$quantity;
    		$new_total1=$total+$sqlC->total_price;
    		$sqladd4=mysqli_query($db_handle,"UPDATE tbl_goods_inward SET quantity='".$new_quantity1."',total_price='".number_format($new_total1,'2','.','')."',creation_date='".$date."' WHERE sku='".$sku."'");*/
            
	        $sqladd3=mysqli_query($db_handle,"INSERT INTO tbl_inward_adjustment SET sku='".$sku."',sku_name='".mysqli_real_escape_string($db_handle,$sku_name)."',warehouse='".$warehouse."',rack='".$rack."',ptw_id='".$last_id."',quantity='".$quantity."',unit_price='".$unit."',total_price='".$total."',creation_date='".$date."',reason='".mysqli_real_escape_string($db_handle,$reason)."'");
	    	$sqladd2=mysqli_query($db_handle,"INSERT INTO tbl_stock_in SET ptw_id='".$ptw_id."',sku='".$sku."',warehouse_id='".$warehouse."',rack_id='".$rack."',unit_price='".$unit."',quantity='".$quantity."',total_price='".$total."',status='".$status."',type='2',creation_date='".$date."'");
	    	header("location:stock_adjustment.php?msg=1");
	    }
	}
?>