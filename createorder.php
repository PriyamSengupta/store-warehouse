<?php
session_start();

	if(@$_SESSION['valid_admin'] == "" )
	{
	    @header("Location:login.php");
	}

	include_once("include/inc.php");
	if(isset($_POST["add"]))
	{
	    $array=array();
	    $a=0;
	    $b=0;
	   // echo "<pre>";
	   // print_r($_POST);
	   // echo "</pre>";
	    $sku=$_POST['sku'];
        $quantity=$_POST['quantity'];
        $ws_name=$_POST['ws_name'];
        $comment=$_POST['comment'];
        $quant13=0;
        $i=0;
        $data=array();
                foreach($sku as $key=>$val)
                {
                    $val2 = $sku[$key];
                    $val3 = $quantity[$key];
                    
                    $sqlsku=mysqli_fetch_object(mysqli_query($db_handle,"SELECT id FROM tbl_sku WHERE name='".mysqli_real_escape_string($db_handle,$val2)."'"));
                    $sku_id=$sqlsku->id;
                    
                    $data[$key] = array(
                        'sku'=>$sku_id,
                        'quantity'=>$val3
                        );
                }
    //     echo "<pre>";
	   // print_r($data);
	   // echo "</pre>";
	    foreach($data as $val1)
	    {
	        $skuid1=$val1['sku'];
                $sqlss=mysqli_fetch_object(mysqli_query($db_handle,"SELECT product_id,combo_product_id FROM tbl_sku WHERE id='".$skuid1."'"));
    		    $pro_id=$sqlss->product_id;
    		    $combo_pro_id=$sqlss->combo_product_id;
    		    if($pro_id!=0)
    		    {
    		        $sqlS=mysqli_query($db_handle,"SELECT * FROM tbl_product_to_warehouse WHERE product_id='".$pro_id."' AND status='1'");
    		        if(mysqli_num_rows($sqlS)==0)
    		        {
    		            array_push($array,0);
    		        }
    		    }
    		    elseif($combo_pro_id!=0)
    		    {
    		        $sqlS=mysqli_query($db_handle,"SELECT * FROM tbl_product_to_warehouse WHERE combo_product_id='".$combo_pro_id."' AND status='1'");
    		        if(mysqli_num_rows($sqlS)==0)
    		        {
    		            array_push($array,0);
    		        }
    		    }
	    }
	    if(in_array(0, $array))
	    {
	        header("location:order_list.php?msg=7");
	       //print_r($array);
	    }
	    else
	    {
	       // print_r($array);
    	    foreach($data as $pro)
    		{
    		    $skuid = $pro['sku'];
    		  //$quantity = $product['quantity'];
    		  
    		  $sqlss=mysqli_fetch_object(mysqli_query($db_handle,"SELECT product_id,combo_product_id FROM tbl_sku WHERE id='".$skuid."'"));
    		  $pro_id=$sqlss->product_id;
    		  $combo_pro_id=$sqlss->combo_product_id;
    		  if($pro_id!=0)
    		  {
    		    $sqlsel1=mysqli_fetch_object(mysqli_query($db_handle,"SELECT quantity FROM tbl_products WHERE sku='".$skuid."'"));
    		    $actual_quantity=$sqlsel1->quantity;
    		    
    		    $sqlsel2=mysqli_query($db_handle,"SELECT od.quantity FROM tbl_order_details od LEFT JOIN tbl_order o ON od.order_id=o.id WHERE od.sku='".$skuid."' AND o.status='0'");
    		    while($sqlsel3=mysqli_fetch_object($sqlsel2))
    		    {
    		        $quant13=$quant13+$sqlsel3->quantity;
    		    }
    		    if($actual_quantity-$quant13<$pro['quantity'])
    		    {
    		      //  header("location:order_list.php?msg=5");
    		      $i++;
    		    }
    		  }
    		  elseif($combo_pro_id!=0)
    		  {
    		        $sqlsel1=mysqli_fetch_object(mysqli_query($db_handle,"SELECT quantity FROM tbl_combo_product WHERE sku='".$skuid."'"));
        		    $actual_quantity=$sqlsel1->quantity;
        		    
        		    $sqlsel2=mysqli_query($db_handle,"SELECT od.quantity FROM tbl_order_details od LEFT JOIN tbl_order o ON od.order_id=o.id WHERE od.sku='".$skuid."' AND o.status='0'");
        		    while($sqlsel3=mysqli_fetch_object($sqlsel2))
        		    {
        		        $quant13=$quant13+$sqlsel3->quantity;
        		    }
        		    if($actual_quantity-$quant13<$pro['quantity'])
        		    {
        		      //  header("location:order_list.php?msg=5");
        		      $i++;
        		    }
    		  }
    		}
    // 		echo $i;
    		if($i==0)
    	    {
    	    
        	    $sqladd=mysqli_query($db_handle,"INSERT INTO tbl_order SET ws_name='".mysqli_real_escape_string($db_handle,$ws_name)."',comment='".mysqli_real_escape_string($db_handle,$comment)."',creation_date=NOW(),created_by='".$_SESSION['id']."',status='0'");
        		$lastID=mysqli_insert_id($db_handle);
        		
        		foreach($data as $product)
        		{
        		    $order_id = $lastID;
        		    $skuid = $product['sku'];
        		    $quantity = $product['quantity'];
        		    
        		    $sqladd1=mysqli_query($db_handle,"INSERT INTO tbl_order_details SET order_id='".$order_id."',sku='".$skuid."',quantity='".$quantity."'");
        		        header("location:order_list.php?msg=1");
        		  //  }
        		}
    	    }
    	    else
    	    {
    	        header("location:order_list.php?msg=5");
    	    }
	  } 
	}
?>