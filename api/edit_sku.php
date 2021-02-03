<?php
include_once("config.php");
                $data=array();
        		
        		$sku_name=$_POST['name'];
        		$desc=$_POST['description'];
        		$colour=$_POST['colour'];
        		$id=$_POST['user_id'];
        		$status=$_POST['status'];
        		$sku=$_POST['sku_id'];
        		
        	    $sqlsel=mysqli_query($db_handle,"SELECT name FROM tbl_sku WHERE name='".mysqli_real_escape_string($db_handle,$sku_name)."' AND id!='".$sku."'");
                
                if(mysqli_num_rows($sqlsel)>0)
                {
                    $data['status']="SKU already exists";
                    print(json_encode($data));
                    mysqli_close($db_handle);
                }
                else
                {
            		$sqlupdate = mysqli_query($db_handle,"UPDATE tbl_sku SET name='".mysqli_real_escape_string($db_handle,$sku_name)."',status='".mysqli_real_escape_string($db_handle,$status)."',description='".mysqli_real_escape_string($db_handle,$desc)."',colour='".mysqli_real_escape_string($db_handle,$colour)."',modification_date=NOW(),modified_by='".$id."' WHERE id = '".$sku."'");
                    if($sqlupdate==true)
                    {
                            $data['status']="Successfully updated";
                            print(json_encode($data));
                            mysqli_close($db_handle);
                    }
                    else
                    {
                            $data['status']="Error";
                            print(json_encode($data));
                            mysqli_close($db_handle);
                    }
                }
?>

