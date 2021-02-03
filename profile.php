<?php include('include/header_top.php'); ?>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <?php include('include/leftbar.php'); ?>
      <!-- top navigation -->
      <?php include('include/top_navigation.php'); ?>
      <!-- /top navigation -->
       <!-- page content -->
      <div class="right_col" role="main">
        <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3>User Profile</h3>
            </div>

            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                </div>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Profile<small></small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a href="#"><i class="fa fa-chevron-up"></i></a>
                    </li>
                   
                    <li><a href="#"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                
                <?php if(($_REQUEST['msg'] && $_REQUEST['msg'] == '1')) { ?>
                <div class="alert alert-success alert-dismissible fade in" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                  </button>
                  <strong>Profile has been updated successfully!</strong>
                </div>
                <?php } ?>

                <?php if(($_REQUEST['msg'] && $_REQUEST['msg'] == '2')) { ?>
                <div class="alert alert-info alert-dismissible fade in" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                  </button>
                  <strong>Email already Exists</strong>
                </div>
                <?php } ?>
                
                <div class="x_content">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="profile_title" style="margin-bottom: 10px;">
                      <div class="col-md-6">
                        <h2>Edit Profile Details</h2>
                      </div>
                    </div>
                    <!-- start of user-activity-graph -->
                    <div id="graph_bar">
                    <div class="x_content">
                    <form id="demo-form2" method="post" action="profileupdate.php" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" name="fname" value="<?php echo $sqladmindata->fname; ?>">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Last Name<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="last-name" required="required" class="form-control col-md-7 col-xs-12" name="lname" value="<?php echo $sqladmindata->lname; ?>">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="email" required="required" class="form-control col-md-7 col-xs-12" name="email" value="<?php echo $sqladmindata->email; ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Phone<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="phone" required="required" class="form-control col-md-7 col-xs-12" name="phone" value="<?php echo $sqladmindata->phone; ?>">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Usergroup<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      <?php $role=$sqladmindata->role;
                      
                        $sqlS1=mysqli_query($db_handle,"SELECT id,name FROM tbl_usergroup WHERE id='".$role."'");
                      ?>
                        
                              <?php while($sqlS=mysqli_fetch_object($sqlS1)) { ?>
                              <input type="text" class="form-control col-md-7 col-xs-12" value="<?=$sqlS->name?>" disabled>
                              <?php } ?>
                        <input type="hidden" value="<?=$sqladmindata->role?>" name="role">
                      
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Username<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="proffetion" required="required" class="form-control col-md-7 col-xs-12" name="username" value="<?php echo base64_decode($sqladmindata->username); ?>" disabled>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Password<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="password" id="website" required="required" class="form-control col-md-7 col-xs-12" name="password" value="<?php echo base64_decode($sqladmindata->password); ?>">
                      </div>
                    </div>
                    
                    <input type="hidden" value="<?=$sqladmindata->id?>" name="id">
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                      	<button type="submit" class="btn btn-success" name="update">Update</button>
                        <!--<button type="reset" class="btn btn-primary">Cancel</button>-->
                      </div>
                    </div>
                    </form>
                  	</div>
                  	</div>
                    <!-- end of user-activity-graph -->
                  </div>
                </div>
              </div>
            </div>
          </div>
<!-- /page content -->
<!-- footer content -->
<?php include('include/footer.php'); ?>
</body>
</html>