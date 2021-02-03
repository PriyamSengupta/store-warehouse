<?php include('include/header_top.php'); ?>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <?php include('include/leftbar.php'); ?>
      <!-- top navigation -->
      <?php include('include/top_navigation.php'); ?>
       <!--<link rel="stylesheet" href="css/fancybox.css">-->
       <!--<script src="js/fancybox.js"></script>-->
      <!-- /top navigation -->
       <!-- page content -->
      <div class="right_col" role="main">
        <div class="">
          <div class="page-title">
              <div class="col-sm-6">
            <div class="title_left">
              <h3>
                  SKU List
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
                    <?php if((in_array("3",$permission1))) { ?><a href="add_sku.php" class="btn btn-info btn-s" style="float:right;"><i class="fa fa-plus"></i> Add SKU</a><?php } ?>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
         <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">

                <div class="x_title">

                  <h2><small>SKU List</small></h2>

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

                  <strong>SKU Added Successfully!</strong>
                </div>

                <?php } ?>

                <?php if(($_REQUEST['msg'] && $_REQUEST['msg'] == '2')) { ?>

                <div class="alert alert-success alert-dismissible fade in" role="alert">

                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>

                  </button>

                  <strong>SKU Updated Successfully!</strong>

                </div>

                <?php } ?>

                <?php if(($_REQUEST['msg'] && $_REQUEST['msg'] == '3')) { ?>

                <div class="alert alert-success alert-dismissible fade in" role="alert">

                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>

                  </button>

                  <strong>SKU Removed Successfully!</strong>

                </div>

                <?php } ?>

                <?php if(($_REQUEST['msg'] && $_REQUEST['msg'] == '4')) { ?>

                <div class="alert alert-warning alert-dismissible fade in" role="alert">

                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>

                  </button>

                  <strong>Can't remove! Product has been already assigned to this SKU.</strong>

                </div>

                <?php } ?>

                

                <?php if(($_REQUEST['msg'] && $_REQUEST['msg'] == '5')) { ?>

                <div class="alert alert-warning alert-dismissible fade in" role="alert">

                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>

                  </button>

                  <strong>SKU already exists!</strong>

                </div>

                <?php } ?>

                

                <div class="x_content">

                  <!--<p class="text-muted font-13 m-b-30">

                    The Buttons extension for DataTables provides a common set of options, API methods and styling to display buttons on a page that will interact with a DataTable. The core library provides the based framework upon which plug-ins can built.

                  </p>-->

                  <!--<table id="datatable-buttons" class="table table-striped table-bordered">-->

                  <!--<table id="datatable-brand" class="table table-striped responsive-utilities jambo_table bulk_action">-->
                  
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>

                      <tr class="headings">
                       <th>Sl No.</th>
                    
                        <th>SKU Name</th>
                        <th>Creation Date</th>
                        <th>Warehouse assigned</th>
                        <th>Status</th>
                        <?php if((in_array("3",$permission1))) { ?><th>Action</th><?php } ?>

                      </tr>

                    </thead>





                    <tbody>

                    <?php
                        $now=date("Y-m-d");
                        $first_date = strtotime ( '-30 days' , strtotime ($now)) ;
				        $first_date = date('Y-m-d',$first_date);
						$sqlview = mysqli_query($db_handle,"SELECT * FROM tbl_sku WHERE DATE(creation_date) BETWEEN '".$first_date."' AND '".$now."' ORDER BY id DESC");
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
                        <td>
                            <?php if($record->product_id==0 && $record->combo_product_id==0)
                            { 
                                echo "<span style='color:#cc1212;'>No</span>";
                            }
                            else
                            { 
                                echo "<span style='color:green;'>Yes</span>"; 
                            }?>
                        </td>
                        <td>
                            <?php if($record->status==1)
                            { 
                                echo "<button type='button' class='btn btn-success btn-xs'>Enabled</button>" ; 
                            }
                            else
                            { 
                                echo "<button type='button' class='btn btn-warning btn-xs'>Disbaled</button>" ;  
                            }?>
                        </td>
                        <?php if((in_array("3",$permission1))) { ?>
                        <td><!--<a href="#/search-plus" class="btn btn-success btn-xs"><i class="fa fa-search-plus"></i>View</a> <a href="#/search-plus" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</a> <a href="#/search-plus" class="btn btn-danger  btn-xs"><i class="fa fa-trash"></i> Delete</a>-->                      
						<a class="btn btn-info btn-xs" href="edit_sku.php?id=<?php echo $record->id; ?>"><i class="fa fa-pencil"></i> Edit</a>
						<a class="btn btn-danger btn-xs" href="delete_sku.php?id=<?php echo $record->id; ?>" onclick="return confirm('Are you sure you want to delete this SKU?')"><i class="fa fa-trash-o"></i> Delete</a>
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
        <script>  
            $(document).ready(function(){
              $(document).on("click", "#add", function() {
                //var id=$(this).attr("id");
            	$.fancybox({
                     href : 'add_sku.php'
            
                  }, {
                      type: 'iframe'
                  });
              });
            });
        </script>
        </body>
</html>