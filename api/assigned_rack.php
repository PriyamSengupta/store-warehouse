<?php
include_once("config.php");
    
        $data=array();
        
        $product_id=$_POST['id'];
        $warehouse_id=$_POST['warehouse_id'];
        
        $sqlQuery=mysqli_query($db_handle,"SELECT r.name,ptw.rack_id,ptw.quantity,ptw.id FROM tbl_product_to_warehouse ptw LEFT JOIN tbl_rack r ON ptw.rack_id=r.id WHERE ptw.product_id='".$product_id."' AND ptw.warehouse_id='".$warehouse_id."' ORDER BY ptw.id ASC");
	
        if(mysqli_num_rows($sqlQuery)>0)
        {
            while($record=mysqli_fetch_object($sqlQuery)) 
            { 
                $data['assigned_rack'][]=array(
                    'id'        =>   $record->id,
                    'rack_name'  =>  $record->name,
                    'rack_id'    =>  $record->rack_id,
                    'quantity'   =>  $record->quantity
                );
            }
        }
        else
        {
            $data['assigned_rack']=[];
        }
        
        print(json_encode($data));
        mysqli_close($db_handle);
                   
?>