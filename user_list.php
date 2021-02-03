<?php include('include/header_top.php'); ?>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <?php include('include/leftbar.php'); ?>
      <!-- top navigation -->
      <?php include('include/top_navigation.php'); ?>
      <!-- /top navigation -->
      <link rel="stylesheet" href="css/fancybox.css">
       <script src="js/fancybox.js"></script>
       <!-- page content -->
      <div class="right_col" role="main">
        <div class="">
          <div class="page-title">
              <div class="col-sm-6">
            <div class="title_left">
              <h3>
                  User List
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
                <?php if((in_array("10",$permission1))) { ?><a href="add_new_user.php" class="btn btn-info btn-s" style="float:right;"><i class="fa fa-plus"></i> Add User</a><?php } ?>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
         <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">

                <div class="x_title">

                  <h2><small>User List</small></h2>

                  <ul class="nav navbar-right panel_toolbox">
                    <li><a href="#"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <!--<li class="dropdown">

                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>

                      <ul class="dropdown-menu" role="menu">

                        <li><a href="#">Settings 1</a>

                        </li>

                        <li><a href="#">Settings 2</a>

                        </li>

                      </ul>

                    </li>-->

                    <li><a href="#"><i class="fa fa-close"></i></a>

                    </li>

                  </ul>

                  <div class="clearfix"></div>

                </div>

                <?php if(($_REQUEST['msg'] && $_REQUEST['msg'] == '1')) { ?>

                <div class="alert alert-success alert-dismissible fade in" role="alert">

                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>

                  </button>

                  <strong>User Added Successfully!</strong>
                </div>

                <?php } ?>

                <?php if(($_REQUEST['msg'] && $_REQUEST['msg'] == '2')) { ?>

                <div class="alert alert-info alert-dismissible fade in" role="alert">

                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>

                  </button>

                  <strong>User Updated Successfully!</strong>

                </div>

                <?php } ?>

                <?php if(($_REQUEST['msg'] && $_REQUEST['msg'] == '3')) { ?>

                <div class="alert alert-success alert-dismissible fade in" role="alert">

                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>

                  </button>

                  <strong>User Removed Successfully!</strong>

                </div>

                <?php } ?>

                <?php if(($_REQUEST['msg'] && $_REQUEST['msg'] == '4')) { ?>

                <div class="alert alert-success alert-dismissible fade in" role="alert">

                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>

                  </button>

                  <strong>User Activated Successfully!</strong>

                </div>

                <?php } ?>

                

                <?php if(($_REQUEST['msg'] && $_REQUEST['msg'] == '5')) { ?>

                <div class="alert alert-warning alert-dismissible fade in" role="alert">

                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>

                  </button>

                  <strong>Data Inactivated Successfully!</strong>

                </div>

                <?php } ?>

                

                <div class="x_content">

                  <!--<table id="datatable-brand" class="table table-striped responsive-utilities jambo_table bulk_action">-->
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>

                      <tr class="headings">
                        <th>Sl No.</th>
                        <th>Name</th>
                        <th>Phone No</th>
                        <th>Email</th>
                        <th>Usergroup</th>
                        <th>Status</th>                     
                        <?php if((in_array("10",$permission1))) { ?><th>Action</th><?php } ?>
                      </tr>

                    </thead>
                    
                    <tbody>

                    <?php

						$sqlview = mysqli_query($db_handle,"SELECT * FROM tbl_user WHERE flag='1' ORDER BY id DESC");
						$count = mysqli_num_rows($sqlview);
						if($count > 0)
						{ $sl=1;

						while($record=mysqli_fetch_object($sqlview))
						{ 

					   ?>

                      <tr>
                      
                        <td><?=$sl; ?></td>
                        <td><?=$record->fname." ".$record->lname; ?></td>
                        <td><?=$record->phone?></td>
                        <td><?=$record->email?></td>
    
                        <td><?php 
                                $usergroup_id=$record->role;
                                $sqlusergroup=mysqli_query($db_handle,"SELECT name FROM tbl_usergroup WHERE id='".$usergroup_id."'");
                                $result2=mysqli_fetch_object($sqlusergroup);
                                echo $result2->name;?>
                        </td>
                        <td><?php if($record->status=='0') echo 'Disabled'; else echo 'Enabled'; ?></td>
                        <?php if((in_array("10",$permission1))) { ?>
                        <td>
						<a class="btn btn-info btn-xs" href="edit_user.php?id=<?php echo $record->id; ?>"><i class="fa fa-pencil"></i> Edit</a>
						<a class="btn btn-danger btn-xs" href="delete_user.php?id=<?php echo $record->id; ?>" onclick="return confirm('Are you sure you want to delete this User?')"><i class="fa fa-trash-o"></i> Delete</a>
                        </td>
                        <?php } ?>
                      </tr>
                      <?php $sl++; } } ?>                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
                

                </div>
              </div>
       <!-- /page content -->
        <!-- footer content -->
        <?php include('include/footer.php'); ?>
