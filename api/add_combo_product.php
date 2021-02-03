<?php
include_once("config.php");
    $statusdata=array();
    $json=$_POST['data'];
	$data=json_decode($json, TRUE);
	$warehouse_id=$data['warehouse_id'];
	$rack_id=$data['rack_id'];
	$sku=$data['sku_id'];
	$combo_quantity=$data['quantity'];
	$user_id=$data['user_id'];
	
	$data1=$data['product_info'];
	$total_price=0;
	$total_quantity=0;
        $i=0;
        $data=array();
        $dataArray=array();
        foreach($data1 as $val)
        {
            $sku_id=$val['sku_id'];
            $sqlproid=mysqli_fetch_object(mysqli_query($db_handle,"SELECT s.product_id,p.unit_price FROM tbl_sku s LEFT JOIN tbl_products p ON p.id=s.product_id WHERE s.id='".$sku_id."'"));
            $productid=$sqlproid->product_id;
            $unit_price=$sqlproid->unit_price;
            $total_price=$total_price+$val['total_price'];
            $total_quantity=$total_quantity+$val['quant'];
            $data[] = array(
                'product_id'=>$productid,
                'ptw_id'    =>$val['id'],
                'unit_price'=>$unit_price,
                'rack_quant'=>$val['qty'],
                'quantity'=>$val['quant'],
                'total_price'=>$val['total_price']
            );
        }
	    $total_price=number_format($total_price,'2','.','');
        $combo_unit_price= $total_price/$combo_quantity;
        $combo_unit_price=number_format($combo_unit_price,'2','.','');
        $sqladd=mysqli_query($db_handle,"INSERT INTO tbl_combo_product SET barcode_no='',warehouse_id='".mysqli_real_escape_string($db_handle,$warehouse_id)."',rack_id='".mysqli_real_escape_string($db_handle,$rack_id)."',sku='".mysqli_real_escape_string($db_handle,$sku)."',price='".mysqli_real_escape_string($db_handle,$combo_unit_price)."',total_price='".$total_price."',quantity='".$combo_quantity."',creation_date=NOW(),created_by='".$user_id."',modification_date=NOW(),modified_by='".$user_id."'");
        $lastID=mysqli_insert_id($db_handle);
        
        $rand_code = $lastID;
        $bar_code=str_pad($rand_code,10,"0",STR_PAD_LEFT);	 
        $barcode_upd=mysqli_query($db_handle,"UPDATE tbl_combo_product SET barcode_no='".$bar_code."' where id='".$lastID."'");
        $skuupd=mysqli_query($db_handle,"UPDATE tbl_sku SET combo_product_id='".$lastID."' WHERE id='".$sku."'");
        $sqlcombo=mysqli_query($db_handle,"INSERT INTO tbl_product_to_warehouse SET combo_product_id='".$lastID."',warehouse_id='".$warehouse_id."',rack_id='".$rack_id."',unit_price='".$combo_unit_price."',quantity='".$combo_quantity."',total_price='".$total_price."',status='1'");
         
        
            $total_amount=$combo_quantity*$total_price;
            // echo $total_amount;
            $sqladd=mysqli_query($db_handle,"INSERT INTO tbl_combo_product SET barcode_no='',warehouse_id='".mysqli_real_escape_string($db_handle,$warehouse_id)."',rack_id='".mysqli_real_escape_string($db_handle,$rack_id)."',sku='".mysqli_real_escape_string($db_handle,$sku)."',price='".mysqli_real_escape_string($db_handle,$total_price)."',total_price='".number_format($total_amount,'2','.','')."',quantity='".$combo_quantity."',creation_date=NOW(),created_by='".$user_id."',modification_date=NOW(),modified_by='".$user_id."'");
        	$lastID=mysqli_insert_id($db_handle);
        	//echo $lastID;
        	$rand_code = $lastID;
            $bar_code=str_pad($rand_code,10,"0",STR_PAD_LEFT);	 
            $barcode_upd=mysqli_query($db_handle,"UPDATE tbl_combo_product SET barcode_no='".$bar_code."' where id='".$lastID."'");
            $skuupd=mysqli_query($db_handle,"UPDATE tbl_sku SET combo_product_id='".$lastID."' WHERE id='".$sku."'");
            $sqlcombo=mysqli_query($db_handle,"INSERT INTO tbl_product_to_warehouse SET combo_product_id='".$lastID."',warehouse_id='".$warehouse_id."',rack_id='".$rack_id."',unit_price='".$total_price."',quantity='".$combo_quantity."',total_price='".number_format($total_amount,'2','.','')."',status='1'");
               
            
                    foreach($data as $combo)
            		{
            		    
            		    $product_id=$combo['product_id'];
            		    $unit_price=$combo['unit_price'];
            		    $product_quantity=$combo['quantity'];
            		    $rack_quant12=$combo['rack_quant'];
            		    $product_to_warehouse_id=$combo['ptw_id'];

            		    $rack_quantity=$rack_quant12-$product_quantity;
            		    $rack_total_price=$rack_quantity*$unit_price;
            		    $rack_total_price=number_format($rack_total_price,'2','.','');
            		    
            		    $total_amount1=$combo['total_price'];
            		  //  $total1=$unit_price*$product_quantity1;
            		    
            		    
            		    if(!(in_array($combo['product_id'],$dataArray)))
                        {
                            array_push($dataArray,$combo['product_id']);
                            $sqladd1=mysqli_query($db_handle,"INSERT INTO tbl_combo_product_details SET combo_product_id='".$lastID."',product_id='".$product_id."',total_price='".number_format($total_amount1,'2','.','')."',unit_price='".number_format($unit_price,'2','.','')."',quantity='".$product_quantity."'");
                        }
                        else
                        {
                            // array_push($dataArray,$combo['product_id']);
                            
                            $sqlsel4=mysqli_fetch_object(mysqli_query($db_handle,"SELECT quantity, id FROM tbl_combo_product_details WHERE product_id='".$product_id."'AND combo_product_id='".$lastID."' ORDER BY id DESC LIMIT 1"));
                            $pro_quantity1=$sqlsel4->quantity;
                            $combo_row_id=$sqlsel4->id;
                            $pro_quantity=$pro_quantity1+$product_quantity;
                            $pro_total=$pro_quantity*$unit_price;
                            $pro_total=number_format($pro_total,'2','.','');
                            $sqlcomboupdate=mysqli_query($db_handle,"UPDATE tbl_combo_product_details SET quantity='".$pro_quantity."',total_price='".$pro_total."' WHERE id='".$combo_row_id."'");
                        }
                       
                        $sqlsel1=mysqli_query($db_handle,"SELECT quantity FROM tbl_products WHERE id='".$product_id."'");
            		    $result=mysqli_fetch_object($sqlsel1);
            		    $result_quantity=$result->quantity;
            		   
            		    $remaining_product=$result_quantity-$product_quantity;
            		    $new_total=number_format(($remaining_product*$unit_price),'2','.','');
            		    
            		    $sqlupdt=mysqli_query($db_handle,"UPDATE tbl_products SET quantity='".$remaining_product."',total_price='".$new_total."' WHERE id='".$product_id."'");
            		    $sqlupdt1=mysqli_query($db_handle,"UPDATE tbl_product_to_warehouse SET quantity='".$rack_quantity."',total_price='".$rack_total_price."' WHERE id='".$product_to_warehouse_id."'");
            		    $returndata['status']="Combo product is added successfully";
            		  //  header("location:pre_packing_list.php?msg=1");
            		 }
            
        print(json_encode($returndata));
        mysqli_close($db_handle);
?>