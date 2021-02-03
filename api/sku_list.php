<?php
include_once("config.php");
    
    $sqlview = mysqli_query($db_handle,"SELECT * FROM tbl_sku ORDER BY id DESC");
						
		while($record=mysqli_fetch_object($sqlview))
		{ 
		  if($record->product_id==0 && $record->combo_product_id==0)
		  { 
		      $msg= "No";
		      
		  } 
		  else 
		  {
		      $msg= "Yes"; 
		  }
                $data[]=array(
                    'id'    =>$record->id,
                    'name'  =>$record->name,
                    'status'=>($record->status=='0') ? 'Disabled' : 'Enabled',
                    'description'=>$record->description,
                    'colour'=>$record->colour,
                    'message'=>$msg
                    );
        }        
        print(json_encode($data));
        mysqli_close($db_handle);
        	
?>