<?php

    session_start();

  if(@$_SESSION['valid_admin'] == "" )
  {
      @header("Location:login.php");
  }

  include_once("include/inc.php");
  if(isset($_POST["edit"]))
  {
    $sqlupdate = mysqli_query($db_handle,"UPDATE tbl_products SET name='".mysqli_real_escape_string($db_handle,$_REQUEST['name'])."',warehouse_id='".mysqli_real_escape_string($db_handle,$_REQUEST['warehouse_id'])."',rack_id='".mysqli_real_escape_string($db_handle,$_REQUEST['rack_id'])."',sku='".mysqli_real_escape_string($db_handle,$_REQUEST['sku'])."',colour_id='".mysqli_real_escape_string($db_handle,$_REQUEST['colour'])."',unit_price='".mysqli_real_escape_string($db_handle,$_REQUEST['unit_price'])."',quantity='".mysqli_real_escape_string($db_handle,$_REQUEST['quantity'])."',total_price='".mysqli_real_escape_string($db_handle,$_REQUEST['total_price'])."',modification_date=NOW(),modified_by='".$_SESSION['id']."' WHERE id='".$_REQUEST['productid']."'");
    $sqlupdate1 = mysqli_query($db_handle,"UPDATE tbl_sku SET product_id='".mysqli_real_escape_string($db_handle,$_REQUEST['productid'])."' WHERE id='".$_REQUEST['sku']."'");
    if($sqlupdate==true)
    {
        header("location:inward_transaction_list.php?msg=2");
    }
    else
    {
        header("location:inward_transaction_list.php?msg=error");
    }
  }

?>

