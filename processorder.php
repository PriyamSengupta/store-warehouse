<?php
session_start();

	if(@$_SESSION['valid_admin'] == "" )
	{
	    @header("Location:login.php");
	}

	include_once("include/inc.php");
	if(isset($_POST["add"]))
	{
	   // echo "<pre>";
	   // print_r($_POST);
	   // echo "</pre>";
	    
	    $date = date('Y-m-d H:i:s');
	    $order_id=$_POST['order_id'];
	    $sku=$_POST['sku'];
        $quantity=$_POST['quantity'];
        $rack_quant=$_POST['rack_quant'];
        $ptw=$_POST['ptw_id'];
        $flag=$_POST['flag'];
        $total_quantity=0;
        $total_quantity1=0;
        
        $i=0;
        $j=0;
        $k=0;
        $data=array();
                foreach($flag as $key=>$val)
                {
                    if($val!='')
                    {
                        $val2 = $quantity[$key];
                        $val3 = $ptw[$key];
                        $val4 = $rack_quant[$key];
                        $val5 = $sku[$key];
                        $sqls=mysqli_fetch_object(mysqli_query($db_handle,"SELECT * FROM tbl_product_to_warehouse WHERE id='".$val3."'"));
                        $unit=$sqls->unit_price;
                        $total1=$unit*$val2;
                        $total_price=number_format($total1,'2','.','');
                        $rack_total=$sqls->total_price;
                        $total_quantity=$total_quantity+$val2;
                        $data[$key] = array(
                            'flag'=>$val,
                            'quantity'=>$val2,
                            'ptw_id'=>$val3,
                            'rack_quant'=>$val4,
                            'unit_price'=>$unit,
                            'total_price'=>$total_price,
                            'rack_total'=>$rack_total,
                            'warehouse_id'=>$sqls->warehouse_id,
                            'rack_id'=>$sqls->rack_id,
                            'sku'=>$val5
                            );
                    }        
                }
 	  //  echo "<pre>";
	   // print_r($data);
	   // echo "</pre>";         
	    
	    $sqlss=mysqli_query($db_handle,"SELECT quantity FROM tbl_order_details WHERE order_id='".$order_id."'");
	    while($sqlss1=mysqli_fetch_object($sqlss))
	    {
	        $total_quantity1=$total_quantity1+$sqlss1->quantity;
	    }
	    if($total_quantity>$total_quantity1)
	    {
	        header("location:order_list.php?id=1&msg=4&status=1");
	    }
	    else
	    {
	        $sqlss2=mysqli_query($db_handle,"SELECT sku,quantity FROM tbl_order_details WHERE order_id='".$order_id."'");
	        
	        while($sqlss3=mysqli_fetch_object($sqlss2))
	        {
	            $order_sku=$sqlss3->sku;
	            $quantity2=0;
	            foreach($data as $product1)
	            {
	                if($order_sku==$product1['sku'])
	                {
	                    $quantity2=$quantity2+$product1['quantity'];
	                }
	                $data2[]=array(
	                    'sku'=>$order_sku,
	                    'quantity'=>$quantity2
	                    );
	            }
	            if($sqlss3->quantity<$quantity2)
	            {
	                $i++;
	            }
	            elseif($sqlss3->quantity>$quantity2)
	            {
	                $k++;
	            }
	        }
	        if($i>0)
	        {
	            
	           header("location:order_list.php?id=1&msg=4&status=2"); 
	           //echo "<pre>";
	           //print_r($data2);
	           //echo "</pre>";
	        }
	        else
	        {
	            //echo $k;
	            if($k>0)
	            {
	                $sqlss4=mysqli_query($db_handle,"SELECT sku,quantity FROM tbl_order_details WHERE order_id='".$order_id."'");
        	        while($sqlss5=mysqli_fetch_object($sqlss4))
        	        {
        	            $order_sku1=$sqlss5->sku;
        	            $quantity3=0;
        	            foreach($data as $product2)
        	            {
        	                if($order_sku1==$product2['sku'])
        	                {
        	                    $quantity3=$quantity3+$product2['quantity'];
        	                }
        	            }
        	            $data3[]=array(
    	                    'sku'=>$order_sku1,
    	                    'quantity'=>$quantity3
	                    );
        	            $sqlupdate3=mysqli_query($db_handle,"UPDATE tbl_order_details SET quantity='".$quantity3."' WHERE order_id='".$order_id."' AND sku='".$order_sku1."'");
        	        }
        	        $sqlinsrt=mysqli_query($db_handle,"INSERT INTO tbl_revised_order SET order_id='".$order_id."',revised='1'");
	            }
	           // echo "<pre>";
	           // print_r($data3);
	           // echo "</pre>";
	            
    	        foreach($data as $product)
        		{
        		    $rack_quantity=$product['rack_quant'];
        		    $warehouse = $product['warehouse_id'];
        		    $rack= $product['rack_id'];
        		    $quantity = $product['quantity'];
        		    $total = $product['total_price'];
                    
        		    $sku = $product['sku'];
        		    $ptw_id=$product['ptw_id'];
        			
        		        $sqladd1=mysqli_query($db_handle,"INSERT INTO tbl_processed_order SET order_id='".$order_id."',sku='".$sku."',warehouse_id='".$warehouse."',rack_id='".$rack."',unit_price='".$product['unit_price']."',quantity='".$quantity."'");
        		        $remaining_row_total=$product['rack_total']-$total;
        		        $remaining_row_quant=$rack_quantity-$quantity;
        		        	
        		        $sqlupdate1=mysqli_query($db_handle,"UPDATE tbl_product_to_warehouse SET quantity='".$remaining_row_quant."',total_price='".number_format($remaining_row_total,'2','.','')."' WHERE id='".$ptw_id."'");
        		        
        		        $sqlselect=mysqli_query($db_handle,"SELECT product_id,combo_product_id FROM tbl_sku WHERE id='".$sku."'");
        		        $sqls=mysqli_fetch_object($sqlselect);
        		        $pro_id=$sqls->product_id;
        		        $combo_pro_id=$sqls->combo_product_id;
        		        if($pro_id!=0)
        		        {
        		            $sqlselect1=mysqli_query($db_handle,"SELECT quantity,total_price FROM tbl_products WHERE id='".$pro_id."'");
        		            $sqls1=mysqli_fetch_object($sqlselect1);
        		            $pro_quantity=$sqls1->quantity;
        		            $pro_total=$sqls1->total_price;
        		            $new_pro_quantity=$pro_quantity-$quantity;
        		            $new_pro_total=$pro_total-$total;
        		            $sqlupdate2=mysqli_query($db_handle,"UPDATE tbl_products SET quantity='".$new_pro_quantity."',total_price='".number_format($new_pro_total,'2','.','')."' WHERE id='".$pro_id."'");
        		        }
        		        if($combo_pro_id!=0)
        		        {
        		            $sqlselect1=mysqli_query($db_handle,"SELECT quantity,total_price FROM tbl_combo_product WHERE id='".$combo_pro_id."'");
        		            $sqls1=mysqli_fetch_object($sqlselect1);
        		            $combo_pro_quantity=$sqls1->quantity;
        		            $combo_pro_total=$sqls1->total_price;
        		            $new_combo_pro_quantity=$combo_pro_quantity-$quantity;
        		            $new_combo_pro_total=$combo_pro_total-$total;
        		            
        		        
        		            $sql_combo_details=mysqli_query($db_handle,"SELECT * FROM tbl_combo_product_details WHERE combo_product_id='".$combo_pro_id."'");
                            while($sql_combo=mysqli_fetch_object($sql_combo_details))
                            {
                                $combo_detail_quantity=$sql_combo->quantity;
                                $combo_detail_unit=$sql_combo->unit_price;
                                $com_detail_product_id=$sql_combo->product_id;
                                $qty_per_combo=$sql_combo->qty_per_combo;
                        
                                
                                $new_combo_quant1=$qty_per_combo*$quantity;
                                $new_combo_quant=$combo_detail_quantity-$new_combo_quant1;
                                if($new_combo_quant>=0)
                                {
                                    $j++;
                                }
                            }
                            
                            if($j>0)
                            {
                                $sql_combo_details1=mysqli_query($db_handle,"SELECT * FROM tbl_combo_product_details WHERE combo_product_id='".$combo_pro_id."'");
                                while($sql_combo1=mysqli_fetch_object($sql_combo_details1))
                                {
                                    $combo_detail_quantity=$sql_combo1->quantity;
                                    $combo_detail_unit=$sql_combo1->unit_price;
                                    $com_detail_product_id=$sql_combo1->product_id;
                                    $qty_per_combo=$sql_combo1->qty_per_combo;
                                    $combo_detail_id=$sql_combo1->id;
                                    $new_combo_quant1=$qty_per_combo*$quantity;
                                    $new_combo_quant=$combo_detail_quantity-$new_combo_quant1;
                                    $new_combo_total1=number_format(($new_combo_quant*$combo_detail_unit),'2','.','');
                                    // $new_combo_total=number_format(($new_combo_total1+$sql_combo->total_price),'2','.','');
                                    $new_combo_total=number_format(($new_combo_quant*$combo_detail_unit),'2','.','');
                                    $sql_updt_combo_details=mysqli_query($db_handle,"UPDATE tbl_combo_product_details SET quantity='".$new_combo_quant."',total_price='".$new_combo_total1."' WHERE id='".$combo_detail_id."'");
                                    
                                }
                                $sqlupdate2=mysqli_query($db_handle,"UPDATE tbl_combo_product SET quantity='".$new_combo_pro_quantity."',total_price='".number_format($new_combo_pro_total,'2','.','')."' WHERE id='".$combo_pro_id."'");
                            }
                            else
                            {
                                    header("location:order_list.php?id=1&msg=6&status=2");
                            }
                            
        		        }
        		  
        		}
        		$sqlfinalupdt=mysqli_query($db_handle,"UPDATE tbl_order SET status='1',processed_by='".$_SESSION['id']."',process_date='".$date."' WHERE id='".$order_id."'");
                header("location:order_list.php?id=1&msg=1");
    	            
    	   }
	    }    
	}
?>