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
	    $i=0;
	    $ptw_id=$_REQUEST['ptw_id'];
	    $id=$_REQUEST['id'];
	    $warehouse_id=$_REQUEST['warehouse'];
	    $rack_id=$_REQUEST['rack_id'];
	   // $sku=$_REQUEST['sku'];
	    $quantity=$_REQUEST['quantity'];
	    $act_quant=$_REQUEST['quant'];
	    $unit=number_format($_REQUEST['unit_price'],'2','.','');
	    $remaining_quant=$act_quant-$quantity;
	    $total_price_now=number_format(($remaining_quant*$unit),'2','.','');
	    
	    if($quantity>$act_quant)
	    {
	        header("location:outward_adjustment.php?msg=2");
	    }
	    else
	    {

    	    $sqlS=mysqli_fetch_object(mysqli_query($db_handle,"SELECT product_id,combo_product_id FROM tbl_product_to_warehouse WHERE id='".$ptw_id."'"));
    	    if($sqlS->product_id!=0)
    	    {
    	        $sqlInsert=mysqli_query($db_handle,"INSERT INTO tbl_outward_adjustment SET sku='".$id."',warehouse_id='".$warehouse_id."',rack_id='".$rack_id."',unit_price='".$unit."',quantity='".$quantity."',creation_date='".$date."',buyer='".mysqli_real_escape_string($db_handle,$_REQUEST['buyer'])."',reason='".mysqli_real_escape_string($db_handle,$_REQUEST['reason'])."'");
    	        $sqlupdt2=mysqli_query($db_handle,"UPDATE tbl_product_to_warehouse SET quantity='".$remaining_quant."',total_price='".$total_price_now."' WHERE id='".$ptw_id."'");
    	        $sqlSs=mysqli_fetch_object(mysqli_query($db_handle,"SELECT total_price,quantity FROM tbl_products WHERE id='".$sqlS->product_id."'"));
    	       // $updated_total1=$sqlSs->total_price-number_format(($quantity*$unit_price),'2','.','');
    	       // $updated_total=number_format($updated_total1,'2','.','');
    	        $updated_quant=$sqlSs->quantity-$quantity;
    	        $updated_total1=$sqlSs->total_price-number_format(($quantity*$unit),'2','.','');
    	        $updated_total=number_format($updated_total1,'2','.','');
    	       // echo $updated_total;
    	       // echo $sqlSs->total_price-number_format(($quantity*$unit),'2','.','');
    	        $sqlupdt3=mysqli_query($db_handle,"UPDATE tbl_products SET quantity='".$updated_quant."',total_price='".$updated_total."' WHERE id='".$sqlS->product_id."'");
    	        header("location:outward_adjustment.php?msg=1");
    	    }
    	    elseif($sqlS->combo_product_id!=0)
    	    {
    	        
    	        $sqlSs=mysqli_fetch_object(mysqli_query($db_handle,"SELECT total_price,quantity FROM tbl_combo_product WHERE id='".$sqlS->combo_product_id."'"));
    	        $updated_total1=$sqlSs->total_price-number_format(($quantity*$unit),'2','.','');
    	        $updated_total=number_format($updated_total1,'2','.','');
    	        $updated_quant=$sqlSs->quantity-$quantity;
    	        $current_total=$sqlSs->total_price;
    	        /*$outward_total=$quantity*$unit;
    	        $new_total=$current_total-$outward_total;
    	        $new_total=number_format($new_total,'2','.','');
    	        echo $updated_total;*/
        	        $sql_combo_details=mysqli_query($db_handle,"SELECT * FROM tbl_combo_product_details WHERE combo_product_id='".$sqlS->combo_product_id."'");
                    while($sql_combo=mysqli_fetch_object($sql_combo_details))
                    {
                                    $combo_detail_quantity=$sql_combo->quantity;
                                    $combo_detail_unit=$sql_combo->unit_price;
                                    $com_detail_product_id=$sql_combo->product_id;
                                    $added_combo_quant=$combo_detail_quantity/$sqlSs->quantity;
                                    $new_combo_quant1=$added_combo_quant*$quantity;
                                    $new_combo_quant=$combo_detail_quantity-$new_combo_quant1;
                                    if($new_combo_quant>=0)
                                    {
                                        $i++;
                                    }
                                    
                    }
                    
                    if($i>0)
                    {
                        $sql_combo_details1=mysqli_query($db_handle,"SELECT * FROM tbl_combo_product_details WHERE combo_product_id='".$sqlS->combo_product_id."'");
                        while($sql_combo=mysqli_fetch_object($sql_combo_details1))
                        {
                                        $combo_detail_quantity=$sql_combo->quantity;
                                        $combo_detail_unit=$sql_combo->unit_price;
                                        $com_detail_product_id=$sql_combo->product_id;
                                        $com_detail_id=$sql_combo->id;
                                        $added_combo_quant=$combo_detail_quantity/$sqlSs->quantity;
                                        $new_combo_quant1=$added_combo_quant*$quantity;
                                        $new_combo_quant=$combo_detail_quantity-$new_combo_quant1;
                                        $new_combo_total=number_format(($new_combo_quant*$combo_detail_unit),'2','.','');
                                        $sql_updt_combo_details=mysqli_query($db_handle,"UPDATE tbl_combo_product_details SET quantity='".$new_combo_quant."',total_price='".$new_combo_total."' WHERE id='".$com_detail_id."'");
                                        
                        }
                        $sqlupdt3=mysqli_query($db_handle,"UPDATE tbl_combo_product SET quantity='".$updated_quant."',total_price='".$updated_total."' WHERE id='".$sqlS->combo_product_id."'");
                        // $sqlupdate2=mysqli_query($db_handle,"UPDATE tbl_combo_product SET quantity='".$new_combo_pro_quantity."',total_price='".number_format($new_combo_pro_total,'2','.','')."' WHERE id='".$combo_pro_id."'");
            	        $sqlInsert=mysqli_query($db_handle,"INSERT INTO tbl_outward_adjustment SET sku='".$id."',warehouse_id='".$warehouse_id."',rack_id='".$rack_id."',unit_price='".$unit."',quantity='".$quantity."',creation_date='".$date."',buyer='".mysqli_real_escape_string($db_handle,$_REQUEST['buyer'])."',reason='".mysqli_real_escape_string($db_handle,$_REQUEST['reason'])."'");
    	                $sqlupdt2=mysqli_query($db_handle,"UPDATE tbl_product_to_warehouse SET quantity='".$remaining_quant."',total_price='".$total_price_now."' WHERE id='".$ptw_id."'");	        
                        header("location:outward_adjustment.php?msg=1");
                    }
                    else
                    {
                        header("Location:outward_adjustment.php?msg=1");
                    }
                            	        
    	    }
    	 }
	    
	}
?>	