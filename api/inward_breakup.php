<?php
include_once("config.php");

        $warehouse_id=$_POST['warehouse_id'];
        $product_id=$_POST['product_id'];
		
		$sql = mysqli_query($db_handle,"SELECT * FROM tbl_product_to_warehouse WHERE product_id='".$product_id."' AND warehouse_id='".$warehouse_id."'");
        
        if(mysqli_num_rows($sql)>0)
        {
            
            while($result=mysqli_fetch_assoc($sql))
            {
                 $rack_id=$result['rack_id'];
                 $sql2 = mysqli_query($db_handle,"SELECT barcode_no,name FROM tbl_rack WHERE id='".$rack_id."'");
                 if(mysqli_num_rows($sql2)>0)
                 {
                     $rack_res=mysqli_fetch_object($sql2);
                     $rack_name=$rack_res->name;
                     $rack_barcode=$rack_res->barcode_no;
                 }
                 else
                 {
                     $rack_name="No Data Found";
                     $rack_barcode="No Data Found";
                 }
    
                 $data['break_up_list'][]=array(
                     'barcode_no'=> $rack_barcode,
                     'rack' =>  $rack_name,
                     'unit_price'=>$result['unit_price'],
                     'quantity'=>$result['quantity'],
                     'total_price'=>$result['total_price'],
                     'status'=>($result['status']=='0') ? 'Damaged' : 'Working'
                     );
                $total_price=$total_price+$result['total_price'];
    		}
    		$data['total_price']=number_format($total_price,'2','.','');
        }
        else
        {
            $data['break_up_list']="";
            $data['total_price']="";
        }
		
        print(json_encode($data));
        mysqli_close($db_handle);
        	
?>