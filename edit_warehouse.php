<?php

    session_start();

  if(@$_SESSION['valid_admin'] == "" )
  {
      @header("Location:login.php");
  }

  include_once("include/inc.php");
  if(isset($_POST["edit"]))
  {

    $sqlupdate = mysqli_query($db_handle,"UPDATE tbl_warehouse SET name='".mysqli_real_escape_string($db_handle,$_REQUEST['warehouse_name'])."',description='".mysqli_real_escape_string($db_handle,$_REQUEST['warehouse_description'])."',modification_date=NOW(),last_modified_by='".$_SESSION['id']."' WHERE id = '".$_REQUEST['warehouse_id']."'");

    header("location:warehouse_list.php?msg=2");
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

	       $warehouse_id = $_REQUEST['id'];

	       $sqlbranchdata = mysqli_fetch_object(mysqli_query($db_handle,"SELECT * FROM tbl_warehouse WHERE id = '".$warehouse_id."'"));	 

	       ?>

      <div class="right_col" role="main">
          
              <?php
           if (!(in_array("1",$permission1))) { 
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

              <h3>Edit Warehouse</h3>

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
                  <h2>Edit <small>Warehouse</small></h2>
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

                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="edit_warehouse.php" method="post">



                    <div class="form-group">

                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand_name">Warehouse Name <span class="required">*</span>

                      </label>

                      <div class="col-md-6 col-sm-6 col-xs-12">

                        <input type="text" id="warehouse_name" name="warehouse_name" value="<?php echo $sqlbranchdata->name; ?>" required="required" class="form-control col-md-7 col-xs-12"/>

                        <input type="hidden" name="warehouse_id" value="<?php echo $_REQUEST['id']; ?>" />

                      </div>

                    </div>                    

                    <div class="form-group">

                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="warehouse_description">Warehouse Description <span class="required">*</span>

                      </label>

                      <div class="col-md-6 col-sm-6 col-xs-12">

                        <textarea id="address" class="form-control col-md-7 col-xs-12"  name="warehouse_description"><?php echo $sqlbranchdata->description; ?></textarea>

                      </div>

                    </div>

                    <!-- <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number_of_racks">No of Racks <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" id="number_of_racks" name="number_of_racks" value="<?php echo $sqlbranchdata->racks; ?>" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>  -->                   

                    <div class="ln_solid"></div>

                    <div class="form-group">

                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                      	<button type="submit" class="btn btn-success"  name="edit">Submit</button>
                        <button type="button" class="btn btn-primary" onclick="backpage();">Cancel</button>

                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <script>

          	function backpage(){

					 window.location.href='warehouse_list.php';

					}
          </script>
        <!-- /page content -->
        <!-- footer content -->
        <?php include('include/footer.php'); } ?>
        </body>
</html>