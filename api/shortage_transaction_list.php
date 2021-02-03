<?php
include_once("config.php");

        $sqlshortage_query = mysqli_query($db_handle,"SELECT st.ptw_id AS product_to_warehouse_id,st.id AS id,w.name AS warehouse,r.name AS rack,s.name AS sku,st.reason,st.quantity FROM tbl_shortage_transaction st LEFT JOIN tbl_warehouse w ON w.id=st.from_warehouse LEFT JOIN tbl_rack r ON r.id=st.from_rack LEFT JOIN tbl_sku s ON s.id=st.sku WHERE st.status='1' ORDER BY id DESC");
		$count = mysqli_num_rows($sqlview);
		if($count > 0)
		{ 
		    while($record=mysqli_fetch_object($sqlshortage_query))
			{
			    $data[]=array(
                    'id'    =>$record->id,
                    'sku'   =>$record->sku,
                    'rack'  =>$record->rack,
                    'warehouse'=>$record->warehouse,
                    'quantity'=>$record->quantity
                    );
            }        
		}
		print(json_encode($data));
        mysqli_close($db_handle);

?>