<?php
include_once("config.php");

        $u = trim($_POST['username']);
        $p = trim($_POST['password']);
        $pass = base64_encode($p);
        $user = base64_encode($u);
        
        $sql = mysqli_query($db_handle,"SELECT * FROM tbl_user WHERE username = '".$user."' AND password = '".$pass."' AND status = '1'");
        	$num = mysqli_num_rows ($sql);

        	$row = mysqli_fetch_array($sql);
        	if($num > 0)
        	{
        
        		$sqlup=mysqli_query($db_handle,"UPDATE ".TBL_ADMIN." SET last_login=NOW() WHERE id='".$row["id"]."'");
        		$data['username'] = $u;
        		$data["id"] = $row["id"];
        		$data['status']="Successfully logged in";
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