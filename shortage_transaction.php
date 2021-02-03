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
                  Shortage Transaction
               </h3>
           </div>
        </div>
            <div class="title_right">
              <div class="col-md-4 col-sm-4 col-xs-12 form-group pull-right top_search">
                   <?php if((in_array("16",$permission1))) { ?><a href="add_shortage_transaction.php" class="btn btn-info btn-s" style="float:right;"><i class="fa fa-plus"></i> Add New</a><?php } ?>
                <div class="input-group">
                  <!--<input type="text" class="form-control col-md-5 col-sm-5 col-xs-12" placeholder="Enter Barcode.." id="barcode">-->
                  <!--<span class="input-group-btn">-->
                  <!--          <button class="btn btn-default" type="button">Go!</button>-->
                  <!--      </span>-->
                </div>

              </div>
            </div>
          </div>
          <div class="clearfix"></div>
         <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">

                <div class="x_title">

                  <h2><small>Shortage Transaction</small></h2>

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

                  <strong>Not enough quantity in stock!</strong>

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

                  <!--<table id="datatable-brand" class="table table-striped table-bordered datatable abc">-->
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap abc" cellspacing="0" width="100%">
                    <thead>

                      <tr class="headings">
                       <th>Sl No.</th>
                       <th>SKU</th>
                        <th>From Warehouse</th>
                        <th>From Rack</th>
                        <th>Quantity</th>
                        <th>Reason</th>                        

                        <!--<th>Created By</th>

                        <th>Last Modified Date</th>

                        <th>Last Modified By</th>-->

                        <?php if((in_array("16",$permission1))) { ?><th>Action</th><?php } ?>

                      </tr>

                    </thead>





                    <tbody>

                    <?php
                        $now=date("Y-m-d");
                        $first_date = strtotime ( '-30 days' , strtotime ($now)) ;
				        $first_date = date('Y-m-d',$first_date);
						$sqlview = mysqli_query($db_handle,"SELECT st.ptw_id AS product_to_warehouse_id,st.id AS id,w.name AS warehouse,r.name AS rack,s.name AS sku,st.reason,st.quantity FROM tbl_shortage_transaction st LEFT JOIN tbl_warehouse w ON w.id=st.from_warehouse LEFT JOIN tbl_rack r ON r.id=st.from_rack LEFT JOIN tbl_sku s ON s.id=st.sku WHERE st.status='1' AND DATE(st.creation_date) BETWEEN '".$first_date."' AND '".$now."' ORDER BY id DESC");
						$count = mysqli_num_rows($sqlview);
						if($count > 0)
						{ $sl=1;

						while($record=mysqli_fetch_object($sqlview))

						{ 

					   ?>

                      <tr>
                      
                        <td><?=$sl; ?></td>
                        <td><?=$record->sku; ?></td>
                        <td><?=$record->warehouse; ?></td>
                        <td><?=$record->rack; ?></td>
                        <td><?=$record->quantity; ?></td>
                        <td><?=$record->reason; ?></td>
                        
                        <?php if((in_array("16",$permission1))) { ?><td><!--<a href="#/search-plus" class="btn btn-success btn-xs"><i class="fa fa-search-plus"></i>View</a> <a href="#/search-plus" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</a> <a href="#/search-plus" class="btn btn-danger  btn-xs"><i class="fa fa-trash"></i> Delete</a>-->                      
						<a class="btn btn-danger btn-xs" href="delete_shortage_transaction.php?id=<?php echo $record->id; ?>"><i class="fa fa-trash"></i> Delete</a>
                        <!--<a class="btn btn-info btn-xs" href="#"><i class="fa fa-print"></i> Print Barcode</a>-->
						<!--<a class="btn btn-danger btn-xs" href="delete_rack.php?id=<?php echo $record->id; ?>" onclick="return confirm('Are you sure you want to delete this Rack?')"><i class="fa fa-trash-o"></i> Delete</a>-->
                        </td><?php } ?>
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
                     href : 'add_racks.php'
            
                  }, {
                      type: 'iframe'
                  });
              });
            });
        
        </script>
        <script>
        $(document).ready(function(){
            var counter=0;
            var count=0;
        $("#barcode").keyup(function(){
            var barcode=document.getElementById('barcode').value;
            var type=1;
            
            if(barcode!='')
            {
                
                // alert(counter);
                // alert(barcode);
                // alert(type);
                // alert(counter);
                $.ajax({
                
                    type: "POST",
                      url: "ajax_barcode_search.php",
                      data: {barcode : barcode, type : type },
                      dataType: "json",
                      success: function (response) {
                          
                          if(response.wrong)
              			  {
                			 alert(response.wrong);
              			  }
             			  else
                          {
                                var rack=response.rack;
                    			var warehouse=response.warehouse;
                    			var status=response.st;
                        		var creation_date=response.creation_date;
                            	var id=response.id;
                            	counter=counter+1;
                            	count=count+1;
                            	var t = $('.abc').DataTable();
                            	if(count==1)
                            	{
                            	    t.clear();
                            	}
                            	t.row.add( [
                                                counter,
                                                rack,
                                                warehouse,
                                                status,
                                                creation_date,
                                                
                                            ] ).draw( false );
                            	
                            //"<a class='btn btn-info btn-xs' href='edit_rack.php?id=id"+counter+"'><i class='fa fa-pencil'></i> Edit</a><a class='btn btn-danger btn-xs' href='delete_rack.php?id=id"+counter+"' onclick='return confirm("Are you sure you want to delete this Rack?")'><i class='fa fa-trash-o'></i> Delete</a>"	
                            // 	alert(counter);
                            // $(".t1").append("<tr><td>"+counter+"</td><td>"+rack+"</td><td>"+warehouse+"</td><td>"+status+"</td><td>"+creation_date+"</td><td><a class='btn btn-info btn-xs' href='edit_rack.php?id=id"+counter+"'><i class='fa fa-pencil'></i> Edit</a><a class='btn btn-danger btn-xs' href='delete_rack.php?id=id"+counter+"' onclick='return confirm("Are you sure you want to delete this Rack?")'><i class='fa fa-trash-o'></i> Delete</a></td></tr>").trigger('create');
                            // $(".t1").append("<tr><td>"+counter+"</td><td>"+rack+"</td><td>"+warehouse+"</td><td>"+status+"</td><td>"+creation_date+"</td><td><a class='btn btn-info btn-xs' href='edit_rack.php?id=id"+counter+"'><i class='fa fa-pencil'></i> Edit</a><a class='btn btn-danger btn-xs' href='delete_rack.php?id=id"+counter+"' onclick='return confirm("Are you sure you want to delete this Rack?")'><i class='fa fa-trash-o'></i> Delete</a></td></tr>");

                            // $("#barcode").val("");
                          }    
                      }
                      
                });
                
            }

        });
        });
            </script>
        </body>
</html>