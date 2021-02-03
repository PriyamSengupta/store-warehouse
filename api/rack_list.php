<?php
include_once("config.php");
    
    $sqlview = mysqli_query($db_handle,"SELECT * FROM tbl_rack ORDER BY id DESC");
						
		while($record=mysqli_fetch_object($sqlview))
		{ 
		    $warehouse_id=$record->warehouse_id;
		    $sqlwarehouse=mysqli_query($db_handle,"SELECT name FROM tbl_warehouse WHERE id='".$warehouse_id."'");
		    $sqlwarehouse1=mysqli_fetch_object($sqlwarehouse);
		    $warehouse_name=$sqlwarehouse1->name;
                $data[]=array(
                    'id'    =>$record->id,
                    'name'  =>$record->name,
                    'status'=>($record->status=='0') ? 'Disabled' : 'Enabled',
                    'warehouse'=>$warehouse_name
                    );
        }        
        print(json_encode($data));
        mysqli_close($db_handle);
        	
?>