<?php
include_once("config.php");

    $warehouse_id=$_POST['warehouse_id'];
    
    $sqlQuery=mysqli_query($db_handle,"SELECT id,name FROM tbl_rack WHERE warehouse_id='".$warehouse_id."'");
	if(mysqli_num_rows($sqlQuery)>0)
	{	
		while($sqlResult=mysqli_fetch_object($sqlQuery))
		{ 
			$data[]=array(
			    'id'=>$sqlResult->id,
			    'name'=>$sqlResult->name
			    );
		}
	}
	else 
	{ 
	    $data=[];
	}	        
    print(json_encode($data));
    mysqli_close($db_handle);
        	
?>