<?php
include_once("config.php");
        $data=array();
        
        $sku=$_POST['sku'];
	   // $name=$_POST['name'];
	    $warehouse=$_POST['warehouse_id'];
	    $rack=$_POST['rack_id'];
	    $quantity=$_POST['quantity'];
	    $unit_price=$_POST['unit_price'];
	    $return_from=$_POST['return_from'];
	    $reason=$_POST['return_for'];
	    $condition=$_POST['condition'];
	    
	   // $sqlQ=mysqli_query($db_handle,"SELECT * FROM tbl_sku s LEFT JOIN tbl_products p ON p.sku=s.id WHERE s.name='".mysqli_real_escape_string($db_handle,$sku)."'");
    // 	$sqlQ1=mysqli_query($db_handle,"SELECT * FROM tbl_sku s LEFT JOIN tbl_combo_product cp ON cp.sku=s.id WHERE s.name='".mysqli_real_escape_string($db_handle,$sku)."'");
    $sqlQ=mysqli_query($db_handle,"SELECT * FROM tbl_sku WHERE name='".mysqli_real_escape_string($db_handle,$sku)."' AND (product_id!='0' OR combo_product_id!='0')");
    	
    	if(mysqli_num_rows($sqlQ)==0)
    	{ 	
             	$data['status']="Sku is not listed in any warehouse";
    	}	
    	else
    	{
    		
	    
	    if($condition=="1")
	    {
    	    $sqlquery=mysqli_query($db_handle,"SELECT id,product_id,combo_product_id FROM tbl_sku WHERE name='".mysqli_real_escape_string($db_handle,$sku)."'");
    	    $sqlquery1=mysqli_fetch_object($sqlquery);
    	    $sku_id=$sqlquery1->id;
    	    $pro_id=$sqlquery1->product_id;
            $combo_pro_id=$sqlquery1->combo_product_id;
            
            if($pro_id!=0)
            {
                $sqlpro=mysqli_query($db_handle,"SELECT quantity,total_price FROM tbl_products WHERE id='".$pro_id."'");
                $sqlpro1=mysqli_fetch_object($sqlpro);
                $current_quantity=$sqlpro1->quantity;
                $total_price1=$sqlpro1->total_price;
                
                $new_quantity=$current_quantity+$quantity;
                $added_price=number_format(($quantity*$unit_price),'2','.','');
                $total_price=number_format(($total_price1+$added_price),'2','.','');
                $sql_pro_updt= mysqli_query($db_handle,"UPDATE tbl_products SET quantity='".$new_quantity."',total_price='".$total_price."',modification_date=NOW(),modified_by='".$_SESSION['id']."' WHERE id='".$pro_id."'");
            
                $sqlcheck=mysqli_query($db_handle,"SELECT * FROM tbl_product_to_warehouse WHERE product_id='".$pro_id."' AND rack_id='".$rack."'");
                $sqlcount=mysqli_num_rows($sqlcheck);
                //echo $sqlcount;
                if($sqlcount>0)
                {
                    $sqlrow=mysqli_fetch_object($sqlcheck);
                    $status=$sqlrow->status;
                    if($status==1){
                        $prev_quantity=$sqlrow->quantity;
                        $ptw_id=$sqlrow->id;
                        $total_amount1=$sqlrow->total_price;
                        // $added_price1=number_format(($quantity*$unit_price),'2','.','');
                        $total_amount=number_format(($total_amount1+$added_price),'2','.','');
                        $new_quant=$prev_quantity+$quantity;
                        // $new_total_price=number_format(($unit_price*$new_quant),'2','.','');
                        $sqlupdt=mysqli_query($db_handle,"UPDATE tbl_product_to_warehouse SET quantity='".$new_quant."',total_price='".$total_amount."' WHERE id='".$ptw_id."'");
                    }
                    else
                    {
                       $data["status"]="Same SKU with damaged condition is in the rack. Please choose a different rack/warehouse!";
                    }
                }
                else
                {
                    $sqlinsert=mysqli_query($db_handle,"INSERT INTO tbl_product_to_warehouse SET product_id='".$pro_id."',combo_product_id='0',warehouse_id='".$warehouse."',rack_id='".$rack."',unit_price='".number_format($unit_price,'2','.','')."',quantity='".$quantity."',total_price='".$added_price."'");
                }
                
            }
            if($combo_pro_id!=0)
            {
                $sqlpro=mysqli_query($db_handle,"SELECT quantity,total_price FROM tbl_combo_product WHERE id='".$combo_pro_id."'");
                $sqlpro1=mysqli_fetch_object($sqlpro);
                // $wh_id=$sqlpro1->warehouse_id;
                $current_quantity=$sqlpro1->quantity;
                $total_price1=$sqlpro1->total_price;
                
                $new_quantity=$current_quantity+$quantity;
                $added_price=number_format(($quantity*$unit_price),'2','.','');
                $total_price=number_format(($total_price1+$added_price),'2','.','');
                // $total_price=number_format(($price*$new_quantity),'2','.','');
                $sql_pro_updt= mysqli_query($db_handle,"UPDATE tbl_combo_product SET quantity='".$new_quantity."',total_price='".$total_price."',modification_date=NOW(),modified_by='".$_SESSION['id']."' WHERE id='".$combo_pro_id."'");
                
                $sqlcheck=mysqli_query($db_handle,"SELECT * FROM tbl_product_to_warehouse WHERE combo_product_id='".$combo_pro_id."' AND rack_id='".$rack."'");
                $sqlcount=mysqli_num_rows($sqlcheck);
                //echo $sqlcount;
                if($sqlcount>0)
                {
                    $sqlrow=mysqli_fetch_object($sqlcheck);
                    $status=$sqlrow->status;
                    if($status==1){
                        $prev_quantity=$sqlrow->quantity;
                        $ptw_id=$sqlrow->id;
                        $total_amount1=$sqlrow->total_price;
                        // $added_price1=number_format(($quantity*$unit_price),'2','.','');
                        $total_amount=number_format(($total_amount1+$added_price),'2','.','');
                        $new_quant=$prev_quantity+$quantity;
                        $new_total_price=number_format(($price*$new_quant),'2','.','');
                        $sqlupdt=mysqli_query($db_handle,"UPDATE tbl_product_to_warehouse SET quantity='".$new_quant."',total_price='".$total_amount."' WHERE id='".$ptw_id."'");                    
                    } 
                    else
                    {
                        $data["status"]="Same SKU with damaged condition is in the rack. Please choose a different rack/warehouse!";
                    }
                }
                else
                {
                    $sqlinsert=mysqli_query($db_handle,"INSERT INTO tbl_product_to_warehouse SET product_id='0',combo_product_id='".$combo_pro_id."',warehouse_id='".$warehouse."',rack_id='".$rack."',unit_price='".number_format($unit_price,'2','.','')."',quantity='".$quantity."',total_price='".$added_price."'");
                }
                
            }
            $sqlinsrt=mysqli_query($db_handle,"INSERT INTO tbl_returned_product SET sku='".$sku_id."',warehouse_id='".$warehouse."',rack_id='".$rack."',quantity='".$quantity."',unit_price='".number_format($unit_price,'2','.','')."',total_price='".$added_price."',return_from='".mysqli_real_escape_string($db_handle,$return_from)."',reason_for_return='".mysqli_real_escape_string($db_handle,$reason)."',status='".$condition."'");
            if($sqlinsrt==true)
	        {
	            $data["status"]="Successfully returned";
	        }
	    }
	    if($condition=="0")
	    {
	        $sqlquery=mysqli_query($db_handle,"SELECT id,product_id,combo_product_id FROM tbl_sku WHERE name='".mysqli_real_escape_string($db_handle,$sku)."'");
    	    $sqlquery1=mysqli_fetch_object($sqlquery);
    	    $sku_id=$sqlquery1->id;
    	    $pro_id=$sqlquery1->product_id;
            $combo_pro_id=$sqlquery1->combo_product_id;
            //echo $pro_id;
            if($pro_id!=0)
            {
                $sqlpro=mysqli_query($db_handle,"SELECT quantity,total_price FROM tbl_products WHERE id='".$pro_id."'");
                $sqlpro1=mysqli_fetch_object($sqlpro);
                $current_quantity=$sqlpro1->quantity;
                $total_price1=$sqlpro1->total_price;
                
                $new_quantity=$current_quantity+$quantity;
                $added_price=number_format(($quantity*$unit_price),'2','.','');
                $total_price=number_format(($total_price1+$added_price),'2','.','');
                
                // $total_price=number_format(($unit_price*$new_quantity),'2','.','');
                $sql_pro_updt= mysqli_query($db_handle,"UPDATE tbl_products SET quantity='".$new_quantity."',total_price='".$total_price."',modification_date=NOW(),modified_by='".$_SESSION['id']."' WHERE id='".$pro_id."'");
            
                $sqlcheck=mysqli_query($db_handle,"SELECT * FROM tbl_product_to_warehouse WHERE product_id='".$pro_id."' AND rack_id='".$rack."'");
                $sqlcount=mysqli_num_rows($sqlcheck);
                //echo $sqlcount;
                if($sqlcount>0)
                {
                    $sqlrow=mysqli_fetch_object($sqlcheck);
                    $status=$sqlrow->status;
                    if($status==1){
                        $prev_quantity=$sqlrow->quantity;
                        $ptw_id=$sqlrow->id;
                        $total_amount1=$sqlrow->total_price;
                        $total_amount=number_format(($total_amount1+$added_price),'2','.','');
                        $new_quant=$prev_quantity+$quantity;
                        $new_total_price=number_format(($unit_price*$new_quant),'2','.','');
                        $sqlupdt=mysqli_query($db_handle,"UPDATE tbl_product_to_warehouse SET quantity='".$new_quant."',total_price='".$total_amount."' WHERE id='".$ptw_id."'");
                    }
                    else
                    {
                        $data["status"]="Same SKU with working condition is in the rack. Please choose a different rack/warehouse!";  
                    }
                }
                else
                {
                    $sqlinsert=mysqli_query($db_handle,"INSERT INTO tbl_product_to_warehouse SET product_id='".$pro_id."',combo_product_id='0',warehouse_id='".$warehouse."',rack_id='".$rack."',unit_price='".number_format($unit_price,'2','.','')."',quantity='".$quantity."',total_price='".$added_price."'");
                }
                
            }
            if($combo_pro_id!=0)
            {
                $sqlpro=mysqli_query($db_handle,"SELECT quantity,total_price FROM tbl_combo_product WHERE id='".$combo_pro_id."'");
                $sqlpro1=mysqli_fetch_object($sqlpro);
                // $wh_id=$sqlpro1->warehouse_id;
                $current_quantity=$sqlpro1->quantity;
                $total_price1=$sqlpro1->total_price;
                
                $new_quantity=$current_quantity+$quantity;
                $added_price=number_format(($quantity*$unit_price),'2','.','');
                $total_price=number_format(($total_price1+$added_price),'2','.','');
                // $total_price=number_format(($price*$new_quantity),'2','.','');
                $sql_pro_updt= mysqli_query($db_handle,"UPDATE tbl_combo_product SET quantity='".$new_quantity."',total_price='".$total_price."',modification_date=NOW(),modified_by='".$_SESSION['id']."' WHERE id='".$combo_pro_id."'");
                
                $sqlcheck=mysqli_query($db_handle,"SELECT * FROM tbl_product_to_warehouse WHERE combo_product_id='".$combo_pro_id."' AND rack_id='".$rack."'");
                $sqlcount=mysqli_num_rows($sqlcheck);
                //echo $sqlcount;
                if($sqlcount>0)
                {
                    $sqlrow=mysqli_fetch_object($sqlcheck);
                    $status=$sqlrow->status;
                    if($status==0){
                        $prev_quantity=$sqlrow->quantity;
                        $ptw_id=$sqlrow->id;
                        $total_amount1=$sqlrow->total_price;
                        $total_amount=number_format(($total_amount1+$added_price),'2','.','');
                        $new_quant=$prev_quantity+$quantity;
                        $new_total_price=number_format(($price*$new_quant),'2','.','');
                        $sqlupdt=mysqli_query($db_handle,"UPDATE tbl_product_to_warehouse SET quantity='".$new_quant."',total_price='".$total_amount."' WHERE id='".$ptw_id."'");                    
                    } 
                    else
                    {
                        $data["status"]="Same SKU with working condition is in the rack. Please choose a different rack/warehouse!"; 
                    }
                }
                else
                {
                    $sqlinsert=mysqli_query($db_handle,"INSERT INTO tbl_product_to_warehouse SET product_id='0',combo_product_id='".$combo_pro_id."',warehouse_id='".$warehouse."',rack_id='".$rack."',unit_price='".number_format($unit_price,'2','.','')."',quantity='".$quantity."',total_price='".$added_price."'");
                }
                
            }
            $sqlinsrt=mysqli_query($db_handle,"INSERT INTO tbl_returned_product SET sku='".$sku_id."',warehouse_id='".$warehouse."',rack_id='".$rack."',quantity='".$quantity."',unit_price='".number_format($unit_price,'2','.','')."',total_price='".$added_price."',return_from='".mysqli_real_escape_string($db_handle,$return_from)."',reason_for_return='".mysqli_real_escape_string($db_handle,$reason)."',status='".$condition."'");
	        if($sqlinsrt==true)
	        {
	            $data["status"]="Successfully returned";
	        }
	    }   
	    }
        print(json_encode($data));
        mysqli_close($db_handle);
        
?>