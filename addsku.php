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
	    $sqlS=mysqli_query($db_handle,"SELECT * FROM tbl_sku WHERE name='".mysqli_real_escape_string($db_handle,$_REQUEST['sku_name'])."'");
        if(mysqli_num_rows($sqlS)>0)
        {
            header("location:sku_list.php?msg=5");
        }
        else
        {
		    $sqladd=mysqli_query($db_handle,"INSERT INTO tbl_sku SET name='".mysqli_real_escape_string($db_handle,$_REQUEST['sku_name'])."',status='".mysqli_real_escape_string($db_handle,$_REQUEST['status_check'])."',flag='1',description='".mysqli_real_escape_string($db_handle,$_REQUEST['description'])."',colour='".mysqli_real_escape_string($db_handle,$_REQUEST['colour'])."',creation_date='".$date."',created_by='".$_SESSION['id']."',modification_date='".$date."',modified_by='".$_SESSION['id']."'");

		    header("location:sku_list.php?msg=1");
            //echo "<script type='text/javascript'>window.parent.location.reload()</script>";
        }
	}

	?>