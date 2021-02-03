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
        <?php
           if (!(in_array("2",$permission1))) { 
                echo "<script>alert('You donot have access to open this page')</script>";
          ?>
        </div>
        </div>
        </div>
        
        <?php
        } else { ?>
        <div class=""> 

          <div class="page-title">

            <div class="title_left">

              <h3>Add Racks</h3>

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

                  <h2>Add <small>Racks</small></h2>

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

                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="addrack.php" method="post">



                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Rack_name">Rack Name <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="rack_name" name="rack_name" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <!-- <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Barcode_no">Barcode No: <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="barcode_no" name="barcode_no" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div> -->
                    

                    <!-- <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="warehouse_description">Warehouse Description <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea id="address" class="form-control col-md-7 col-xs-12"  name="warehouse_description"></textarea>
                      </div>
                    </div> -->

                    <!-- <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand_name">Dimension <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="brand_name" name="brand_name" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div> -->

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="warehouse">Select Warehouse <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="warehouse_id" id="warehouse_id"  required>
                           <option value="">Select warehouse</option>
                                      <?php 
                                      $sqlselect=mysqli_query($db_handle,"SELECT * FROM tbl_warehouse WHERE status=1 AND flag='1' ORDER BY id ASC"); while($record=mysqli_fetch_object($sqlselect)) { ?><option value="<?php echo $record->id; ?>" ><?php echo $record->name; ?>
                                        
                            </option>
                            <?php }  ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand_name">Status <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <label class="switch">
                          <input type="checkbox" name="status_check" id="status" value="1" checked>
                          <span class="slider round"></span>
                        </label>
                      </div>
                    </div>

                    <div class="ln_solid"></div>

                    <div class="form-group">

                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                      	<button type="submit" class="btn btn-success"  name="add">Submit</button>

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


        </body>
</html>