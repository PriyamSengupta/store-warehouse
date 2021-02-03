<?php
include_once("config.php");
    $data=array();
    $rack_name=$_POST['rack_name'];
    $warehouse_id=$_POST['warehouse'];
    $status=$_POST['status'];
    $id=$_POST['user_id'];
    $rack_id=$_POST['rack_id'];

    $sqlupdate = mysqli_query($db_handle,"UPDATE tbl_rack SET name='".mysqli_real_escape_string($db_handle,$rack_name)."',warehouse_id='".$warehouse_id."',status='".mysqli_real_escape_string($db_handle,$status)."',modification_date=NOW(),modified_by='".$id."' WHERE id = '".$rack_id."'");
    $sqlupdate1 = mysqli_query($db_handle,"UPDATE tbl_warehouse_to_rack SET warehouse_id='".$warehouse_id."' WHERE id = '".$rack_id."'");    
    if($sqlupdate==true && $sqlupdate1==true)
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