<?php
include_once("config.php");

        $id=$_POST['id'];
		$sqlview = mysqli_query($db_handle,"SELECT SUM(ptw.quantity) AS total_quant,SUM(ptw.total_price) AS total_amount,p.id,p.unit_price,ptw.warehouse_id,ptw.quantity FROM tbl_products p LEFT JOIN tbl_product_to_warehouse ptw ON p.id=ptw.product_id WHERE p.id='".$id."' GROUP BY ptw.warehouse_id");

		while($record=mysqli_fetch_object($sqlview))
        {    
            $warehouse=$record->warehouse_id;
            $sqlWh=mysqli_query($db_handle,"SELECT name FROM tbl_warehouse WHERE id='".$warehouse."'");
            $result=mysqli_fetch_object($sqlWh);
            $warehouse_name=$result->name;
            
            
            $data[]=array(
                'id'=> $record->warehouse_id,
                'warehouse'=> $warehouse_name,
                'quantity'=> $record->total_quant,
                'total_price'=>number_format($record->total_amount,'2','.','')
            );          
                                
        }        
        print(json_encode($data));
        mysqli_close($db_handle);
        	
?>