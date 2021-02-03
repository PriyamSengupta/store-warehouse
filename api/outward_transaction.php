<?php
include_once("config.php");
                $data=array();
        		$type=$_POST['type'];
        // 		$id=$_POST['user_id'];
        
		if($type=='1'){
	    $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_stock_transfer_warehouse");
	    if(mysqli_num_rows($sqlQuery1)>0)
	    {
	        while($record=mysqli_fetch_object($sqlQuery1))
	        { 
	            $sqlsku=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_sku WHERE id='".$record->sku."'"));
	            $sku_name=$sqlsku->name;
	            $sqlwarehouse1=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_warehouse WHERE id='".$record->from_warehouse."'"));
	            $from_warehouse=$sqlwarehouse1->name;
	            $sqlrack=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_rack WHERE id='".$record->from_rack."'"));
	            $from_rack=$sqlrack->name;
	            $sqlwarehouse2=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_warehouse WHERE id='".$record->to_warehouse."'"));
	            $to_warehouse=$sqlwarehouse2->name;
	            $sqlrack2=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_rack WHERE id='".$record->to_rack."'"));
	            $to_rack=$sqlrack2->name;
	            $data['outward_list'][]=array(
	                'id'=>$record->id,
	                'sku'=>$sku_name,
	                'from_warehouse'=>$from_warehouse,
	                'from_rack'=>$from_rack,
	                'to_warehouse'=>$to_warehouse,
	                'to_rack'=>$to_rack,
	                'stock_quantity'=>$record->stock_quant,
	                'status'=>($record->status==0) ? 'Unapproved' : "Approved",
	                );
	        }
        }
           else
    	   {
    	       $data['outward_list']=[];
    	   }
		}
		elseif($type=='2')
		{
		    $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_stock_transfer_wholeseller");
    	    if(mysqli_num_rows($sqlQuery1)>0)
    	    {
    	        $sl=1;
    	        while($record=mysqli_fetch_object($sqlQuery1))
    	        { 
    	                $sqlsku=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_sku WHERE id='".$record->sku."'"));
        	            $sku_name=$sqlsku->name;
        	            $sqlwarehouse1=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_warehouse WHERE id='".$record->from_warehouse."'"));
        	            $from_warehouse=$sqlwarehouse1->name;
        	            $sqlrack=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_rack WHERE id='".$record->from_rack."'"));
        	            $from_rack=$sqlrack->name;
    	                
    	                $data['outward_list'][]=array(
    	                    'id'=>$record->id,
    	                    'sku'=>$sku_name,
        	                'from_warehouse'=>$from_warehouse,
        	                'from_rack'=>$from_rack,
        	                'wholeseller'=>$record->ws_name,
        	                'comment'=>$record->comment,
        	                'stock_quantity'=>$record->stock_quant,
        	                'status'=>($record->status==0) ? 'Unapproved' : "Approved",
    	                    );
    	        }
    	   }
    	   else
    	   {
    	       $data['outward_list']=[];
    	   }
		}
        print(json_encode($data));
        mysqli_close($db_handle);
        
?>