<?php include('include/header_top.php'); ?>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <?php include('include/leftbar.php'); ?>
      <!-- top navigation -->
      <?php include('include/top_navigation.php'); ?>
      <!-- /top navigation -->
       <!-- page content -->
       
      <?php 
	       $product_id = $_REQUEST['id'];
	       $sqlbranchdata = mysqli_fetch_object(mysqli_query($db_handle,"SELECT * FROM tbl_products WHERE id = '".$product_id."'"));	 
	       ?>
      <div class="right_col" role="main">
          <?php
           if (!(in_array("5",$permission1))) { 
                echo "<script>alert('You donot have access to open this page')</script>";
          ?>
        </div>
        </div>
        </div>
        
        <?php include('include/footer.php'); 
        } else { ?>

        <div class=""> 

          <div class="page-title">

            <div class="title_left">

              <h3>Edit Product</h3>

            </div>
            
            <div class="title_right">

              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

                <div class="input-group">

                  <input type="text" class="form-control" placeholder="Search for...">

                  <span class="input-group-btn">

                            <button class="btn btn-default" type="button">Go!</button>

                        </span>

                </div>

              </div>

            </div>

            <div class="title_right">

              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

               
              </div>
            </div>
          </div>
          <div class="clearfix"></div>

          <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">

              <div class="x_panel">

                <div class="x_title">

                  <h2>Edit <small>Product</small></h2>

                  <ul class="nav navbar-right panel_toolbox">

                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>

                    </li>

                    <li><a class="close-link"><i class="fa fa-close"></i></a>

                    </li>

                  </ul>

                  <div class="clearfix"></div>

                </div>

                <div class="x_content">

                  <br />

                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="edit_product.php" method="post">

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="warehouse">Select Warehouse <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="warehouse_id" id="warehouse_id"  required>
                            <option value="">Select warehouse</option>
                                      <?php 
                                      $sqlselect=mysqli_query($db_handle,"SELECT * FROM tbl_warehouse WHERE status=1 ORDER BY id ASC"); while($record=mysqli_fetch_object($sqlselect)) { ?>
                                      <option value="<?php echo $record->id; ?>" <?php if($sqlbranchdata->warehouse_id==$record->id) { echo "selected='selected'"; }?> ><?php echo $record->name; ?>
                                      </option>
                            <?php }  ?>
                        </select>
                      </div>
                    </div>
                    <input type="hidden" name="productid" value="<?=$_REQUEST['id']?>">    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rack">Select Rack<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="rack_id" id="rack_id" required>
                           <?php 
                                      $sqlselect=mysqli_query($db_handle,"SELECT r.id,r.name FROM tbl_warehouse_to_rack w LEFT JOIN tbl_rack r ON r.id=w.rack_id WHERE w.warehouse_id='".$sqlbranchdata->warehouse_id."'"); while($record=mysqli_fetch_object($sqlselect)) { ?>
                                      <option value="<?php echo $record->id; ?>" <?php if($sqlbranchdata->rack_id==$record->id) { echo "selected='selected'"; }?> ><?php echo $record->name; ?>
                                      </option>
                            <?php }  ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sku">Select SKU<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="sku" id="sku"  required>
                           <option value="">Select sku</option>
                           <?php 
                                      $sqlselect=mysqli_query($db_handle,"SELECT * FROM tbl_sku WHERE status=1 AND (product_id=0 AND combo_product_id=0) ORDER BY id ASC"); while($record=mysqli_fetch_object($sqlselect)) { ?><option value="<?php echo $record->id; ?>" <?php if($record->id==$sqlbranchdata->sku) { echo "selected='selected'"; } ?>><?php echo $record->name; ?>
                                        
                            </option>
                            <?php }  ?>                                                                              
                        </select>
                      </div>
                    </div>
                    <div class="position_loader" id="loadgif"></div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="colour">Select Colour<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="colour" id="colour"  required>
                           <option value="">Select Colour</option>
                           <?php 
                                      $sqlselect=mysqli_query($db_handle,"SELECT * FROM tbl_colour ORDER BY id ASC"); while($record=mysqli_fetch_object($sqlselect)) { ?><option value="<?php echo $record->id; ?>" <?php if($record->id==$sqlbranchdata->colour_id){ echo "selected='selected'";  }?>><?php echo $record->name; ?>
                                        
                            </option>
                            <?php }  ?>                                                                              
                        </select>
                      </div>
                    </div>

                     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="name" name="name" required="required" value="<?=$sqlbranchdata->name?>" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="unit_price">Unit Price <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="unit_price" name="unit_price" value="<?=$sqlbranchdata->unit_price?>" required="required" class="form-control col-md-7 col-xs-12" onkeyup="get_total1()">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="unit_price">Quantity <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="quantity" name="quantity" value="<?=$sqlbranchdata->quantity?>"  required="required" class="form-control col-md-7 col-xs-12" onkeyup="get_total()">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="total_price">Total Price <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="total_price" name="total_price" value="<?=$sqlbranchdata->total_price?>"  required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                   <!--  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand_name">Status <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <label class="switch">
                          <input type="checkbox" name="status_check" id="status" value="1" checked>
                          <span class="slider round"></span>
                        </label>
                      </div>
                    </div> -->

                    <div class="ln_solid"></div>

                    <div class="form-group">

                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                      	<button type="submit" class="btn btn-success" name="edit">Submit</button>

                        <button type="reset" class="btn btn-primary">Cancel</button>                        
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        <!-- /page content -->
        <!-- footer content -->
        <?php include('include/footer.php'); } ?>
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
                                      
                  success: function (data) {
                              //$('select[name="rack_id"]').prop("disabled", false);
                              $('select[name="rack_id"]').html(data);                          
                  }
              });
          });
          </script>

          <script>
            
            function get_total()
            {
              var quantity=document.getElementById('quantity').value;
              var unit_price=document.getElementById('unit_price').value;
              //var total_price=document.getElementById('total_price').value;
              if(unit_price!='')
              {
                var total_price=parseFloat(quantity*unit_price);
                document.getElementById('total_price').value=total_price.toFixed(2);
              }
              else
              {
                document.getElementById('total_price').value=0; 
              }
            }

            function get_total1()
            {
              var quantity=document.getElementById('quantity').value;
              var unit_price=document.getElementById('unit_price').value;
              //var total_price=document.getElementById('total_price').value;
              if(quantity!='')
              {
                var total_price=parseFloat(quantity*unit_price);
                document.getElementById('total_price').value=total_price;
              }
              else
              {
                document.getElementById('total_price').value=unit_price; 
              }
            }

          </script>

        </body>
</html>