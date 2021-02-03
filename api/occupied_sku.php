<?php
include_once("config.php");
        $data=array();
        $sqlselect=mysqli_query($db_handle,"SELECT * FROM tbl_sku WHERE status=1 AND ( product_id!=0 OR combo_product_id!=0 ) ORDER BY id ASC"); 
        while($record=mysqli_fetch_object($sqlselect)) 
        { 
            $data['sku_list'][]=array(
                'id'=>$record->id,
                'name'=>$record->name
                ); 
        }
        print(json_encode($data));
        mysqli_close($db_handle);
?>  
