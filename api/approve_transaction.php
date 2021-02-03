<?php
include_once("config.php");
        $data=array();
        $i=0;		
        $transaction_type=$_POST['type'];
        $new_stock_id=$_POST['id'];
        $id=$_POST['user_id'];
        if($transaction_type==1)
        {
            $sqlsel1=mysqli_query($db_handle,"SELECT * FROM tbl_stock_transfer_warehouse WHERE id='".$new_stock_id."'");
            if(mysqli_num_rows($sqlsel1)>0)
            {
                $sqlselect=mysqli_fetch_object($sqlsel1);
                $unit_price=$sqlselect->unit_price;
                $product_id=$sqlselect->product_id;
                $combo_product_id=$sqlselect->combo_product_id;
                $product_to_warehouse=$sqlselect->product_to_warehouse_id;
                $new_warehouse=$sqlselect->to_warehouse;
                $new_rack=$sqlselect->to_rack;
                $prev_quant=$sqlselect->available_quant;
                $stock_quant=$sqlselect->stock_quant;
                
                $changed_quant=$prev_quant-$stock_quant;
                $new_total=number_format(($changed_quant*$unit_price),'2','.','');
                $status=$sqlselect->sku_condition;
                
                if($product_id!=0)
                {
                        $sqladd1=mysqli_query($db_handle,"INSERT INTO tbl_product_to_warehouse SET product_id='".$product_id."',warehouse_id='".$new_warehouse."',rack_id='".$new_rack."',unit_price='".number_format($unit_price,'2','.','')."',quantity='".$stock_quant."',total_price='".$new_total."',status='".$status."'");
                }
                
                elseif($combo_product_id!=0)
                {
                        $sqladd1=mysqli_query($db_handle,"INSERT INTO tbl_product_to_warehouse SET combo_product_id='".$combo_product_id."',warehouse_id='".$new_warehouse."',rack_id='".$new_rack."',unit_price='".number_format($unit_price,'2','.','')."',quantity='".$stock_quant."',total_price='".$new_total."',status='".$status."'");
                }
                $sqlupdate=mysqli_query($db_handle,"UPDATE tbl_product_to_warehouse SET quantity='".$changed_quant."',total_price='".$new_total."' WHERE id='".$product_to_warehouse."'");
                $sqlupadte1=mysqli_query($db_handle,"UPDATE tbl_stock_transfer_warehouse SET status='1',approval_date=NOW(),approved_by='".$id."' WHERE id='".$new_stock_id."'");
                $i++;
            }
        }
        elseif($transaction_type=='2')
        {
                $sqlsel1=mysqli_query($db_handle,"SELECT * FROM tbl_stock_transfer_wholeseller WHERE id='".$new_stock_id."'");
                if(mysqli_num_rows($sqlsel1)>0)
                {
                     $sqlselect=mysqli_fetch_object($sqlsel1);
                    // print_r($sqlselect);
                    $unit_price=$sqlselect->unit_price;
                    $product_id=$sqlselect->product_id;
                    $combo_product_id=$sqlselect->combo_product_id;
                    $product_to_warehouse=$sqlselect->product_to_warehouse_id;
                    
                    $prev_quant=$sqlselect->available_quant;
                    $stock_quant=$sqlselect->stock_quant;
                    
                    $changed_quant=$prev_quant-$stock_quant;
                    $new_total=number_format(($changed_quant*$unit_price),'2','.','');
                    if($product_id!=0)
                    {
                        $sqlselect1=mysqli_query($db_handle,"SELECT quantity,total_price FROM tbl_products WHERE id='".$product_id."'");
                        if(mysqli_num_rows($sqlselect1)>0)
                        {
                            $sqlselect2=mysqli_fetch_object($sqlselect1);
                            $total_quant=$sqlselect2->quantity;
                            $remaining_quant=$total_quant-$stock_quant;
                            $current_total_price=number_format(($remaining_quant*$unit_price),'2','.','');
                        
                            $sqlupdate2=mysqli_query($db_handle,"UPDATE tbl_products SET quantity='".$remaining_quant."',total_price='".$current_total_price."' WHERE id='".$product_id."'");
                        }
                    }
                    elseif($combo_product_id!=0)
                    {
                        $sqlselect1=mysqli_query($db_handle,"SELECT quantity,total_price FROM tbl_combo_product WHERE id='".$combo_product_id."'");
                        if(mysqli_num_rows($sqlselect1)>0)
                        {
                            $sqlselect2=mysqli_fetch_object($sqlselect1);
                            $total_quant=$sqlselect2->quantity;
                            $remaining_quant=$total_quant-$stock_quant;
                            $current_total_price=number_format(($remaining_quant*$unit_price),'2','.','');
                        
                            $sqlupdate2=mysqli_query($db_handle,"UPDATE tbl_combo_product SET quantity='".$remaining_quant."',total_price='".$current_total_price."' WHERE id='".$combo_product_id."'");
                        }
                    }
                    
                    $sqlupdate=mysqli_query($db_handle,"UPDATE tbl_product_to_warehouse SET quantity='".$changed_quant."',total_price='".$new_total."' WHERE id='".$product_to_warehouse."'");
                    $sqlupadte1=mysqli_query($db_handle,"UPDATE tbl_stock_transfer_wholeseller SET status='1',approval_date=NOW(),approved_by='".$id."' WHERE id='".$new_stock_id."'");

                }
            }
            $data=array(
                "status"=> "Successfully Approved"
                );
            print(json_encode($data));
            mysqli_close($db_handle);
?>