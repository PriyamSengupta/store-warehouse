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
          
        <?php
        if(isset($_REQUEST['id'])){
           if (!(in_array("15",$permission1))) { 
                echo "<script>alert('You donot have access to open this page')</script>";
          ?>
        </div>
        </div>
        </div>
        
        <?php include('include/footer.php'); 
        } } ?>
          
        <div class="">
          <div class="page-title">
              <div class="col-sm-6">
            <div class="title_left">
              <h3>
                  Orders
               </h3>
           </div>
</div>
            <div class="title_right">
              <div class="col-md-2 col-sm-2 col-xs-12 form-group pull-right top_search">
                </div>
            </div>
          </div>
          <div class="clearfix"></div>
         <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">

                <div class="x_title">

                  <h2><small>Order List</small></h2>

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

                  <strong>The quantity You have entered is greater than the quantity of the order.!</strong>

                </div>

                <?php } ?>

                

                <?php if(($_REQUEST['msg'] && $_REQUEST['msg'] == '5')) { ?>

                <div class="alert alert-warning alert-dismissible fade in" role="alert">

                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>

                  </button>

                  <strong>Not enough quantity in stock. Ordered SKU is already in que in other order(s). </strong>

                </div>

                <?php } ?>
                
                <?php if(($_REQUEST['msg'] && $_REQUEST['msg'] == '6')) { ?>

                <div class="alert alert-warning alert-dismissible fade in" role="alert">

                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>

                  </button>

                  <strong>Not enough quantity in stock.</strong>

                </div>

                <?php } ?>
                
                <?php if(($_REQUEST['msg'] && $_REQUEST['msg'] == '7')) { ?>

                <div class="alert alert-warning alert-dismissible fade in" role="alert">

                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>

                  </button>

                  <strong>Ordered Sku(s) aren't in working condition.</strong>

                </div>

                <?php } ?>
                

                <div class="x_content">

                  <!--<p class="text-muted font-13 m-b-30">

                    The Buttons extension for DataTables provides a common set of options, API methods and styling to display buttons on a page that will interact with a DataTable. The core library provides the based framework upon which plug-ins can built.

                  </p>-->

                  <!--<table id="datatable-buttons" class="table table-striped table-bordered">-->
                  <?php $id=$_REQUEST['id']; ?>
                  <!--<table id="datatable-brand" class="table table-striped table-bordered datatable">-->
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>

                      <tr class="headings">
                       <th class="text-center">Sl No.</th>
                        <!--<th>Product Name</th>-->
                        <th class="text-center">SKU</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center"><?php if($id=='1') { echo "Action"; } else { echo "Status"; } ?></th>

                      </tr>

                    </thead>

                    <tbody>

                    <?php
                        if($id==1)
                        {
                                $sqlview = mysqli_query($db_handle,"SELECT o.id,o.status,GROUP_CONCAT(od.quantity separator '<br>') quantity,GROUP_CONCAT(s.name separator '<br>') name FROM tbl_order_details od LEFT JOIN tbl_order o ON o.id=od.order_id LEFT JOIN tbl_sku s ON s.id=od.sku WHERE o.status='0' GROUP BY od.order_id");
        						$count = mysqli_num_rows($sqlview);
        						if($count > 0)
        						{ $sl=1;
        
        						while($record=mysqli_fetch_object($sqlview))
        
        						{ 
        
        					   ?>
        
                              <tr>
                                <td class="text-center"><?=$sl; ?></td>
                                <td class="text-center"><?=$record->name; ?></td>
                                <td class="text-center"><?=$record->quantity?></td>
                                <td class="text-center">
                                    
                                    <?php
                                    if($id=="1") { 
                                        
                                        echo "<a class='btn btn-info btn-xs' href='pick_list.php?id=".$record->id."'>Pick List</a>";
                                        if (in_array("20",$permission)) { 
                                            echo "<a class='btn btn-info btn-xs' href='process_order.php?id=".$record->id."'>Process Order</a>";
                                        }
                                    }
                                    ?>
                                </td>
                              </tr>
                              <?php $sl++; } }                                 
                        }
                        else
                        {
                                $now=date("Y-m-d");
                                $first_date = strtotime ( '-30 days' , strtotime ($now)) ;
        				        $first_date = date('Y-m-d',$first_date);
                                $sqlview = mysqli_query($db_handle,"SELECT o.id,o.status,GROUP_CONCAT(od.quantity separator '<br>') quantity,GROUP_CONCAT(s.name separator '<br>') name FROM tbl_order_details od LEFT JOIN tbl_order o ON o.id=od.order_id LEFT JOIN tbl_sku s ON s.id=od.sku WHERE DATE(o.creation_date) BETWEEN '".$first_date."' AND '".$now."' GROUP BY od.order_id ORDER BY o.id DESC");
        						$count = mysqli_num_rows($sqlview);
        						if($count > 0)
        						{ $sl=1;
        
        						while($record=mysqli_fetch_object($sqlview))
        						{ 
        
        					   ?>
        
                              <tr>
                                <td class="text-center"><?=$sl; ?></td>
                                <td class="text-center"><?=$record->name; ?></td>
                                <td class="text-center"><?=$record->quantity?></td>
                                <td class="text-center">
                                    
                                    <?php
                                    
                                        if($record->status=="0") { echo "<a class='btn btn-danger btn-xs' href='javascript:void(0)'>Not Approved</a>"; } 
                                        else { echo "<button type='button' class='btn btn-info btn-xs' id='prints".$record->id."' value='".$record->id."' onclick='print(".$record->id.")'><span class='glyphicon glyphicon-save-file' aria-hidden='true'></span>Print Challan</button>"; 
                                        }  
                                    
                                    ?>
                                </td>
                              </tr>
                              <?php $sl++; } }
                        }
						?>                      
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
            function print(id) 
            {
                var orderid=$('#prints'+id).val();
                // alert(orderid);
            	$.fancybox({
                     href : 'print_challan.php?id='+orderid
            
                  }, {
                      type: 'iframe'
                  });
            }
        </script>
        </body>
</html>