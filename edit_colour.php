<?php

    session_start();

  if(@$_SESSION['valid_admin'] == "" )
  {
      @header("Location:login.php");
  }

  include_once("include/inc.php");
  if(isset($_POST["edit"]))
  {

    $sqlupdate = mysqli_query($db_handle,"UPDATE tbl_colour SET name='".mysqli_real_escape_string($db_handle,$_REQUEST['colour_name'])."',modification_date=NOW(),modified_by='".$_SESSION['id']."' WHERE id = '".$_REQUEST['colour_id']."'");

    header("location:colour_list.php?msg=2");
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

         $colour_id = $_REQUEST['id'];

         $sqlbranchdata = mysqli_fetch_object(mysqli_query($db_handle,"SELECT * FROM tbl_colour WHERE id = '".$colour_id."'"));  

        ?>


      <div class="right_col" role="main">

        <div class=""> 

          <div class="page-title">

            <div class="title_left">

              <h3>Edit Colour</h3>

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

          </div>
          </div>
          <div class="clearfix"></div>

          <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">

              <div class="x_panel">

                <div class="x_title">

                  <h2>Edit <small>Colour</small></h2>

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

                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="edit_colour.php" method="post">

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="colour_name">Name <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="colour_name" name="colour_name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $sqlbranchdata->name; ?>">
                      </div>                  
                    </div>
                    <input type="hidden" name="colour_id" value="<?php echo $_REQUEST['id']; ?>" />
                    <div class="position_loader" id="loadgif"></div>                     
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
        <!-- /page content -->
        <!-- footer content -->
        <?php include('include/footer.php'); ?>

        <script>

            function backpage(){

           window.location.href='colour_list.php';

          }
        </script>
        </body>
</html>