<?php include('include/header_top.php'); ?>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <?php include('include/leftbar.php'); ?>
      <!-- top navigation -->
      <?php include('include/top_navigation.php'); ?>
      <link rel="stylesheet" href="css/fancybox.css">
       <script src="js/fancybox.js"></script>      
      <!-- /top navigation -->
       <!-- page content -->
      <div class="right_col" role="main">
        <div class="">
          <div class="page-title">
              <div class="col-sm-6">
            <div class="title_left">
              <h3>
                  Colour List
               </h3>
           </div>
            </div>
            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <!--<div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                </div>-->
                    <a id="add" class="btn btn-info btn-s" style="float:right;"><i class="fa fa-plus"></i> Add Colour</a>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
         <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">

                <div class="x_title">

                  <h2><small>Colour List</small></h2>

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

                  <strong>Data Added Successfully!</strong>
                </div>

                <?php } ?>

                <?php if(($_REQUEST['msg'] && $_REQUEST['msg'] == '2')) { ?>

                <div class="alert alert-info alert-dismissible fade in" role="alert">

                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>

                  </button>

                  <strong>Data Updated Successfully!</strong>

                </div>

                <?php } ?>

                <?php if(($_REQUEST['msg'] && $_REQUEST['msg'] == '3')) { ?>

                <div class="alert alert-warning alert-dismissible fade in" role="alert">

                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>

                  </button>

                  <strong>Data Removed Successfully!</strong>

                </div>

                <?php } ?>

                <?php if(($_REQUEST['msg'] && $_REQUEST['msg'] == '4')) { ?>

                <div class="alert alert-success alert-dismissible fade in" role="alert">

                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>

                  </button>

                  <strong>Data Activated Successfully!</strong>

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

                  <!--<p class="text-muted font-13 m-b-30">

                    The Buttons extension for DataTables provides a common set of options, API methods and styling to display buttons on a page that will interact with a DataTable. The core library provides the based framework upon which plug-ins can built.

                  </p>-->

                  <!--<table id="datatable-buttons" class="table table-striped table-bordered">-->

                  <table id="datatable-brand" class="table table-striped responsive-utilities jambo_table bulk_action">

                    <thead>

                      <tr class="headings">
                       <th>Sl No.</th>
                        <th> Name</th>
                        <th>Creation Date</th>
                        <!--<th>Created By</th>

                        <th>Last Modified Date</th>

                        <th>Last Modified By</th>-->

                        <th>Action</th>

                      </tr>

                    </thead>





                    <tbody>

                    <?php

						$sqlview = mysqli_query($db_handle,"SELECT * FROM tbl_colour ORDER BY id DESC");
						$count = mysqli_num_rows($sqlview);
						if($count > 0)
						{ $sl=1;

						while($record=mysqli_fetch_object($sqlview))

						{ 

					   ?>

                      <tr>
                      
                        <td><?=$sl; ?></td>
                        <td><?=$record->name; ?></td>
                        <td><?=date('d F Y',strtotime($record->creation_date)); ?></td>
                        
                        <!--<td>

                        <a onClick="return confirmStatus();" href="brandstatus.php?id=<?php echo $record->id; ?>">

							<?php                              

							  if($record->status=="0"){							  

							  echo "<button type='button' class='btn btn-success btn-xs'>Active</button>";

							  }else{							  

							  echo "<button type='button' class='btn btn-warning btn-xs'>Inactive</button>";

							  }							  

							 ?>

                		</a>

                		</td>-->

                        <!--<td><?php echo $sqladmindata->fname; ?></td>

                        <td><?php echo date('d F Y',strtotime($record->last_modified_date)); ?></td>

                        <td><?php echo $sqladmindata->fname; ?></td>-->

                        <td><a class="btn btn-info btn-xs" href="edit_colour.php?id=<?php echo $record->id; ?>"><i class="fa fa-pencil"></i> Edit</a><a class="btn btn-danger btn-xs" href="delete_colour.php?id=<?php echo $record->id; ?>" onclick="return confirm('Are you sure you want to delete this Colour?')"><i class="fa fa-trash-o"></i> Delete</a>
                        </td>
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
              <script>  
            $(document).ready(function(){
              $(document).on("click", "#add", function() {
                //var id=$(this).attr("id");
            	$.fancybox({
                     href : 'add_colour.php'
            
                  }, {
                      type: 'iframe'
                  });
              });
            });
        </script>
        </body>
</html>