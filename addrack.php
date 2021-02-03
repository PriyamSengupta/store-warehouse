<?php 

	session_start();

	if(@$_SESSION['valid_admin'] == "" )
	{

		@header("Location:login.php");
	}

	include_once("include/inc.php");

	

	if(isset($_POST["add"]))

	{
        $date = date('Y-m-d H:i:s');
        $sqlss=mysqli_query($db_handle,"SELECT * FROM tbl_rack WHERE name='".mysqli_real_escape_string($db_handle,$_REQUEST['rack_name'])."' AND warehouse_id='".$_REQUEST['warehouse_id']."'");
        if(mysqli_num_rows($sqlss)>0)
        {
            header("location:rack_list.php?msg=5");
        }
        else
        {
            $sqlss1=mysqli_query($db_handle,"SELECT * FROM tbl_warehouse WHERE id='".$_REQUEST['warehouse_id']."' AND flag='0'");
            if(mysqli_num_rows($sqlss1)>0)
            {
                header("location:rack_list.php?msg=6");
            }
            else
            {
        		$sqladd=mysqli_query($db_handle,"INSERT INTO tbl_rack SET name='".mysqli_real_escape_string($db_handle,$_REQUEST['rack_name'])."',warehouse_id='".mysqli_escape_string($db_handle,$_REQUEST['warehouse_id'])."',status='".mysqli_real_escape_string($db_handle,$_REQUEST['status_check'])."',flag='1',creation_date='".$date."',created_by='".$_SESSION['id']."',modification_date='".$date."',modified_by='".$_SESSION['id']."'");
        		$lastID=mysqli_insert_id($db_handle);
        		$warehouse_id=$_REQUEST['warehouse_id'];
        		$sqlupdt=mysqli_query($db_handle,"INSERT INTO tbl_warehouse_to_rack SET rack_id='".$lastID."',warehouse_id='".$warehouse_id."'");
        		$rand_code = $lastID;
        
        		$bar_code=str_pad($rand_code,10,"0",STR_PAD_LEFT);	 
        
        		$barcode_upd=mysqli_query($db_handle,"UPDATE tbl_rack SET barcode_no='".$bar_code."' where id='".$lastID."'");
        		
        		header("location:rack_list.php?msg=1");
        // 		echo "<script type='text/javascript'>window.parent.location.reload()</script>";
        
            }    
        }
	}

	?>