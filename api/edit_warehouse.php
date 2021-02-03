<?php
include_once("config.php");
        $data=array();
        $warehouse_id=$_POST['id'];
        $warehouse=$_POST['name'];
        $description=$_POST['description'];
        $status=$_POST['status'];
        $user=$_POST['user_id'];
            


        $sqlupdate = mysqli_query($db_handle,"UPDATE tbl_warehouse SET name='".mysqli_real_escape_string($db_handle,$warehouse)."',description='".mysqli_real_escape_string($db_handle,$description)."',status='".mysqli_real_escape_string($db_handle,$status)."',modification_date=NOW(),last_modified_by='".$user."' WHERE id = '".$warehouse_id."'");
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
?>