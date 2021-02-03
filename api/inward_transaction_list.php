<?php
include_once("config.php");
    
    $sqlview = mysqli_query($db_handle,"SELECT p.id,s.name,p.quantity,p.total_price FROM tbl_products p LEFT JOIN tbl_sku s ON p.sku=s.id ORDER BY p.id DESC");
						
		while($record=mysqli_fetch_object($sqlview))
		{ 
                $data[]=array(
                    'id'    =>$record->id,
                    'name'  =>$record->name,
                    'quantity'=>$record->quantity,
                    'total_price'=>$record->total_price,
                    );
        }        
        print(json_encode($data));
        mysqli_close($db_handle);
?>