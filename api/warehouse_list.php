<?php
include_once("config.php");
    
    $sqlview = mysqli_query($db_handle,"SELECT * FROM tbl_warehouse ORDER BY id DESC");
    while($record=mysqli_fetch_object($sqlview))
    { 
        $warehouse_id=$record->id;
        $sqlCount=mysqli_query($db_handle,"SELECT * FROM tbl_rack WHERE warehouse_id='".$warehouse_id."'");
        $count_rack=mysqli_num_rows($sqlCount);
        $data[]=array(
            
            'id'=>$record->id,
            'name'=>$record->name,
            'description'=>$record->description,
            'number of racks'=>$count_rack,
            'creation date'=>date('d F Y',strtotime($record->creation_date)),
            'status'=>($result->status=='0') ? 'Disabled' : 'Enabled',
            
            );
    }        
        	    print(json_encode($data));
                mysqli_close($db_handle);
        	
?>