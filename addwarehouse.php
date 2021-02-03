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
	    $sqlS=mysqli_query($db_handle,"SELECT * FROM tbl_warehouse WHERE name='".mysqli_real_escape_string($db_handle,$_REQUEST['warehouse_name'])."' AND flag='1'");
        if(mysqli_num_rows($sqlS)>0)
        {
            header("location:warehouse_list.php?msg=5");
        }
        else
        {
		    $sqladd=mysqli_query($db_handle,"INSERT INTO tbl_warehouse SET name='".mysqli_real_escape_string($db_handle,$_REQUEST['warehouse_name'])."',description='".mysqli_real_escape_string($db_handle,$_REQUEST['warehouse_description'])."',status='1',flag='1',creation_date='".$date."',created_by='".$_SESSION['id']."',modification_date='".$date."',last_modified_by='".$_SESSION['id']."',racks='0'");
    		header("location:warehouse_list.php?msg=1");
        }    
            // 		echo "<script type='text/javascript'>window.parent.location.reload()</script>";

	}

	?>
