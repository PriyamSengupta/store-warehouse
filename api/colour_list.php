<?php
include_once("config.php");
    
    $sqlview = mysqli_query($db_handle,"SELECT * FROM tbl_colour ORDER BY id DESC");
						
		while($record=mysqli_fetch_object($sqlview))
		{ 
                $data[]=$record;
        }        
        print(json_encode($data));
        mysqli_close($db_handle);
        	
?>