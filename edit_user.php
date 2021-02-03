<?php

    session_start();

  if(@$_SESSION['valid_admin'] == "" )
  {
      @header("Location:login.php");
  }

  include_once("include/inc.php");
  if(isset($_POST["edit"]))
  {

    $sqlupdate = mysqli_query($db_handle,"UPDATE tbl_user SET fname='".mysqli_real_escape_string($db_handle,$_REQUEST['fname'])."',lname='".mysqli_real_escape_string($db_handle,$_REQUEST['lname'])."',role='".mysqli_real_escape_string($db_handle,$_REQUEST['usergroup'])."',username='".mysqli_real_escape_string($db_handle,base64_encode($_REQUEST['username']))."',password='".mysqli_real_escape_string($db_handle,base64_encode($_REQUEST['password']))."',email='".mysqli_real_escape_string($db_handle,$_REQUEST['email'])."',phone='".mysqli_real_escape_string($db_handle,$_REQUEST['phone'])."',status='".mysqli_real_escape_string($db_handle,$_REQUEST['status_check'])."' WHERE id = '".$_REQUEST['user_id']."'");

    header("location:user_list.php?msg=2");
  }

?>
<?php include('include/header_top.php'); ?>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
    <?php include('include/leftbar.php'); ?>
      <!-- top navigation -->
      <?php include('include/top_navigation.php'); ?>
      <!-- /top navigation -->
       <!-- page content -->
       <?php
            $user_id = $_REQUEST['id'];
            $sqluserdata = mysqli_fetch_object(mysqli_query($db_handle,"SELECT * FROM tbl_user WHERE id ='".$user_id."'"));	 
       ?>
      <div class="right_col" role="main">
          <?php
           if (!(in_array("10",$permission1))) { 
                echo "<script>alert('You donot have access to open this page')</script>";
          ?>
        </div>
        </div>
        </div>
        
        <?php include('include/footer.php'); 
        } else { ?>
        <div class="">
          <div class="page-title">
              <div class="col-sm-6">
            <div class="title_left">
              <h3>
                  Add New User
               </h3>
           </div>
        </div>
            <div class="title_right">
              <div class="col-md-2 col-sm-2 col-xs-12 form-group pull-right top_search">
                <!--<div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                </div>-->
                <!--<button type="button" class="btn btn-info btn-s add"><i class="fa fa-plus"></i> Add Product</button>-->
                    <a href="user_list.php" class="btn btn-info btn-s" style="float:right;"><i class="fa fa-history"></i> Back to User List</a>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>

          <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">

              <div class="x_panel">

                <div class="x_title">

                  <h2>Add <small>User</small></h2>

                  <ul class="nav navbar-right panel_toolbox">

                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>

                    </li>

                    <li><a class="close-link"><i class="fa fa-close"></i></a>

                    </li>

                  </ul>

                  <div class="clearfix"></div>

                </div>

                <div class="x_content">

                  <br/>

                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="edit_user.php" method="post">

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="colour_name">First Name <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="fname" name="fname" required="required" class="form-control col-md-7 col-xs-12" value="<?=$sqluserdata->fname?>">
                      </div>
                      <!-- <button type="button" onclick="check_availabilty();" class="btn btn-success btn-xs">Check availability</button> -->
                    </div>
                    <input type="hidden" value="<?=$user_id?>" name="user_id">
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="colour_name">Last Name <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="lname" name="lname" required="required" value="<?=$sqluserdata->lname?>" class="form-control col-md-7 col-xs-12">
                      </div>
                      <!-- <button type="button" onclick="check_availabilty();" class="btn btn-success btn-xs">Check availability</button> -->
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="warehouse">Select Usergroup <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="usergroup" id="usergroup" required>
                           <option value="">Select usergroup</option>
                                      <?php 
                                      $sqlselect=mysqli_query($db_handle,"SELECT * FROM tbl_usergroup where status=1 ORDER BY id ASC"); while($record=mysqli_fetch_object($sqlselect)) { ?><option value="<?php echo $record->id; ?>" <?php if($sqluserdata->role==$record->id) { echo "selected='selected'"; } ?> ><?php echo $record->name; ?>
                                        
                            </option>
                            <?php }  ?>
                        </select>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">Username<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="username" name="username" required="required" class="form-control col-md-7 col-xs-12" value="<?=base64_decode($sqluserdata->username)?>">
                      </div>
                      <!-- <button type="button" onclick="check_availabilty();" class="btn btn-success btn-xs">Check availability</button> -->
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="password" id="password" name="password" required="required" value="<?=base64_decode($sqluserdata->password)?>" class="form-control col-md-7 col-xs-12">
                      </div>
                      <!-- <button type="button" onclick="check_availabilty();" class="btn btn-success btn-xs">Check availability</button> -->
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="colour_name">Email<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="email" name="email" required="required" value="<?=$sqluserdata->email?>" class="form-control col-md-7 col-xs-12">
                      </div>
                      <!-- <button type="button" onclick="check_availabilty();" class="btn btn-success btn-xs">Check availability</button> -->
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone_no">Phone no<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="phone" name="phone" value="<?=$sqluserdata->phone?>" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                      <!-- <button type="button" onclick="check_availabilty();" class="btn btn-success btn-xs">Check availability</button> -->
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">Status <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <label class="switch">
                          <input type="checkbox" name="status_check" id="status" <?php if($sqluserdata->status==1) { ?> value="1" checked <?php } else { ?> value="0" <?php } ?>>
                          <span class="slider round"></span>
                        </label>
                      </div>
                    </div>
                    
                    <!-- <input type="hidden" name="status" value=""> -->
                    <div class="position_loader" id="loadgif"></div>                     
                    <div class="ln_solid"></div>

                    <div class="form-group">

                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                      	<button type="submit" class="btn btn-success" id="edit" name="edit">Submit</button>

                        <button type="reset" class="btn btn-primary">Cancel</button>                        
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        <!-- /page content -->
        <!-- footer content -->
        <?php include('include/footer.php'); } ?>
        <script type="text/javascript">
            $(function()
            {
              $('[name="status_check"]').change(function()
              {
                if ($(this).is(':checked')) {
                   document.getElementById('status').value=1;
                  
                }
                else
                {
                    document.getElementById('status').value=0;
                }
              });
            });
          </script>
        </body>
</html>