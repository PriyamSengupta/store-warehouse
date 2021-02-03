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
                  Damaged Transaction
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
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
         <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">

                <div class="x_title">

                  <h2><small>Damaged Transaction</small></h2>

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

                  <strong>Same SKU with working condition is in the rack. Please choose a different rack/warehouse!</strong>

                </div>

                <?php } ?>

                

                <?php if(($_REQUEST['msg'] && $_REQUEST['msg'] == '5')) { ?>

                <div class="alert alert-warning alert-dismissible fade in" role="alert">

                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>

                  </button>

                  <strong>Same SKU with damaged condition is in the rack. Please choose a different rack/warehouse!</strong>

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
                        <!--<th>Product Name</th>-->
                        <th>SKU</th>
                        <th>Warehouse</th>
                        <th>Rack</th>
                        <th>Quantity</th>
                        <!--<th>Action</th>-->

                      </tr>

                    </thead>





                    <tbody>

                    <?php
                        $now=date("Y-m-d");
                        $first_date = strtotime ( '-30 days' , strtotime ($now)) ;
				        $first_date = date('Y-m-d',$first_date);
						$sqlview = mysqli_query($db_handle,"SELECT ptw.product_id,ptw.combo_product_id,w.name AS warehouse,r.name AS rack,ptw.quantity,ptw.warehouse_id,ptw.rack_id FROM tbl_product_to_warehouse ptw LEFT JOIN tbl_warehouse w ON w.id=ptw.warehouse_id LEFT JOIN tbl_rack r ON r.id=ptw.rack_id WHERE ptw.status='0' AND DATE(ptw.creation_date) BETWEEN '".$first_date."' AND '".$now."' ORDER BY ptw.id DESC");
						$count = mysqli_num_rows($sqlview);
						if($count > 0)
						{ $sl=1;

						while($record=mysqli_fetch_object($sqlview))
						{ 
						    if($record->product_id!='0')
						    {
						        $sqlsku=mysqli_fetch_object(mysqli_query($db_handle,"SELECT * FROM tbl_sku WHERE product_id='".$record->product_id."'"));
						        $sku=$sqlsku->name;
						    }
						    if($record->combo_product_id!='0')
						    {
						        $sqlsku=mysqli_fetch_object(mysqli_query($db_handle,"SELECT * FROM tbl_sku WHERE combo_product_id='".$record->combo_product_id."'"));
						        $sku=$sqlsku->name;
						    }

					   ?>

                      <tr>
                      
                        <td><?=$sl; ?></td>
                        <!--<td><?=$record->name; ?></td>-->
                        <td><?=$sku?></td>
                        <td><?=$record->warehouse?></td>
                        <td><?=$record->rack?></td>
                        <td><?=$record->quantity?></td>
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
        </body>
</html>