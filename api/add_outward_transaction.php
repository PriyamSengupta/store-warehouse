<?php
include_once("config.php");
        $data=array();
        $type=$_POST['type'];
        $sku=$_POST['sku'];
        if($type=='1')
        {
        	$sqlQuery1=mysqli_query($db_handle,"SELECT product_id,name,combo_product_id FROM tbl_sku WHERE id='".$sku."'");
        	$count=mysqli_num_rows($sqlQuery1);
        	$sqlQuery=mysqli_fetch_object($sqlQuery1);
        	if($sqlQuery->product_id!=0)
        	{
        	    $pro_id=$sqlQuery->product_id;
        	    $sqlpro=mysqli_query($db_handle,"SELECT ptw.quantity,w.name AS warehouse_name,r.name AS rack_name,ptw.unit_price,ptw.id,ptw.product_id FROM tbl_product_to_warehouse ptw LEFT JOIN tbl_warehouse w ON ptw.warehouse_id=w.id LEFT JOIN tbl_rack r ON ptw.rack_id=r.id WHERE ptw.product_id='".$pro_id."'");
        	    if(mysqli_num_rows($sqlpro)>0)
        	    {
        	        while($record=mysqli_fetch_object($sqlpro))
        	        { 
        	            
        	            $data['add_outward'][]=array(
        	                'id'=>$record->id,    
        	                'warehouse'=>$record->warehouse_name,
        	                'rack'=>$record->rack_name,
        	                'unit_price'=>$record->unit_price,
        	                'quantity'=>$record->quantity
        	                );
        	        }

        	     }
        	}
        	elseif($sqlQuery->combo_product_id!=0)
        	{
        	    $combo_pro_id=$sqlQuery->combo_product_id;
        	    $sqlpro=mysqli_query($db_handle,"SELECT ptw.quantity,w.name AS warehouse_name,r.name AS rack_name,ptw.unit_price,ptw.id,ptw.product_id FROM tbl_product_to_warehouse ptw LEFT JOIN tbl_warehouse w ON ptw.warehouse_id=w.id LEFT JOIN tbl_rack r ON ptw.rack_id=r.id WHERE ptw.combo_product_id='".$combo_pro_id."'");
        	    if(mysqli_num_rows($sqlpro)>0)
        	    {
        	        while($record=mysqli_fetch_object($sqlpro))
        	        { 
        	            
        	            $data['add_outward'][]=array(
        	                'id'=>$record->id,    
        	                'warehouse'=>$record->warehouse_name,
        	                'rack'=>$record->rack_name,
        	                'unit_price'=>$record->unit_price,
        	                'quantity'=>$record->quantity
        	                );
        	        }

        	     }
        	}
        	
        }
        if($type=='2')
        {
        	$sqlQuery1=mysqli_query($db_handle,"SELECT product_id,name,combo_product_id FROM tbl_sku WHERE id='".$sku."'");
        	$count=mysqli_num_rows($sqlQuery1);
        	$sqlQuery=mysqli_fetch_object($sqlQuery1);
        	if($sqlQuery->product_id!=0)
        	{
        	    $pro_id=$sqlQuery->product_id;
        	    $sqlpro=mysqli_query($db_handle,"SELECT ptw.quantity,w.name AS warehouse_name,r.name AS rack_name,ptw.unit_price,ptw.id,ptw.product_id FROM tbl_product_to_warehouse ptw LEFT JOIN tbl_warehouse w ON ptw.warehouse_id=w.id LEFT JOIN tbl_rack r ON ptw.rack_id=r.id WHERE ptw.product_id='".$pro_id."' AND ptw.status='1'");
        	    if(mysqli_num_rows($sqlpro)>0)
        	    {
        	        while($record=mysqli_fetch_object($sqlpro))
        	        { 
        	            $data['add_outward'][]=array(
        	                'id'=>$record->id,    
        	                'warehouse'=>$record->warehouse_name,
        	                'rack'=>$record->rack_name,
        	                'unit_price'=>$record->unit_price,
        	                'quantity'=>$record->quantity
        	                );
        	        }
        	    }
        	}
        	else if($sqlQuery->combo_product_id!=0)
        	{
        	    $combo_pro_id=$sqlQuery->combo_product_id;
        	    $sqlpro=mysqli_query($db_handle,"SELECT ptw.quantity,w.name AS warehouse_name,r.name AS rack_name,ptw.unit_price,ptw.id,ptw.product_id FROM tbl_product_to_warehouse ptw LEFT JOIN tbl_warehouse w ON ptw.warehouse_id=w.id LEFT JOIN tbl_rack r ON ptw.rack_id=r.id WHERE ptw.combo_product_id='".$combo_pro_id."' AND ptw.status='1'");
        	    if(mysqli_num_rows($sqlpro)>0)
        	    {
        	        while($record=mysqli_fetch_object($sqlpro))
        	        { 
        	            $data['add_outward'][]=array(
        	                'id'=>$record->id,    
        	                'warehouse'=>$record->warehouse_name,
        	                'rack'=>$record->rack_name,
        	                'unit_price'=>$record->unit_price,
        	                'quantity'=>$record->quantity
        	                );
        	        }
        	    }
        	}
         }
        print(json_encode($data));
        mysqli_close($db_handle);
?>