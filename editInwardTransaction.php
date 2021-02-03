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
	    $sku_id=$_POST['sku_id'];
	    $warehouse=$_POST['warehouse_id'];
        $rack=$_POST['rack_id'];
        $unit=$_POST['unit_price'];
        $quantity=$_POST['quantity'];
        $total=$_POST['total_price'];
        $status=$_POST['status'];
        $product_id=$_POST['pro_id1'];
        // $combo_quantity=$_POST['quant'];
        $total_price=0;
        $total_quantity=0;
        $i=0;
        $data=array();
                foreach($warehouse as $key=>$val)
                {
                    $val2 = $unit[$key];
                    $val3 = $quantity[$key];
                    $val4 = $total[$key];
                    $val5 = $rack[$key];
                    $val6 = $status[$key];
                    $total_price=$total_price+$val4;
                    $total_quantity=$total_quantity+$val3;
                    $data[$key] = array(
                        'warehouse_id'=>$val,
                        'rack_id'=>$val5,
                        'unit_price'=>$val2,
                        'quantity'=>$val3,
                        'total_price'=>$val4,
                        'status'=>$val6
                        );
                }
    //     echo "<pre>";
	   // print_r($data);
	   // echo "</pre>";
	    
	   // echo $total_quantity."<br>".$total_price."<br>".$sku;
	    $total_price=number_format($total_price,'2','.','');
	    $sqlproduct=mysqli_fetch_object(mysqli_query($db_handle,"SELECT quantity,total_price FROM tbl_products WHERE id='".$product_id."'"));
	    $prev_amount=$sqlproduct->total_price;
	    $prev_quant=$sqlproduct->quantity;
	    $new_amount=number_format(($total_price+$prev_amount),'2','.','');
	    $new_quant=$prev_quant+$total_quantity;
	    $sqladd1=mysqli_query($db_handle,"UPDATE tbl_products SET total_price='".$new_amount."',quantity='".$new_quant."' WHERE id='".$product_id."'");
		$total1=0;
		$quantity1=0;
		foreach($data as $product)
		{
		  //  $product_id = $lastID;
		    $warehouse = $product['warehouse_id'];
		    $rack= $product['rack_id'];
		    $quantity = $product['quantity'];
		    $unit = number_format($product['unit_price'],'2','.','');
		    $total = $product['total_price'];
		    $total1=$total1+$total;
		    $quantity1=$quantity1+$quantity;
		    $stat = $product['status'];
		    
		    $sqlS=mysqli_query($db_handle,"SELECT * FROM tbl_product_to_warehouse WHERE product_id='".$product_id."' AND warehouse_id='".$warehouse."' AND rack_id='".$rack."' AND unit_price='".$unit."' AND status='".$stat."'");
            if(mysqli_num_rows($sqlS)>0)
            {
                $sqlS1=mysqli_fetch_object($sqlS);
                $new_quant=$sqlS1->quantity+$quantity;
                $new_total=$new_quant*$sqlS1->unit_price;
                $new_total=number_format($new_total,'2','.','');
                $ptw_id=$sqlS1->id;
                $sqlupdate=mysqli_query($db_handle,"UPDATE tbl_product_to_warehouse SET quantity='".$new_quant."',total_price='".$new_total."' WHERE id='".$ptw_id."'");
                $sqladd2=mysqli_query($db_handle,"INSERT INTO tbl_stock_in SET sku='".$sku_id."',ptw_id='".$ptw_id."',type='1',warehouse_id='".$warehouse."',rack_id='".$rack."',unit_price='".$unit."',quantity='".$quantity."',total_price='".$total."',status='".$stat."',creation_date='".$date."'");
            }
            else
            {

		        $sqladd=mysqli_query($db_handle,"INSERT INTO tbl_product_to_warehouse SET product_id='".$product_id."',warehouse_id='".$warehouse."',rack_id='".$rack."',unit_price='".$unit."',quantity='".$quantity."',total_price='".$total."',status='".$stat."',creation_date='".$date."'");
		        $lastID=mysqli_insert_id($db_handle);
		        $sqladd2=mysqli_query($db_handle,"INSERT INTO tbl_stock_in SET sku='".$sku_id."',ptw_id='".$lastID."',type='1',warehouse_id='".$warehouse."',rack_id='".$rack."',unit_price='".$unit."',quantity='".$quantity."',total_price='".$total."',status='".$stat."',creation_date='".$date."'");
		
            }    
        }
		$sqlC=mysqli_fetch_object(mysqli_query($db_handle,"SELECT quantity,total_price FROM tbl_goods_inward WHERE sku='".$sku_id."'"));
		$new_quantity1=$sqlC->quantity+$quantity1;
		$new_total1=$total1+$sqlC->total_price;
		$sqladd3=mysqli_query($db_handle,"UPDATE tbl_goods_inward SET quantity='".$new_quantity1."',total_price='".number_format($new_total1,'2','.','')."',creation_date='".$date."' WHERE sku='".$sku_id."'");
        header('Location:edit_transaction.php?id='.$product_id.'&msg=1');
		        
		
		
	}
?>