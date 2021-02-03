<?php
include_once("config.php");
        $data=array();
        
        $to_warehouse=$_POST['to_warehouse'];
        $to_rack=$_POST['to_rack'];
        $comment=$_POST['comment'];
        $ws_name=$_POST['ws_name'];
        $type=$_POST['type'];
        $condition=$_POST['status'];
        $ptw_id=$_POST['id'];
        $quantity=$_POST['quantity'];
        $sku=$_POST['sku'];
        $user_id=$_POST['user_id'];
        $sqlsel1=mysqli_fetch_object(mysqli_query($db_handle,"SELECT * FROM tbl_product_to_warehouse WHERE id='".$ptw_id."'"));
        
        $product_id=$sqlsel1->product_id;
        $combo_product_id=$sqlsel1->combo_product_id;
        $from_warehouse=$sqlsel1->warehouse_id;
        $from_rack=$sqlsel1->rack_id;
        $actual_quantity=$sqlsel1->quantity;
        $unit_price=$sqlsel1->unit_price;
        
        if($type=='1')
        {
        
                if($from_warehouse==$to_warehouse && $from_rack==$to_rack)
                {
                    $data['status']="you have to choose different rack/warehouse";
                }
                else
                {
                    if($product_id!=0){
            		    $sqladd=mysqli_query($db_handle,"INSERT INTO tbl_stock_transfer_warehouse SET product_id='".$product_id."',product_to_warehouse_id='".$ptw_id."',sku='".$sku."',from_warehouse='".$from_warehouse."',from_rack='".$from_rack."',to_warehouse='".$to_warehouse."',to_rack='".$to_rack."',stock_quant='".$quantity."',available_quant='".$actual_quantity."',sku_condition='".$condition."',unit_price='".number_format($unit_price,'2','.','')."',approval_date='',requested_by='".$user_id."',creation_date=NOW(),created_by='".$user_id."'");
                        if($sqladd==true)
                        {
                            $data['status']="Transaction is added successfully";
                        }
                    }
                    elseif($combo_product_id!=0)
                    {
                        $sqladd=mysqli_query($db_handle,"INSERT INTO tbl_stock_transfer_warehouse SET combo_product_id='".$combo_product_id."',product_to_warehouse_id='".$ptw_id."',sku='".$sku."',from_warehouse='".$from_warehouse."',from_rack='".$from_rack."',to_warehouse='".$to_warehouse."',to_rack='".$to_rack."',stock_quant='".$quantity."',available_quant='".$actual_quantity."',sku_condition='".$condition."',unit_price='".number_format($unit_price,'2','.','')."',approval_date='',requested_by='".$user_id."',creation_date=NOW(),created_by='".$user_id."'");
                        if($sqladd==true)
                        {
                            $data['status']="Transaction is added successfully";
                        }
                        
                    }
                }
        }
        elseif($type=='2')
        {
            $total_price=$unit_price*$quantity;
            $total_price=number_format($total_price,'2','.','');
            
            if($product_id!=0){
            $sqladd=mysqli_query($db_handle,"INSERT INTO tbl_stock_transfer_wholeseller SET product_id='".$product_id."',product_to_warehouse_id='".$ptw_id."',sku='".$sku."',from_warehouse='".$from_warehouse."',from_rack='".$from_rack."',ws_name='".$ws_name."',comment='".$comment."',stock_quant='".$quantity."',available_quant='".$actual_quantity."',unit_price='".number_format($unit_price,'2','.','')."',total_price='".$total_price."',approval_date='',requested_by='".$user_id."',creation_date=NOW(),created_by='".$user_id."'");
                    
                    if($sqladd==true)
                        {
                            $data['status']="Transaction is added successfully";
                        }
                
            }
            elseif($combo_product_id!=0)
            {
                $sqladd=mysqli_query($db_handle,"INSERT INTO tbl_stock_transfer_wholeseller SET combo_product_id='".$combo_product_id."',product_to_warehouse_id='".$ptw_id."',sku='".$sku."',from_warehouse='".$from_warehouse."',from_rack='".$from_rack."',ws_name='".$ws_name."',comment='".$comment."',stock_quant='".$quantity."',available_quant='".$actual_quantity."',unit_price='".number_format($unit_price,'2','.','')."',total_price='".$total_price."',approval_date='',requested_by='".$user_id."',creation_date=NOW(),created_by='".$user_id."'");
            
                    if($sqladd==true)
                    {
                            $data['status']="Transaction is added successfully";
                    }
            }
        }
        print(json_encode($data));
        mysqli_close($db_handle);
?>