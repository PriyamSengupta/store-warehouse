<?php 

	session_start();

	if($_SESSION['valid_admin'] == "" )
	{
    	echo ("<script>
         window.location.href='login.php?act=session_expired';
       </script>");
	}

	include_once("include/inc.php");

	

	if(isset($_POST["add"]))
	{
	    $date = date('Y-m-d H:i:s');
	   // echo "<pre>";
	   // print_r($_POST);
	   // echo "</pre>";
	    $sku=$_REQUEST['sku'];
	   // $name=$_REQUEST['name'];
	    $warehouse=$_REQUEST['warehouse_id'];
	    $rack=$_REQUEST['rack_id'];
	    $quantity=$_REQUEST['quantity'];
	    $unit_price=$_REQUEST['unit_price'];
	    $return_from=$_REQUEST['return_from'];
	    $reason=$_REQUEST['return_for'];
	    $condition=$_REQUEST['condition'];
	    
	    if($condition=="1")
	    {
    	    $sqlquery=mysqli_query($db_handle,"SELECT id,product_id,combo_product_id FROM tbl_sku WHERE name='".mysqli_real_escape_string($db_handle,$sku)."'");
    	    $sqlquery1=mysqli_fetch_object($sqlquery);
    	    $sku_id=$sqlquery1->id;
    	    //echo $sku_id;
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
                $sql_pro_updt= mysqli_query($db_handle,"UPDATE tbl_products SET quantity='".$new_quantity."',total_price='".$total_price."',modification_date='".$date."',modified_by='".$_SESSION['id']."' WHERE id='".$pro_id."'");
                
                $sqlcheck=mysqli_query($db_handle,"SELECT * FROM tbl_product_to_warehouse WHERE product_id='".$pro_id."' AND rack_id='".$rack."' AND status='1' AND unit_price='".number_format($unit_price,'2','.','')."'");
                $sqlcount=mysqli_num_rows($sqlcheck);
                //echo $sqlcount;
                if($sqlcount>0)
                {
                                $sqlrow=mysqli_fetch_object($sqlcheck);
                    
                                $new_quant=$quantity+$sqlrow->quantity;
                                $ptw_id=$sqlrow->id;
                                $total_amount1=$sqlrow->total_price;
                                $new_total=$sqlrow->unit_price*$new_quant;
                                $new_total=number_format($new_total,'2','.','');
                                
                                $sqlupdt=mysqli_query($db_handle,"UPDATE tbl_product_to_warehouse SET quantity='".$new_quant."',total_price='".$new_total."' WHERE id='".$ptw_id."'");
                }
                else
                {
                                $unit1=number_format($unit_price,'2','.','');
                                // $total1=number_format(($unit1*$quantity),'2','.','');
                                
                                $sqladd=mysqli_query($db_handle,"INSERT INTO tbl_product_to_warehouse SET product_id='".$pro_id."',warehouse_id='".$warehouse."',rack_id='".$rack."',unit_price='".$unit1."',quantity='".$quantity."',total_price='".$added_price."',status='1',creation_date='".$date."'");
                }
                        
                
                
            }
            if($combo_pro_id!=0)
            {
                // echo "test";
                $sqlpro=mysqli_query($db_handle,"SELECT quantity,total_price FROM tbl_combo_product WHERE id='".$combo_pro_id."'");
                $sqlpro1=mysqli_fetch_object($sqlpro);
                // $wh_id=$sqlpro1->warehouse_id;
                $current_quantity=$sqlpro1->quantity;
                $total_price1=$sqlpro1->total_price;
                // echo $current_quantity."<br>".$total_price1;
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
                
                    /*$dataArray[]=array(
                        'new_quant'=>$new_combo_quant,
                        'new_total'=>$new_combo_total
                        );*/
                }
                /*echo "<pre>";
                print_r($dataArray);
                echo "</pre>";*/
                
                $new_quantity=$current_quantity+$quantity;
                $added_price=number_format(($quantity*$unit_price),'2','.','');
                $total_price=number_format(($total_price1+$added_price),'2','.','');
                // $total_price=number_format(($price*$new_quantity),'2','.','');
                $sql_pro_updt= mysqli_query($db_handle,"UPDATE tbl_combo_product SET quantity='".$new_quantity."',total_price='".$total_price."',modification_date='".$date."',modified_by='".$_SESSION['id']."' WHERE id='".$combo_pro_id."'");
                
                $sqlcheck=mysqli_query($db_handle,"SELECT * FROM tbl_product_to_warehouse WHERE combo_product_id='".$combo_pro_id."' AND rack_id='".$rack."' AND status='1'");
                $sqlcount=mysqli_num_rows($sqlcheck);
                //echo $sqlcount;
                if($sqlcount>0)
                {
                    $sqlrow=mysqli_fetch_object($sqlcheck);
                    // $status=$sqlrow->status;
                    // if($status==1){
                        $prev_quantity=$sqlrow->quantity;
                        $ptw_id=$sqlrow->id;
                        $total_amount1=$sqlrow->total_price;
                        $total_amount=number_format(($total_amount1+$added_price),'2','.','');
                        $new_quant=$prev_quantity+$quantity;
                        $new_total_price=number_format(($price*$new_quant),'2','.','');
                        $sqlupdt=mysqli_query($db_handle,"UPDATE tbl_product_to_warehouse SET quantity='".$new_quant."',total_price='".$total_amount."' WHERE id='".$ptw_id."'");                    
                    // } 
                    // else
                    // {
                    //     header("location:returned_stock_list.php?msg=5"); 
                    // }
                }
                else
                {
                    $sqlinsert=mysqli_query($db_handle,"INSERT INTO tbl_product_to_warehouse SET product_id='0',combo_product_id='".$combo_pro_id."',warehouse_id='".$warehouse."',rack_id='".$rack."',unit_price='".number_format($unit_price,'2','.','')."',quantity='".$quantity."',total_price='".$added_price."',creation_date='".$date."',status='1'");
                }
                
            }
            $sqlinsrt=mysqli_query($db_handle,"INSERT INTO tbl_returned_product SET sku='".$sku_id."',warehouse_id='".$warehouse."',rack_id='".$rack."',quantity='".$quantity."',unit_price='".number_format($unit_price,'2','.','')."',total_price='".$added_price."',return_from='".mysqli_real_escape_string($db_handle,$return_from)."',reason_for_return='".mysqli_real_escape_string($db_handle,$reason)."',status='".$condition."',creation_date='".$date."'");
            header("location:returned_stock_list.php?msg=1");  
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
                $sql_pro_updt= mysqli_query($db_handle,"UPDATE tbl_products SET quantity='".$new_quantity."',total_price='".$total_price."',modification_date='".$date."',modified_by='".$_SESSION['id']."' WHERE id='".$pro_id."'");
            
                $sqlcheck=mysqli_query($db_handle,"SELECT * FROM tbl_product_to_warehouse WHERE product_id='".$pro_id."' AND rack_id='".$rack."' AND status='0'");
                $sqlcount=mysqli_num_rows($sqlcheck);
                //echo $sqlcount;
                if($sqlcount>0)
                {
                            $sqlrow=mysqli_fetch_object($sqlcheck);
                            if((number_format($unit_price,'2','.',''))==$sqlrow->unit_price)
                            {
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
                                $unit1=number_format($unit_price,'2','.','');
                                // $total1=number_format(($unit1*$quantity),'2','.','');
                                
                                $sqladd=mysqli_query($db_handle,"INSERT INTO tbl_product_to_warehouse SET product_id='".$pro_id."',warehouse_id='".$warehouse."',rack_id='".$rack."',unit_price='".$unit1."',quantity='".$quantity."',total_price='".$added_price."',status='0',creation_date='".$date."'");
                            }
                    
                }
                else
                {
                    $sqlinsert=mysqli_query($db_handle,"INSERT INTO tbl_product_to_warehouse SET product_id='".$pro_id."',combo_product_id='0',warehouse_id='".$warehouse."',rack_id='".$rack."',unit_price='".number_format($unit_price,'2','.','')."',quantity='".$quantity."',total_price='".$added_price."',status='0',creation_date='".$date."'");
                }
                
            }
            if($combo_pro_id!=0)
            {
                $sqlpro=mysqli_query($db_handle,"SELECT quantity,total_price FROM tbl_combo_product WHERE id='".$combo_pro_id."'");
                $sqlpro1=mysqli_fetch_object($sqlpro);
                // $wh_id=$sqlpro1->warehouse_id;
                $current_quantity=$sqlpro1->quantity;
                $total_price1=$sqlpro1->total_price;
                
                $sql_combo_details=mysqli_query($db_handle,"SELECT * FROM tbl_combo_product_details WHERE combo_product_id='".$combo_pro_id."'");
                while($sql_combo=mysqli_fetch_object($sql_combo_details))
                {
                    $combo_detail_quantity=$sql_combo->quantity;
                    $combo_detail_unit=$sql_combo->unit_price;
                    $com_detail_product_id=$sql_combo->product_id;
                    $qty_per_combo=$sql_combo->qty_per_combo;
                    $combo_detail_id=$sql_combo->id;
                    
                    $new_combo_quant1=$qty_per_combo*$quantity;
                    
                    $new_combo_quant=$new_combo_quant1+$combo_detail_quantity;
                    $new_combo_total1=number_format(($new_combo_quant*$combo_detail_unit),'2','.','');
                    // $new_combo_total=number_format(($new_combo_total1+$sql_combo->total_price),'2','.','');
                    $sql_updt_combo_details=mysqli_query($db_handle,"UPDATE tbl_combo_product_details SET quantity='".$new_combo_quant."',total_price='".$new_combo_total1."' WHERE id='".$combo_detail_id."'");
                }
                
                
                $new_quantity=$current_quantity+$quantity;
                $added_price=number_format(($quantity*$unit_price),'2','.','');
                $total_price=number_format(($total_price1+$added_price),'2','.','');
                // $total_price=number_format(($price*$new_quantity),'2','.','');
                $sql_pro_updt= mysqli_query($db_handle,"UPDATE tbl_combo_product SET quantity='".$new_quantity."',total_price='".$total_price."',modification_date='".$date."',modified_by='".$_SESSION['id']."' WHERE id='".$combo_pro_id."'");
                
                $sqlcheck=mysqli_query($db_handle,"SELECT * FROM tbl_product_to_warehouse WHERE combo_product_id='".$combo_pro_id."' AND rack_id='".$rack."' AND status='0'");
                $sqlcount=mysqli_num_rows($sqlcheck);
                //echo $sqlcount;
                if($sqlcount>0)
                {
                    $sqlrow=mysqli_fetch_object($sqlcheck);
                    
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
                    $sqlinsert=mysqli_query($db_handle,"INSERT INTO tbl_product_to_warehouse SET product_id='0',combo_product_id='".$combo_pro_id."',warehouse_id='".$warehouse."',rack_id='".$rack."',unit_price='".number_format($unit_price,'2','.','')."',quantity='".$quantity."',total_price='".$added_price."',status='0',creation_date='".$date."'");
                }
                
            }
            $sqlinsrt=mysqli_query($db_handle,"INSERT INTO tbl_returned_product SET sku='".$sku_id."',warehouse_id='".$warehouse."',rack_id='".$rack."',quantity='".$quantity."',unit_price='".number_format($unit_price,'2','.','')."',total_price='".$added_price."',return_from='".mysqli_real_escape_string($db_handle,$return_from)."',reason_for_return='".mysqli_real_escape_string($db_handle,$reason)."',status='".$condition."',creation_date='".$date."'"); 
	       // $sqladd=mysqli_query($db_handle,"INSERT INTO tbl_damaged_product SET name='".mysqli_real_escape_string($db_handle,$name)."',sku='".mysqli_real_escape_string($db_handle,$sku_id)."',warehouse_id='".mysqli_real_escape_string($db_handle,$warehouse)."',rack_id='".mysqli_real_escape_string($db_handle,$rack)."',quantity='".mysqli_real_escape_string($db_handle,$quantity)."',return_from='".mysqli_real_escape_string($db_handle,$return_from)."',reason_for_return='".mysqli_real_escape_string($db_handle,$reason)."'");
	    
	        header("location:returned_stock_list.php?msg=1");
	    }
	    
	}
?>