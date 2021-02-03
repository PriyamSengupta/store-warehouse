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
                  Goods Inward List
               </h3>
           </div>
        </div>
            <div class="title_right">
              <div class="col-md-4 col-sm-4 col-xs-12 form-group pull-right top_search">
                   <?php if((in_array("5",$permission1))) { ?>
                    <a href="add_inward_transaction.php" class="btn btn-info btn-s" style="float:right;"><i class="fa fa-plus"></i> Add transaction</a><?php } ?>
                <div class="input-group">
                  <input type="text" class="form-control col-md-5 col-sm-5 col-xs-12" placeholder="Enter Barcode.." id="barcode">
                  <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                </div>

              </div>
            </div>
          </div>
       
          <div class="clearfix"></div>
         <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">

                <div class="x_title">

                  <h2><small>Product List</small></h2>

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

                  <!--<table id="datatable-brand" class="table table-striped table-bordered datatable abc">-->
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap abc" cellspacing="0" width="100%">
                    <thead>

                      <tr class="headings">
                       <th>Sl No.</th>
                        <!--<th>Product Name</th>-->
                        <!--<th>Warehouse</th>-->
                        <th class="text-center">Barcode</th>
                        <th class="text-center">SKU</th>
                        <!--<th>Unit Price</th>-->
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Total_price</th>
                        <th class="text-center">Creation Date</th>                     
                        <th class="text-center">Action</th>

                      </tr>

                    </thead>





                    <tbody>

                    <?php
                        $now=date("Y-m-d");
                        $first_date = strtotime ( '-30 days' , strtotime ($now)) ;
				        $first_date = date('Y-m-d',$first_date);
						$sqlview = mysqli_query($db_handle,"SELECT * FROM tbl_products WHERE DATE(modification_date) BETWEEN '".$first_date."' AND '".$now."' ORDER BY id ASC");
						$count = mysqli_num_rows($sqlview);
						if($count > 0)
						{ $sl=1;

						while($record=mysqli_fetch_object($sqlview))

						{ 

					   ?>

                      <tr>
                      
                        <td align="left"><?=$sl; ?></td>
                        <td align="center"><?=$record->barcode_no; ?></td>
                        

                        <td align="center"><?php 
                                $sku_id=$record->sku;
                                $sqlsku=mysqli_query($db_handle,"SELECT name FROM tbl_sku WHERE id='".$sku_id."'");
                                $result2=mysqli_fetch_object($sqlsku);
                                echo $result2->name;?>
                        </td>

                        <!--<td><?=$record->unit_price;?></td>-->
                        <td align="center"><?=$record->quantity?></td>
                        <td align="center"><?=$record->total_price?></td>
                        <td align="center"><?=date('d F Y',strtotime($record->creation_date)); ?></td>
                        
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

                        <td align="center"><!--<a href="#/search-plus" class="btn btn-success btn-xs"><i class="fa fa-search-plus"></i>View</a> <a href="#/search-plus" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</a> <a href="#/search-plus" class="btn btn-danger  btn-xs"><i class="fa fa-trash"></i> Delete</a>-->                      
						<a class="btn btn-info btn-xs" href="view_inward_transaction.php?id=<?php echo $record->id; ?>"><i class="fa fa-eye"></i> View</a>
						<?php if((in_array("5",$permission1))) { ?><a class="btn btn-info btn-xs" href="edit_transaction.php?id=<?php echo $record->id; ?>"><i class="fa fa-pencil"></i> Edit</a>
						<a class="btn btn-info btn-xs" target="_blank" href="barcode_multi/html/BCGcode39.php?text=<?php echo $record->barcode_no; ?>&type=2"><i class="fa fa-print"></i> Print Barcode</a><?php } ?>
						<!--<a class="btn btn-danger btn-xs" href="delete_product.php?id=<?php echo $record->id; ?>" onclick="return confirm('Are you sure you want to delete this Rack?')"><i class="fa fa-trash-o"></i> Delete</a>-->
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
                     href : 'add_product.php'
            
                  }, {
                      type: 'iframe'
                  });
              });
            });
        </script>
        
        <script>
                $(document).ready(function(){
                    // var counter=0;
                    var counter=1;
                    var count=0;
                $("#barcode").keyup(function(){
                    var barcode=document.getElementById('barcode').value;
                    var type=2;
                    
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
                                    //   alert("test");
                                    // console.log(response)
                                        var id=response.id;
                            			var barcode_no=response.barcode_no;
                            			var sku=response.sku;
                            			var quantity=response.quantity;
                            			var total_price=response.total_price;
                                		var creation_date=response.creation_date;
                                    	var id=response.id;
                                    // 	counter=counter+1;
                                    	count=count+1;
                                    	var t = $('.abc').DataTable();
                                    // 	if(count==1)
                                    // 	{
                                    	    t.clear();
                                    // 	}
                                    	t.row.add( [
                                                        counter,
                                                        barcode_no,
                                                        sku,
                                                        quantity,
                                                        total_price,
                                                        creation_date,
                                                        '<center><a class="btn btn-info btn-xs" href="view_inward_transaction.php?id='+id+'"><i class="fa fa-eye"></i> View</a></center>',
                                                        
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