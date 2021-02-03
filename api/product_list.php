<?php
include_once("config.php");
    
    $sqlview = mysqli_query($db_handle,"SELECT * FROM tbl_products ORDER BY id DESC");

	while($record=mysqli_fetch_object($sqlview))
	{
	    $warehouse_id=$record->warehouse_id;
        $sqlWh=mysqli_query($db_handle,"SELECT name FROM tbl_warehouse WHERE id='".$warehouse_id."'");
        $result=mysqli_fetch_object($sqlWh);
        
        $rack_id=$record->rack_id;
        $sqlrc=mysqli_query($db_handle,"SELECT name FROM tbl_rack WHERE id='".$rack_id."'");
        $result1=mysqli_fetch_object($sqlrc);
        
        $sku_id=$record->sku;
        $sqlsku=mysqli_query($db_handle,"SELECT name FROM tbl_sku WHERE id='".$sku_id."'");
        $result2=mysqli_fetch_object($sqlsku);
    
        $warehouse_id=$record->id;
        $sqlCount=mysqli_query($db_handle,"SELECT * FROM tbl_warehouse_to_rack WHERE warehouse_id='".$warehouse_id."'");
        $count_rack=mysqli_num_rows($sqlCount);
        $data[]=array(
            
            'id' =>$record->id,
            'name'=>$record->name,
            'warehouse'=>$result->name,
            'rack'=>$result1->name,
            'sku'=>($result2->name=='') ? 'No SKU' : $result2->name,
            'unit price'=>$record->unit_price,
            'quantity'  =>$record->quantity,
            'total price'=>$record->total_price,
            'creation date'=>date('d F Y',strtotime($record->creation_date))
            
            );
    }        
        	    print(json_encode($data));
                mysqli_close($db_handle);
        	
?>