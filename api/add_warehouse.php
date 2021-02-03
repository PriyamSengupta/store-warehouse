<?php
include_once("config.php");
        $data=array();
        $warehouse=$_POST['name'];
        $description=$_POST['description'];
        $status=$_POST['status'];
        $user=$_POST['user_id'];
            


        $sqladd=mysqli_query($db_handle,"INSERT INTO tbl_warehouse SET name='".mysqli_real_escape_string($db_handle,$warehouse)."',description='".mysqli_real_escape_string($db_handle,$description)."',status='".mysqli_real_escape_string($db_handle,$status)."',creation_date=NOW(),created_by='".$user."',modification_date=NOW(),last_modified_by='".$user."',racks='0'");
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
?>