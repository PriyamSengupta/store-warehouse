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
                  Warehouse List
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
                
                    <a id="back" class="btn btn-info btn-s" style="float:right;"><i class="fa fa-history"></i> Back to Transaction List</a>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
         <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">

                <div class="x_title">

                  <!--<h2><small>Warehouse List</small></h2>-->

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
                    <div class="position_loader" id="loadgif"></div>
                  <table id="datatable-keytable" class="table table-striped table-bordered">
                    <thead>

                          <tr>
                            <th>Sl No.</th>
                            <th>Warehouse</th>
                            <th>Quantity</th>
                            <th>Total_price</th>
                            <th>Action</th>
                            
                          </tr>

                    </thead>





                    <tbody>

                    <?php
                        $id=$_REQUEST['id'];
						$sqlview = mysqli_query($db_handle,"SELECT SUM(ptw.quantity) AS total_quant,SUM(ptw.total_price) AS total_amount,p.id,p.unit_price,ptw.warehouse_id,ptw.quantity FROM tbl_products p LEFT JOIN tbl_product_to_warehouse ptw ON p.id=ptw.product_id WHERE p.id='".$id."' GROUP BY ptw.warehouse_id");
						$count = mysqli_num_rows($sqlview);
						if($count > 0)
						{ $sl=1;

						while($record=mysqli_fetch_object($sqlview))

						{ 

					   ?>

                      <tr>
                      
                        <td><?=$sl; ?></td>
                        <td><?php   $warehouse=$record->warehouse_id;
                                    $sqlWh=mysqli_query($db_handle,"SELECT name FROM tbl_warehouse WHERE id='".$warehouse."'");
                                    $result=mysqli_fetch_object($sqlWh);
                                    echo $result->name;?>
                        </td>
                        
                        <td><?=$record->total_quant?></td>
                        <td>
                            <?php 
                                // $unit_price=$record->unit_price;
                                // $quantity=$record->quantity;
                                // $total_price=$quantity*$unit_price;
                                
                                echo number_format($record->total_amount,'2','.','') 
                            ?>
                        </td>
                        <td><!--<a href="#/search-plus" class="btn btn-success btn-xs"><i class="fa fa-search-plus"></i>View</a> <a href="#/search-plus" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</a> <a href="#/search-plus" class="btn btn-danger  btn-xs"><i class="fa fa-trash"></i> Delete</a>-->                      
						<button type="button" id="<?php echo $record->warehouse_id; ?>" class="btn btn-info btn-xs view"><i class="fa fa-eye"></i> View</button>
                        </td>
                      </tr>
                      <?php $sl++; } } ?>                      
                    </tbody>
                  </table>
                  <input type="hidden" id="product_id" value="<?=$_REQUEST['id']?>">
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
              $(document).on("click", "#back", function() {
                //var id=$(this).attr("id");
            	window.location.href='inward_transaction_list.php';
              });
            });
        </script>
        
        <script>
            $(document).ready(function(){
              $(document).on("click", ".view", function() {
                var id=$(this).attr("id");
                var pro_id=$('#product_id').val();
                // alert(pro_id);
                	$.fancybox({
                	    
                	   beforeSend: function() {
                        $('#loadgif').html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');
                      },
                      complete: function() {
                        $('#loadgif').html('<i style="display:none" class="fa fa-refresh"></i>');
                      },
                	    
                         href : 'view_product_details.php?warehouse='+id+'&product='+pro_id
                      }, {
                            type: 'iframe'
                      });
                  });
                });
        </script>
        
        </body>
</html>