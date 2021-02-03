<?php include('include/header_top.php'); ?>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
     
      <div class="right_col" role="main">

        <div class=""> 

          <div class="page-title">

            <div class="title_left">

              <h3>Add Colour</h3>

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

                  <h2>Add <small>Colour</small></h2>

                  <ul class="nav navbar-right panel_toolbox">

                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>

                    </li>

                    <li><a class="close-link"><i class="fa fa-close"></i></a>

                    </li>

                  </ul>

                  <div class="clearfix"></div>

                </div>

                <div class="x_content">

                  <br/>

                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="addcolour.php" method="post">



                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="colour_name">Name <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="sku_name" name="colour_name" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                      <!-- <button type="button" onclick="check_availabilty();" class="btn btn-success btn-xs">Check availability</button> -->
                    </div>
                    <!-- <center><div class="form-group" id="check_sku"></div></center>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand_name">Status <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <label class="switch">
                          <input type="checkbox" name="status_check" id="status" value="1" checked>
                          <span class="slider round"></span>
                        </label>
                      </div>
                    </div> -->
                    <!-- <input type="hidden" name="status" value=""> -->
                    <div class="position_loader" id="loadgif"></div>                     
                    <div class="ln_solid"></div>

                    <div class="form-group">

                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                      	<button type="submit" class="btn btn-success" id="add" name="add">Submit</button>

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
        </body>
</html>