<?php
include_once("config.php");
                $data=array();
        		
        		$name=trim($_POST['name']);
        		$desc=$_POST['description'];
        		$colour=$_POST['colour'];
        		$id=$_POST['user_id'];
        		$status=$_POST['status'];
        		
        		$skuCheck=mysqli_query($db_handle,"SELECT * FROM tbl_sku WHERE name='".$name."'");
        		if(mysqli_num_rows($skuCheck)>0)
        		{
        		    $data['status']="SKU already exists";
        		    print(json_encode($data));
                    mysqli_close($db_handle);
        		}
        		else
        		{
        		    $sqladd=mysqli_query($db_handle,"INSERT INTO tbl_sku SET name='".mysqli_real_escape_string($db_handle,$name)."',status='".mysqli_real_escape_string($db_handle,$status)."',description='".mysqli_real_escape_string($db_handle,$desc)."',colour='".mysqli_real_escape_string($db_handle,$colour)."',creation_date=NOW(),created_by='".$id."',modification_date=NOW(),modified_by='".$id."'");
                    if($sqladd==true)
                    {
                        $data['status']="Successfully added";
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