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
        $access_role=implode(',',$_REQUEST['access_permission']);
        $modify_role=implode(',',$_REQUEST['modify_permission']);

        $sqladd=mysqli_query($db_handle,"INSERT INTO tbl_usergroup SET name='".mysqli_real_escape_string($db_handle,$_REQUEST['name'])."',status='".mysqli_real_escape_string($db_handle,$_REQUEST['status_check'])."',access_permission='".$access_role."',modify_permission='".$modify_role."',creation_date='".$date."',created_by='".$_SESSION['id']."',modification_date='".$date."',modified_by='".$_SESSION['id']."'");
// 		$lastID=mysqli_insert_id($db_handle);
        
		header("location:usergroup_list.php?msg=1");
// 		echo "<script type='text/javascript'>window.parent.location.reload()</script>";

	}

?>