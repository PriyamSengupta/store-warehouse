<?php

session_start();

if(@$_SESSION['valid_admin'] != null )

	{

	@header("Location:dashboard.php");

	}

//error_reporting(E_ALL & ~E_NOTICE);

include_once("include/inc.php");

if(isset($_POST["login"]))

{

	$u = trim($_POST['username']);

	$p = trim($_POST['password']);

	$pass = base64_encode($p);

	$user = base64_encode($u);

	//$dept = trim($_POST['role']);

	$sql = mysqli_query($db_handle,"SELECT * FROM ".TBL_ADMIN." WHERE username = '".$user."' AND password = '".$pass."' AND status = '1'");

	//$res = mysql_query($sql);

	$num = mysqli_num_rows ($sql);

	$row = mysqli_fetch_array($sql);

	if($num > 0)

	{

		$sqlup=mysqli_query($db_handle,"UPDATE ".TBL_ADMIN." SET last_login=NOW() WHERE id='".$row["id"]."'");

		$_SESSION['valid_admin'] = 1;

		$_SESSION['user_name'] = $u;

		$_SESSION["id"] = $row["id"];

		$_SESSION["role"] = $row["role"];
		
		$arr_b=array();
		
		$_SESSION['stockout_barcode']=$arr_b;

		@header("Location:dashboard.php");

		die("Header error");

	}else{	

	@header("Location:login.php?act=wrong");

	}

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <!-- Meta, title, CSS, favicons, etc. -->

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Administrative Login Area...</title>

  <!-- Bootstrap core CSS -->

  <link href="css/bootstrap.min.css" rel="stylesheet">

  <link href="fonts/css/font-awesome.min.css" rel="stylesheet">

  <link href="css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->

  <link href="css/custom.css" rel="stylesheet">

  <link href="css/icheck/flat/green.css" rel="stylesheet">

  <script src="js/jquery.min.js"></script>

  <!--[if lt IE 9]>

        <script src="../assets/js/ie8-responsive-file-warning.js"></script>

        <![endif]-->



  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->

  <!--[if lt IE 9]>

          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

        <![endif]-->

</head>

<body style="background:#F7F7F7;">

  <div class="">

    <a class="hiddenanchor" id="toregister"></a>

    <a class="hiddenanchor" id="tologin"></a>

    <div id="wrapper">

      <div id="login" class="animate form">

        <section class="login_content">

          <form action="" method="post">

            <h1>Login to Continue</h1>

            <div>

              <input type="text" class="form-control" placeholder="Username" name="username" required="" />

            </div>

            <div>

              <input type="password" class="form-control" placeholder="Password" name="password" required="" />

            </div>

            <div>

            <button class="btn btn-default submit" name="login">Log In</button>

            </div>

            <div class="clearfix"></div>

            <div class="separator">

              <p class="change_link">New to site?

                <a href="#toregister" class="to_register"> Create Account </a>

              </p>

              <div class="clearfix"></div>

              <br />

              <div>

                <p>©<?php echo date("Y"); ?> All Rights Reserved.</p>

              </div>

            </div>

          </form>

          <!-- form -->

        </section>

        <!-- content -->

      </div>

      <div id="register" class="animate form">

        <section class="login_content">

          <form>

            <h1>Create Account</h1>

            <div>

              <input type="text" class="form-control" placeholder="Username" required="" />

            </div>

            <div>

              <input type="email" class="form-control" placeholder="Email" required="" />

            </div>

            <div>

              <input type="password" class="form-control" placeholder="Password" required="" />

            </div>

            <div>

              <a class="btn btn-default submit" href="#">Submit</a>

            </div>

            <div class="clearfix"></div>

            <div class="separator">



              <p class="change_link">Already a member ?

                <a href="#tologin" class="to_register"> Log in </a>

              </p>

              <div class="clearfix"></div>

              <br />

              <div>

                <p>©<?php echo date("Y"); ?> All Rights Reserved.</p>

              </div>

            </div>

          </form>

          <!-- form -->

        </section>

        <!-- content -->

      </div>

    </div>

  </div>

  <!-- form validation -->

</body>

</html>

