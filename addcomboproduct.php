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
	   //$qty_per_combo1=0;
	   // echo "<pre>";
	   // print_r($_POST);
	   // echo "</pre>";
	   if($_REQUEST['sku']==''){
	       header("location:add_combo_product.php?msg=1");
	   }
	   else
	   {
        
        $pro_id=$_POST['product_id'];
        $unit=$_POST['unit_price'];
        $quantity=$_POST['quantity'];
        $total=$_POST['total_price'];
        $warehouse_id=$_POST['warehouse_id'];
        $rack_id=$_POST['rack_id'];
        $rack_quant=$_POST['rack_quant'];
        $ptw_id=$_POST['ptw_id'];
        $combo_quantity=$_POST['quant'];
        $total_price1=0;
        $total_quantity=0;
        $i=0;
        $data=array();
                foreach($pro_id as $key=>$val)
                {
                    $val2 = $unit[$key];
                    $val3 = $quantity[$key];
                    $val4 = $total[$key];
                    $val5 = $warehouse_id[$key];
                    $val6 = $rack_id[$key];
                    $val7 = $ptw_id[$key];
                    $val8 = $rack_quant[$key];
                    $total_price1=$total_price1+$val4;
                    $total_quantity=$total_quantity+$val3;
                    $data[$key] = array(
                        'product_id'=>$val,
                        'ptw_id'=>$val7,
                        'warehouse_id'=>$val5,
                        'rack_id'=>$val6,
                        'rack_quant'=>$val8,
                        'unit_price'=>$val2,
                        'quantity'=>$val3,
                        'total_price'=>$val4
                        );
                }
            //     echo "<pre>";
	           // print_r($data);
	           // echo "</pre>";    
                $total_price=number_format(($total_price1),'2','.','');
                $warehouse=$_REQUEST['warehouse'];
                $rack=$_REQUEST['rack'];
                $sku=$_REQUEST['sku'];
                $dataArray=array();
        
        
                    $combo_unit_price= $total_price/$combo_quantity;
                    $combo_unit_price=number_format($combo_unit_price,'2','.','');
                    $sqladd=mysqli_query($db_handle,"INSERT INTO tbl_combo_product SET barcode_no='',warehouse_id='".mysqli_real_escape_string($db_handle,$warehouse)."',rack_id='".mysqli_real_escape_string($db_handle,$rack)."',sku='".mysqli_real_escape_string($db_handle,$sku)."',price='".mysqli_real_escape_string($db_handle,$combo_unit_price)."',total_price='".$total_price."',quantity='".$combo_quantity."',creation_date='".$date."',created_by='".$_SESSION['id']."',modification_date='".$date."',modified_by='".$_SESSION['id']."'");
        		    $lastID=mysqli_insert_id($db_handle);
        		    //echo $lastID;
        		    $rand_code = $lastID;
            		$bar_code=str_pad($rand_code,10,"0",STR_PAD_LEFT);	 
            		$barcode_upd=mysqli_query($db_handle,"UPDATE tbl_combo_product SET barcode_no='".$bar_code."' where id='".$lastID."'");
            		$skuupd=mysqli_query($db_handle,"UPDATE tbl_sku SET combo_product_id='".$lastID."' WHERE id='".$sku."'");
            		$sqlcombo=mysqli_query($db_handle,"INSERT INTO tbl_product_to_warehouse SET combo_product_id='".$lastID."',warehouse_id='".$warehouse."',rack_id='".$rack."',unit_price='".$combo_unit_price."',quantity='".$combo_quantity."',total_price='".$total_price."',status='1',creation_date='".$date."'");
            		$sqlcombo1=mysqli_query($db_handle,"INSERT INTO tbl_stock_in SET sku='".$sku."',type='1',warehouse_id='".$warehouse."',rack_id='".$rack."',unit_price='".$combo_unit_price."',quantity='".$combo_quantity."',total_price='".$total_price."',status='1',creation_date='".$date."'");
            		foreach($data as $combo)
            		{
            		    
            		    $product_id=$combo['product_id'];
            		    $unit_price=$combo['unit_price'];
            		    $product_quantity=$combo['quantity'];
            		    $rack_quant12=$combo['rack_quant'];
            		    
            		    $qty_per_combo=$product_quantity/$combo_quantity;
            		    
            		    $product_to_warehouse_id=$combo['ptw_id'];

            		    $rack_quantity=$rack_quant12-$product_quantity;
            		    $rack_total_price=$rack_quantity*$unit_price;
            		    $rack_total_price=number_format($rack_total_price,'2','.','');
            		    
            		    $total_amount1=$combo['total_price'];
            		  //  $total1=$unit_price*$product_quantity1;
            		    
            		    
            		    if(!(in_array($combo['product_id'],$dataArray)))
                        {
                            array_push($dataArray,$combo['product_id']);
                            $sqladd1=mysqli_query($db_handle,"INSERT INTO tbl_combo_product_details SET combo_product_id='".$lastID."',product_id='".$product_id."',total_price='".number_format($total_amount1,'2','.','')."',unit_price='".number_format($unit_price,'2','.','')."',qty_per_combo='".$qty_per_combo."',quantity='".$product_quantity."'");
                        }
                        else
                        {
                            
                            $sqlsel4=mysqli_query($db_handle,"SELECT quantity,id,unit_price,qty_per_combo FROM tbl_combo_product_details WHERE product_id='".$product_id."'AND combo_product_id='".$lastID."' AND unit_price='".number_format($unit_price,'2','.','')."' ORDER BY id DESC");
                            
                            if(mysqli_num_rows($sqlsel4)>0)
                            {
                                $sqlsel5=mysqli_fetch_object($sqlsel4);
                                $pro_quantity1=$sqlsel5->quantity;
                                $combo_row_id=$sqlsel5->id;
                                $combo_row_unit=$sqlsel5->unit_price;
                                $pro_quantity=$pro_quantity1+$product_quantity;
                                $qty_per_combo1=$sqlsel5->qty_per_combo+$qty_per_combo;
                                $pro_total=$pro_quantity*$combo_row_unit;
                                $pro_total=number_format($pro_total,'2','.','');
                                
                                $sqlcomboupdate=mysqli_query($db_handle,"UPDATE tbl_combo_product_details SET quantity='".$pro_quantity."',total_price='".$pro_total."',qty_per_combo='".$qty_per_combo1."' WHERE id='".$combo_row_id."'");    
                            }
                            else
                            {
                                $sqlcomboinsert=mysqli_query($db_handle,"INSERT INTO tbl_combo_product_details SET combo_product_id='".$lastID."',product_id='".$product_id."',total_price='".number_format($total_amount1,'2','.','')."',unit_price='".number_format($unit_price,'2','.','')."',qty_per_combo='".$qty_per_combo."',quantity='".$product_quantity."'");
                            }
                            
                        }
                       
                        $sqlsel1=mysqli_query($db_handle,"SELECT total_price,quantity FROM tbl_products WHERE id='".$product_id."'");
            		    $result=mysqli_fetch_object($sqlsel1);
            		    $result_quantity=$result->quantity;
            		    $result_total_price=$result->total_price;
            		    
            		    $remaining_product=$result_quantity-$product_quantity;
            		    $remaining_total=number_format($total_amount1,'2','.','');
            		    $new_total=$result_total_price-$remaining_total;
            		    
            		    $sqlupdt=mysqli_query($db_handle,"UPDATE tbl_products SET quantity='".$remaining_product."',total_price='".number_format($new_total,'2','.','')."' WHERE id='".$product_id."'");
            		    $sqlupdt1=mysqli_query($db_handle,"UPDATE tbl_product_to_warehouse SET quantity='".$rack_quantity."',total_price='".$rack_total_price."' WHERE id='".$product_to_warehouse_id."'");
            		    
            		    header("location:pre_packing_list.php?msg=1");
            		 }
                  //  print_r($dataArray);
	    
	            }
	   }
?>