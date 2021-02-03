<?php 

	session_start();

	if($_SESSION['valid_admin'] == "" )
	{

		header("Location:login.php");
	}

	include_once("include/inc.php");

	

	if(isset($_POST["update"]))
	{
	    $date = date('Y-m-d H:i:s');
	   // print_r($_POST);
        $sqlSelect=mysqli_query($db_handle,"SELECT * FROM tbl_user WHERE id!='".$_POST['id']."' AND email='".mysqli_real_escape_string($db_handle,$_POST['email'])."'");
        if(mysqli_num_rows($sqlSelect)>0)
        {
            header("location:profile.php?msg=2");
        }
        else
        {
            $sqlupdt=mysqli_query($db_handle,"UPDATE tbl_user SET fname='".mysqli_real_escape_string($db_handle,$_POST['fname'])."',lname='".mysqli_real_escape_string($db_handle,$_POST['lname'])."',email='".mysqli_real_escape_string($db_handle,$_POST['email'])."',phone='".mysqli_real_escape_string($db_handle,$_POST['phone'])."',password='".mysqli_real_escape_string($db_handle,base64_encode($_POST['password']))."',role='".mysqli_real_escape_string($db_handle,$_POST['role'])."' WHERE id='".$_POST['id']."'");
            session_start();
            $_SESSION['role']=$_POST['role'];
            header("location:profile.php?msg=1");
        }

	}

	?>