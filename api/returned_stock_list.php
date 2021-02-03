<?php
include_once("config.php");
    
    $sqlview = mysqli_query($db_handle,"SELECT rp.id,rp.status,w.name AS warehouse,s.name AS sku,rp.quantity,rp.return_from FROM tbl_returned_product rp LEFT JOIN tbl_sku s ON s.id=rp.sku LEFT JOIN tbl_warehouse w ON w.id=rp.warehouse_id ORDER BY rp.id DESC");
	$count = mysqli_num_rows($sqlview);
	if($count > 0)
	{ 
		while($record=mysqli_fetch_object($sqlview))
		{  
		    
		    $data["returned_list"][]=array(
		        "id"=>$record->id,
		        "sku"=>$record->sku,
                "warehouse"=>$record->warehouse,
                "quantity"=>$record->quantity,
                "return_from"=>$record->return_from,
                "status"=>($record->status=='0') ? 'Damaged' : 'Working'
		    );
        }
	}
	else
	{
	     $data["returned_list"]=[];
	}
    print(json_encode($data));
    mysqli_close($db_handle);
        	
?>
