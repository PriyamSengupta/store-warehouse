<?php
include_once("config.php");
    
        $data=array();
        
        $sku_id=$_POST['sku_id'];
        
        
        $sqlselect=mysqli_query($db_handle,"SELECT ptw.warehouse_id,ptw.product_id,w.name FROM tbl_product_to_warehouse ptw LEFT JOIN tbl_products p ON ptw.product_id=p.id LEFT JOIN tbl_warehouse w ON w.id=ptw.warehouse_id WHERE p.sku='".$sku_id."' GROUP BY ptw.warehouse_id ORDER BY ptw.id ASC"); 
        if(mysqli_num_rows($sqlselect)>0)
        {
            while($record=mysqli_fetch_object($sqlselect)) 
            { 
                $data['assigned_warehouse'][]=array(
                    'pro_id'    => $record->product_id,
                    'warehouse_name'  => $record->name,
                    'warehouse_id'  =>  $record->warehouse_id
                );
            }
        }
        else
        {
            $data['assigned_warehouse']=[];
        }
        
        print(json_encode($data));
        mysqli_close($db_handle);
                   
?>