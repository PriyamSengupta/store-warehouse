<?php
include_once("config.php");
        $data=array();
        $sqlselect=mysqli_query($db_handle,"SELECT s.id,s.name,p.unit_price FROM tbl_sku s LEFT JOIN tbl_products p ON s.id=p.sku WHERE s.status=1 AND s.product_id!=0 ORDER BY s.id ASC"); 
        while($record=mysqli_fetch_object($sqlselect)) 
        { 
            $data['sku_list'][]=array(
                'id'=>$record->id,
                'name'=>$record->name,
                'unit_price'=>$record->unit_price
                ); 
        }
        print(json_encode($data));
        mysqli_close($db_handle);
?>  