<?php 

	session_start();

	if(@$_SESSION['valid_admin'] == "" )

	{

	@header("Location:login.php");

	}

	include_once("include/inc.php");

	

	if(isset($_POST["add"]))
	{
	    $ptw_id=$_POST['ptw_id'];
	    $quantity=$_POST['quantity'];
	    $sqlcheckquant=mysqli_fetch_object(mysqli_query($db_handle,"SELECT * FROM tbl_product_to_warehouse WHERE id='".$ptw_id."'"));
        
        if($quantity>$sqlcheckquant->quantity)
        {
            header("location:shortage_transaction.php?msg=2");    
        }
        else
        {
    	    $date = date('Y-m-d H:i:s');
    	    $sku=$_POST['sku'];
    	    $sqlsel=mysqli_fetch_object(mysqli_query($db_handle,"SELECT id,product_id,combo_product_id FROM tbl_sku WHERE name='".mysqli_real_escape_string($db_handle,$sku)."'"));
    	    $skuid=$sqlsel->id;
    	    $pro_id=$sqlsel->product_id;
    	    $combo_pro_id=$sqlsel->combo_product_id;
            $from_wh=$_POST['warehouse_id'];
            
            
            $to_wh=$_POST['warehouse_id1'];
            $dest_rack_id=$_POST['rack_id'];
            $reason=$_POST['reason'];
            $sqlsel1=mysqli_fetch_object(mysqli_query($db_handle,"SELECT * FROM tbl_product_to_warehouse WHERE id='".$ptw_id."'"));
            $rack_quantity=$sqlsel1->quantity;
            $source_rack_id=$sqlsel1->rack_id;
            $unit_price=$sqlsel1->unit_price;
            $ptw_total=$sqlsel1->total_price;
            
            $updated_quantity=$rack_quantity-$quantity;
            $updated_total_price=$updated_quantity*$unit_price;
            
            
                $sqlupdt=mysqli_query($db_handle,"UPDATE tbl_product_to_warehouse SET quantity='".$updated_quantity."',total_price='".number_format($updated_total_price,'2','.','')."' WHERE id='".$ptw_id."'");
                
                
                
                
                if($pro_id!=0)
                {
                    $sqlS=mysqli_fetch_object(mysqli_query($db_handle,"SELECT * FROM tbl_products WHERE id='".$pro_id."'"));
                    $pro_quant=$sqlS->quantity;
                    $pro_unit=$sqlS->unit_price;
                    $curr_quant=$pro_quant-$quantity;
                    $new_total1=$sqlS->total_price-$ptw_total;
                    $curr_total=$new_total1+$updated_total_price;
                    $curr_total=number_format($curr_total,'2','.','');
                    $sqlupdate=mysqli_query($db_handle,"UPDATE tbl_products SET quantity='".$curr_quant."',total_price='".$curr_total."',modification_date='".$date."' WHERE id='".$pro_id."'");
                    
                }
                elseif($combo_pro_id!=0)
                {
                    $sqlS=mysqli_fetch_object(mysqli_query($db_handle,"SELECT * FROM tbl_combo_product WHERE id='".$combo_pro_id."'"));
                    $pro_quant=$sqlS->quantity;
                    $pro_unit=$sqlS->price;
                    $curr_quant=$pro_quant-$quantity;
                    $curr_total=number_format(($curr_quant*$pro_unit),'2','.',''); 
                    $sqlupdate=mysqli_query($db_handle,"UPDATE tbl_combo_product SET quantity='".$curr_quant."',total_price='".$curr_total."',modification_date='".$date."' WHERE id='".$combo_pro_id."'");
                    
                    $sqlS1=mysqli_query($db_handle,"SELECT * FROM tbl_combo_product_details WHERE combo_product_id='".$combo_pro_id."'");
                    while($sql_combo=mysqli_fetch_object($sqlS1))
                    {
                        $combo_detail_quantity=$sql_combo->quantity;
                        $combo_detail_unit=$sql_combo->unit_price;
                        $com_detail_product_id=$sql_combo->product_id;
                        $qty_per_combo=$sql_combo->qty_per_combo;
                        $combo_detail_id=$sql_combo->id;
                        
                        $deducted_quant=$qty_per_combo*$quantity;
                        $curr_quant1=$combo_detail_quantity-$deducted_quant;
                        $curr_total1=number_format(($combo_detail_unit*$curr_quant1),'2','.','');
                        
                        $sql_updt_combo_details=mysqli_query($db_handle,"UPDATE tbl_combo_product_details SET quantity='".$curr_quant1."',total_price='".$curr_total1."' WHERE id='".$combo_detail_id."'");
                
                    }
                    
                }
                
                
                $sqladd1=mysqli_query($db_handle,"INSERT INTO tbl_shortage_transaction SET sku='".$skuid."',ptw_id='0',from_warehouse='".$from_wh."',from_rack='".$source_rack_id."',to_warehouse='".$to_wh."',to_rack='".$dest_rack_id."',unit_price='".$unit_price."',quantity='".$quantity."',reason='".mysqli_real_escape_string($db_handle,$reason)."',creation_date='".$date."',created_by='".$_SESSION['id']."'");
        
        		header("location:shortage_transaction.php?msg=1");
        }	
	}

	?>