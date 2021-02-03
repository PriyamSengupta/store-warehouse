<?php
include_once("config.php");
        $data=array();
        $rack_name=$_POST['rack_name'];
        $warehouse=$_POST['warehouse'];
        $status=$_POST['status'];
        $user=$_POST['user_id'];
            
        $sqladd=mysqli_query($db_handle,"INSERT INTO tbl_rack SET name='".mysqli_real_escape_string($db_handle,$rack_name)."',warehouse_id='".mysqli_escape_string($db_handle,$warehouse)."',status='".mysqli_real_escape_string($db_handle,$status)."',creation_date=NOW(),created_by='".$user."',modification_date=NOW(),modified_by='".$user."'");
		$lastID=mysqli_insert_id($db_handle);
		$sqlupdt=mysqli_query($db_handle,"INSERT INTO tbl_warehouse_to_rack SET rack_id='".$lastID."',warehouse_id='".$warehouse."'");
		$rand_code = $lastID;

		$bar_code=str_pad($rand_code,10,"0",STR_PAD_LEFT);	 

		$barcode_upd=mysqli_query($db_handle,"UPDATE tbl_rack SET barcode_no='".$bar_code."' where id='".$lastID."'");

        if($sqladd==true && $sqlupdt==true && $barcode_upd==true)
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