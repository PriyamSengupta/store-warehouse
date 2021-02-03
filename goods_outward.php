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
                 Goods Outward
               </h3>
           </div>
        </div>

            <div class="title_right">

              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <?php if((in_array("6",$permission1))) { ?><a href="add_outward_transaction.php" class="btn btn-info btn-s" style="float:right;"><i class="fa fa-plus"></i> Add New</a><?php } ?>
               
              </div>
            </div>
          </div>
          <div class="clearfix"></div>

          <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">

              <div class="x_panel">

                <div class="x_title">

                  <!--<h2>Add <small>Combo Product</small></h2>-->

                  <ul class="nav navbar-right panel_toolbox">

                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>

                    </li>

                    <li><a class="close-link"><i class="fa fa-close"></i></a>

                    </li>

                  </ul>

                  <div class="clearfix"></div>

                </div>
                <?php if(($_REQUEST['msg'] && $_REQUEST['msg'] == '1')) { ?>

                <div class="alert alert-success alert-dismissible fade in" role="alert">

                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>

                  </button>

                  <strong></strong>Successfully Approved!</strong>
                </div>

                <?php } ?>

                <div class="x_content">

                  <br />

                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="addcomboproduct.php" method="post">
                      
                    		<table id="datatable-brand" class="table table-striped table-bordered">
                                <thead>
                                  <tr class="headings">
                                    <th>Sl no:</th>
                                    <th>Sku</th>
                                    <th>From Warehouse</th>
                                    <th>From Rack</th>
                                    <th>Wholeseller</th>
                                    <th>Comment</th>
                                    <th>Stock Quantity</th>
                                    <!--<th>Status</th>-->
                                    <?php if((in_array("7",$permission1))) { ?><th>Action</th><?php } ?>
                                  </tr>
                                </thead>
                    <tbody>
                        	
                                        	
                <?php
                    
    	    $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_stock_transfer_wholeseller");
    	    if(mysqli_num_rows($sqlQuery1)>0)
    	    {
    	        $sl=1;
    	        while($record=mysqli_fetch_object($sqlQuery1))
    	        { ?>
    	            <tr>
                          
                            <td><?=$sl; ?></td>
                            <td><?php $sqlsku=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_sku WHERE id='".$record->sku."'")); echo $sqlsku->name;?></td>
                            <td><?php $sqlsku=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_warehouse WHERE id='".$record->from_warehouse."'")); echo $sqlsku->name; ?></td>
                            <td><?php $sqlsku=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_rack WHERE id='".$record->from_rack."'")); echo $sqlsku->name; ?></td>
                            <td><?=$record->ws_name?></td>
                            <td><?=$record->comment?></td>
                            <td><?=$record->stock_quant?></td>
                            <!--<td><?php if($record->status==0) { echo "Unapproved"; } else { echo "Approved"; }?></td>-->
                            <?php if((in_array("7",$permission1))) { ?><td>
                                <?php 
                                    if($record->status==0) 
                                    { ?>
                                        <a class="btn btn-link btn-xs" href="approve_stock_transfer.php?new_stock_id=<?=$record->id?>&id=<?=$record->product_to_warehouse_id?>&status=2"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>Approve</a> 
                                        <?php 
                                        }
                                        else 
                                        { ?> 
                                            <a class="btn btn-link btn-xs"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>Approved</a> 
                                        <?php 
                                        } ?>
                            </td><?php } ?>
    	        <?php
    	        $sl++;
    	        }?>
    	        </tbody></table>
    	    <?php
    	        
    	   } ?>
                  </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- /page content -->
        <!-- footer content -->
        <?php include('include/footer.php'); ?>
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
          
    <script>  
        $(document).ready(function(){  
            var id=1;
            $("#add_row").on("click", function(){  
             id=id+1;
             //alert(id);
                $("#dyn_div").append("<div class='col-md-12 col-sm-12 col-xs-12' id='d1"+id+"'><div class='col-md-3 col-sm-3 col-xs-8'><select class='form-control' name='product_id[]' id='product_id' onchange='get_price(this.value,"+id+")' required><option value=''>Select Product</option><?php $sqlselect=mysqli_query($db_handle,'SELECT * FROM tbl_products WHERE quantity!=0 ORDER BY id ASC'); while($record=mysqli_fetch_object($sqlselect)) { ?><option value='<?php echo $record->id; ?>' ><?php echo $record->name; } ?></option></select></div><input type='hidden' name='unit_price[]' id='unit_price"+id+"' required='required' value=''><div class='col-md-3 col-sm-3 col-xs-8' ><input type='text' id='quantity"+id+"' name='quantity[]' placeholder='Quantity' onkeyup='get_total("+id+")' required='required' class='form-control col-md-7 col-xs-12'></div><div class='col-md-3 col-sm-3 col-xs-8' ><input type='text' id='total_price"+id+"' placeholder='Total Price' name='total_price[]' required='required' class='form-control col-md-7 col-xs-12'></div><div class='col-md-3 col-sm-3 col-xs-8' ><button type='button' id='remove' onclick='delete_row("+id+")' class='btn btn-danger'><span class='glyphicon glyphicon-minus-sign' aria-hidden='true'></span>Delete Row</button></div></div>");
  
            });
        });  
    </script>
    
    <script>
        function get_stock_list(type)
        {
            
            // alert(sku_id);
            $.ajax({
                
                type: "POST",
                  url: "ajax_get_stock_list.php",
                  data: {type : type },

                  beforeSend: function() {
                    $('#loadgif').html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');
                  },
                  complete: function() {
                    $('#loadgif').html('<i style="display:none" class="fa fa-refresh"></i>');
                  },
                                      
                  success: function (response) {
                              //remove disabled from province and change the options
                            //   $('select[name="rack_id"]').prop("disabled", false);
                            //   $('select[name="rack_id"]').html(response);
                            $('#dyn_div').html(response);
                  }
            });
        }
        
        
    </script>
    
    <!--<script>-->
    <!--    function delete_row(id)-->
    <!--    {-->
    <!--alert(id);-->
    <!--        $('#d1'+id).remove();-->
    <!--    }-->
    <!--</script>-->
    
          <script>
            $('select[name="warehouse_id"]').on('change', function() {
              var warehouseId = $(this).val();
              //alert (warehouseId);
              $.ajax({
                  type: "POST",
                  url: "ajax_get_rack.php",
                  data: {warehouse : warehouseId },

                  beforeSend: function() {
                    $('#loadgif').html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');
                  },
                  complete: function() {
                    $('#loadgif').html('<i style="display:none" class="fa fa-refresh"></i>');
                  },
                                      
                  success: function (response) {
                              //remove disabled from province and change the options
                              $('select[name="rack_id"]').prop("disabled", false);
                              $('select[name="rack_id"]').html(response);                          
                  }
              });
          });
          </script>
          
          <script>
          //$( '#dyn_div' ).on( 'change', '#product_id', function () {
            //$('select[name="product_id[]"]').on('change', function() {
            function get_price(productId,id){
              $.ajax({
                  type: "POST",
                  url: "ajax_get_price.php",
                  data: {product : productId },
                                      
                  success: function (data) {

                            $('#unit_price'+id).val(data);
                            
                  }
              });
            }
          //});
          </script>
          <script>  
            $(document).ready(function(){
              $(document).on("click", ".window", function() {
                var id=$(this).attr("id");
                var sku=$('#sku_id').val();
                var type=$('#type').val();
                // alert(sku);
                // alert(id);
            	$.fancybox({
                     href : 'transaction_window.php?id='+id+'&sku='+sku+'&type='+type
            
                  }, {
                      type: 'iframe'
                  });
              });
            });
        </script>


          <script>
            
            function get_total(id)
            {
              var quantity=document.getElementById('quantity'+id).value;
              var unit_price=document.getElementById('unit_price'+id).value;
              //var total_price=document.getElementById('total_price').value;
              if(quantity!='')
              {
                var total_price=parseFloat(quantity*unit_price).toFixed(2);
                document.getElementById('total_price'+id).value=total_price;
              }
              else
              {
                document.getElementById('total_price'+id).value=0; 
              }
            }

          </script>
