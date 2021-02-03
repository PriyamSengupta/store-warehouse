<?php
include_once("config.php");
    
        $data=array();
        
        $sqlselect=mysqli_query($db_handle,"SELECT * FROM tbl_sku WHERE status=1 AND ( product_id=0 AND combo_product_id=0 ) ORDER BY id ASC"); 
        if(mysqli_num_rows($sqlselect)>0)
        {
            while($record=mysqli_fetch_object($sqlselect)) 
            { 
                $data['available_sku'][]=array(
                    'id'    => $record->id,
                    'name'  => $record->name
                );
            }
        }
        else
        {
            $data['available_sku']=[];
        }
        
        print(json_encode($data));
        mysqli_close($db_handle);
                   
?>