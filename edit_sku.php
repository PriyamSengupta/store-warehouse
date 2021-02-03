<?php

    session_start();

  if(@$_SESSION['valid_admin'] == "" )
  {
      @header("Location:login.php");
  }

  include_once("include/inc.php");
  if(isset($_POST["edit"]))
  {

    $sqlupdate = mysqli_query($db_handle,"UPDATE tbl_sku SET name='".mysqli_real_escape_string($db_handle,$_REQUEST['sku_name'])."',status='".mysqli_real_escape_string($db_handle,$_REQUEST['status_check'])."',description='".mysqli_real_escape_string($db_handle,$_REQUEST['description'])."',colour='".mysqli_real_escape_string($db_handle,$_REQUEST['colour'])."',modification_date=NOW(),modified_by='".$_SESSION['id']."' WHERE id = '".$_REQUEST['sku_id']."'");

    header("location:sku_list.php?msg=2");
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

	       $sku_id = $_REQUEST['id'];

	       $sqlbranchdata = mysqli_fetch_object(mysqli_query($db_handle,"SELECT * FROM tbl_sku WHERE id = '".$sku_id."'"));	 

	       ?>

      <div class="right_col" role="main">
          <?php
           if (!(in_array("3",$permission1))) { 
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

              <h3>Edit SKU</h3>

            </div>

            <div class="title_right">

              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

                <div class="input-group">

                </div>

              </div>

            </div>

          </div>

          <div class="clearfix"></div>

          <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">

              <div class="x_panel">
                <div class="x_title">
                  <h2>Edit <small>SKU</small></h2>
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

                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="edit_sku.php" method="post" onsubmit="return check_availabilty();">

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand_name">SKU Name <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="sku_name" name="sku_name" value="<?php echo $sqlbranchdata->name; ?>" class="form-control col-md-7 col-xs-12">
                      </div>
                      <!-- <button type="button" class="btn btn-success btn-xs">Check availability</button> -->
                    </div>
                    <center><div class="form-group" id="check_sku"></div></center>
                    <input type="hidden" name="sku_id" id="sku_id" value="<?php echo $_REQUEST['id']; ?>" />
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea name="description" class="form-control col-md-7 col-xs-12"><?php echo $sqlbranchdata->description; ?></textarea>
                      </div>
                    </div>
                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="colour">Colour</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="colour" name="colour" value="<?php echo $sqlbranchdata->colour; ?>" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand_name">Status <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <label class="switch">
                          <input type="checkbox" name="status_check" id="status" <?php if($sqlbranchdata->status==1) { ?> value="1" checked <?php } else { ?> value="0" <?php } ?>>
                          <span class="slider round"></span>
                        </label>
                      </div>
                    </div>
                    
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
          <script>

          function backpage(){

					 window.location.href='sku_list.php';

					}
          </script>
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
            function check_availabilty()
            {
              var call=false;
                  if (call) {
                  return;
              }
              var check_name=document.getElementById('sku_name').value;
              var sku_id=document.getElementById('sku_id').value;
              if (check_name=='') 
              {
                document.getElementById('check_sku').innerHTML="*This field is required";
                return false;                
              }
              else
              {
                $.ajax({
                   type: 'POST',
                    url: 'check_sku.php',
                    data: {'name':check_name,'id':sku_id},
                    async:false,
                    dataType: "html",
                    beforeSend: function() 
                    {
                        $('#loadgif').html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');
                    },
                    complete: function() 
                    {
                        $('#loadgif').html('<i style="display:none" class="fa fa-refresh"></i>');
                    },
                   success: function(data)
                   {
                      if(data=='false')
                      {                        
                          document.getElementById('check_sku').innerHTML="*SKU already exists";
                          //$(':input[name="add"]').prop('disabled', true);
                          call=false;
                      }
                      else
                      {
                          //document.getElementById('check_sku').innerHTML="*SKU is available";
                          $(':input[name="add"]').prop('disabled', false);
                          call=true;             
                      }
                    }
                });
                return call;
              }
            }
          </script>

        <!-- /page content -->
        <!-- footer content -->
        <?php include('include/footer.php'); ?>
        </body>
</html>