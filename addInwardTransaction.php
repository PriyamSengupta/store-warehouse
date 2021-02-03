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
	    $warehouse=$_POST['warehouse_id'];
        $rack=$_POST['rack_id'];
        $unit=$_POST['unit_price'];
        $quantity=$_POST['quantity'];
        $total=$_POST['total_price'];
        $status=$_POST['status'];
        // $combo_quantity=$_POST['quant'];
        $total_price=0;
        $total_quantity=0;
        $i=0;
        $data=array();
                foreach($warehouse as $key=>$val)
                {
                    //$val2 = $unit;
                    $val3 = $quantity[$key];
                    $val4 = $total[$key];
                    $val5 = $rack[$key];
                    $val6 = $status[$key];
                    $total_price=$total_price+$val4;
                    $total_quantity=$total_quantity+$val3;
                    $data[$key] = array(
                        'warehouse_id'=>$val,
                        'rack_id'=>$val5,
                        'unit_price'=>$unit,
                        'quantity'=>$val3,
                        'total_price'=>$val4,
                        'status'=>$val6
                        );
                }
        //  echo "<pre>";
	   // print_r($data);
	   // echo "</pre>";
	    
	   // echo $total_quantity."<br>".$total_price."<br>".$sku;
	    $total_price=number_format((round($total_price)),'2','.','');
	    $sqladd=mysqli_query($db_handle,"INSERT INTO tbl_products SET name='',barcode_no='',sku='".$sku."',colour_id='',unit_price='".number_format($unit,'2','.','')."',quantity='".$total_quantity."',total_price='".$total_price."',creation_date='".$date."',created_by='".$_SESSION['id']."',modification_date='".$date."',modified_by='".$_SESSION['id']."'");
		$lastID=mysqli_insert_id($db_handle);
		$rand_code = $lastID;
		$bar_code=str_pad($rand_code,10,"0",STR_PAD_LEFT);	 
		$barcode_upd=mysqli_query($db_handle,"UPDATE tbl_products SET barcode_no='".$bar_code."' where id='".$lastID."'");
		$skuupd=mysqli_query($db_handle,"UPDATE tbl_sku SET product_id='".$lastID."' WHERE id='".$sku."'");
		$sku_SS=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_sku WHERE id='".$sku."'"));
		$sku_name=$sku_SS->name;
		$sql_inward=mysqli_query($db_handle,"INSERT INTO tbl_goods_inward SET sku='".$sku."',sku_name='".$sku_name."',quantity='".$total_quantity."',total_price='".$total_price."',creation_date='".$date."'");
		
		foreach($data as $product)
		{
		    $product_id = $lastID;
		    $warehouse = $product['warehouse_id'];
		    $rack= $product['rack_id'];
		    $quantity = $product['quantity'];
		    $unit_price1 = number_format($product['unit_price'],'2','.','');
		    $total = number_format($product['total_price'],'2','.','');
		    $stat = $product['status'];
		    $sqlCheck=mysqli_query($db_handle,"SELECT * FROM tbl_product_to_warehouse WHERE product_id='".$product_id."'AND warehouse_id='".$warehouse."' AND rack_id='".$rack."' AND status='".$stat."'");
		    
		    if(mysqli_num_rows($sqlCheck)>0)
		    {
		        $sqlRes=mysqli_fetch_object($sqlCheck);
		        $new_quant  =  $sqlRes->quantity+$quantity;
		        $new_total  =  $new_quant*$sqlRes->unit_price;
		        $new_total  =  number_format($new_total,'2','.','');
		        $ptw_id=$sqlRes->id;
                $sqlupdate=mysqli_query($db_handle,"UPDATE tbl_product_to_warehouse SET quantity='".$new_quant."',total_price='".$new_total."' WHERE id='".$ptw_id."'");
		        $sqladd2=mysqli_query($db_handle,"INSERT INTO tbl_stock_in SET ptw_id='".$ptw_id."',sku='".$sku."',warehouse_id='".$warehouse."',rack_id='".$rack."',unit_price='".$unit_price1."',quantity='".$quantity."',total_price='".$total."',status='".$stat."',type='1',creation_date='".$date."'");
		        
		    }
		    else
		    {
		        $sqladd1=mysqli_query($db_handle,"INSERT INTO tbl_product_to_warehouse SET product_id='".$product_id."',warehouse_id='".$warehouse."',rack_id='".$rack."',unit_price='".$unit_price1."',quantity='".$quantity."',total_price='".$total."',status='".$stat."',creation_date='".$date."'");
		        $last_id=mysqli_insert_id($db_handle);
		        $sqladd2=mysqli_query($db_handle,"INSERT INTO tbl_stock_in SET ptw_id='".$last_id."',sku='".$sku."',warehouse_id='".$warehouse."',rack_id='".$rack."',unit_price='".$unit_price1."',quantity='".$quantity."',total_price='".$total."',status='".$stat."',type='1',creation_date='".$date."'");
		      //  header("location:inward_transaction_list.php?msg=1");
		        
		    }
		    header("location:inward_transaction_list.php?msg=1");
		}
		
	}
?>