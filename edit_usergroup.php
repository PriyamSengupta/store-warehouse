<?php

    session_start();

  if(@$_SESSION['valid_admin'] == "" )
  {
      @header("Location:login.php");
  }

  include_once("include/inc.php");
  if(isset($_POST["edit"]))
  {
    //   print_r($_POST);
     $usergroup=$_REQUEST['usergroup_id']; 
     $access_role=implode(',',$_REQUEST['access_permission']);
     $modify_role=implode(',',$_REQUEST['modify_permission']);
    // echo $access_role."<br>".$modify_role;
    
     $sqlupdate=mysqli_query($db_handle,"UPDATE tbl_usergroup SET name='".mysqli_real_escape_string($db_handle,$_REQUEST['name'])."',status='".mysqli_real_escape_string($db_handle,$_REQUEST['status_check'])."',access_permission='".$access_role."',modify_permission='".$modify_role."',modification_date=NOW(),modified_by='".$_SESSION['id']."' WHERE id='".$usergroup."'");
    header("location:usergroup_list.php?msg=2");
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

	       $usergroup_id = $_REQUEST['id'];
	       $sqlusergroupdata = mysqli_fetch_object(mysqli_query($db_handle,"SELECT * FROM tbl_usergroup WHERE id = '".$usergroup_id."'"));
	       $access_permission=$sqlusergroupdata->access_permission;
		   $modify_permission=$sqlusergroupdata->modify_permission;
		   $permission2=explode(",",$access_permission);
		   $permission3=explode(",",$modify_permission);
       ?>
       
      <div class="right_col" role="main">
          
          <?php
           if (!(in_array("9",$permission1))) { 
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

              <h3>Edit User</h3>

            </div>

            <div class="title_right">

              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

                <!--<div class="input-group">

                  <input type="text" class="form-control" placeholder="Search for...">

                  <span class="input-group-btn">

                            <button class="btn btn-default" type="button">Go!</button>

                        </span>

                </div>-->

              </div>
            </div>
          </div>
          <div class="clearfix"></div>

          <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">

              <div class="x_panel">

                <div class="x_title">

                  <h2>Edit <small>usergroup</small></h2>

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

                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="edit_usergroup.php" method="post">

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">User Name <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="name" id="name" value="<?=$sqlusergroupdata->name?>" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <input type="hidden" name="usergroup_id" value="<?=$sqlusergroupdata->id?>">
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand_name">Access Permission <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12" style="overflow: auto;height: 250px; border: 1px solid #ccc !important;">
                          <div class="x_content">

                                        <div class="">
                                         
                                        <p><b>Master/</b>&nbsp;&nbsp;
                                        
                                    <!--    <a onclick="$('#chk').prop('checked', $(this).prop('checked'));">Select All</a>-->
                    	              	<!--	/-->
                  	              		 <!--<a onclick="$('#chk').prop('checked', false);">Unselect All</a></p>    -->
                                          <ul class="to_do">
                                            <li>
                                              <p>
                                                <input type="checkbox" id="chk" class="flat" value="1" name="access_permission[]" <?php if(in_array("1",$permission2)){ echo "checked='checked'"; } ?>>Warehouse Management</p>
                                            </li>
                                            <li>
                                              <p>
                                                <input type="checkbox" id="chk" class="flat" value="2" name="access_permission[]" <?php if(in_array("2",$permission2)){ echo "checked='checked'"; } ?>>Rack Management</p>
                                            </li>
                                            <li>
                                              <p>
                                                <input type="checkbox" id="chk" class="flat" value="3" name="access_permission[]" <?php if(in_array("3",$permission2)){ echo "checked='checked'"; } ?>>SKU Management</p>
                                            </li>
                                          </ul>
                                          
                                          <p><b>Order/</b></p>
                                          <ul class="to_do">
                                              <li>
                                                  <p>
                                                    <input type="checkbox" class="flat" value="14" name="access_permission[]" <?php if(in_array("14",$permission2)){ echo "checked='checked'"; } ?>>Create Order</p>
                                                </li>
                                                <li>
                                                  <p>
                                                    <input type="checkbox" class="flat" value="15" name="access_permission[]" <?php if(in_array("15",$permission2)){ echo "checked='checked'"; } ?>>Today's Order</p>
                                                </li>
                                                
                                                <li>
                                                  <p>
                                                    <input type="checkbox" class="flat" value="20" name="access_permission[]" <?php if(in_array("20",$permission2)){ echo "checked='checked'"; } ?>>Process Order</p>
                                                </li>
                                          </ul>
                                          
                                          <p><b>Transaction Management/</b></p>
                                          <ul class="to_do">
                                              <li>
                                                  <p>
                                                    <input type="checkbox" class="flat" value="4" name="access_permission[]" <?php if(in_array("4",$permission2)){ echo "checked='checked'"; } ?>>Pre-packing</p>
                                                </li>
                                                <li>
                                                  <p>
                                                    <input type="checkbox" class="flat" value="5" name="access_permission[]" <?php if(in_array("5",$permission2)){ echo "checked='checked'"; } ?>>Goods Inward</p>
                                                </li>
                                                <!--<li>
                                                  <p>
                                                    <input type="checkbox" class="flat" value="6" name="access_permission[]" <?php if(in_array("6",$permission2)){ echo "checked='checked'"; } ?>>Goods Outward</p>
                                                </li>-->
                                                <li>
                                                  <p>
                                                    <input type="checkbox" class="flat" value="13" name="access_permission[]" <?php if(in_array("13",$permission2)){ echo "checked='checked'"; } ?>>Inter-warehouse Transaction</p>
                                                </li>
                                                <li>
                                                  <p>
                                                    <input type="checkbox" class="flat" value="16" name="access_permission[]" <?php if(in_array("16",$permission2)){ echo "checked='checked'"; } ?>>Shortage Transaction</p>
                                                </li>
                                                <li>
                                                  <p>
                                                    <input type="checkbox" class="flat" value="7" name="access_permission[]" <?php if(in_array("7",$permission2)){ echo "checked='checked'"; } ?>>Returned Transaction</p>
                                                </li>
                                                <li>
                                                  <p>
                                                    <input type="checkbox" class="flat" value="8" name="access_permission[]" <?php if(in_array("8",$permission2)){ echo "checked='checked'"; } ?>>Damaged Area</p>
                                                </li>
                                            </ul>    
                                          <p><b>User Management/</b></p>
                                          <ul class="to_do">
                                              <li>
                                                  <p>
                                                    <input type="checkbox" class="flat" value="9" name="access_permission[]" <?php if(in_array("9",$permission2)){ echo "checked='checked'"; } ?>>User List</p>
                                                </li>
                                                <li>
                                                  <p>
                                                    <input type="checkbox" class="flat" value="10" name="access_permission[]" <?php if(in_array("10",$permission2)){ echo "checked='checked'"; } ?>>Add user</p>
                                                </li>    
                                          </ul>
                                          
                                          <p><b>Reports/</b></p>
                                          <ul class="to_do">
                                              <li>
                                                  <p>
                                                    <input type="checkbox" class="flat" value="12" name="access_permission[]" <?php if(in_array("12",$permission2)){ echo "checked='checked'"; } ?>>Reports</p>
                                                </li>
                                                
                                                <li>
                                                  <p>
                                                    <input type="checkbox" class="flat" value="17" name="access_permission[]" <?php if(in_array("17",$permission2)){ echo "checked='checked'"; } ?>>Stock Report</p>
                                                </li>
                                                
                                                <li>
                                                  <p>
                                                    <input type="checkbox" class="flat" value="21" name="access_permission[]" <?php if(in_array("21",$permission2)){ echo "checked='checked'"; } ?>>View Price</p>
                                                </li>
                       
                                          </ul>
                                          
                                          <p><b>Stock Adjustment/</b></p>
                                          <ul class="to_do">
                                              <li>
                                                  <p>
                                                    <input type="checkbox" class="flat" value="18" name="access_permission[]" <?php if(in_array("18",$permission2)){ echo "checked='checked'"; } ?>>Inward Adjustment</p>
                                                </li>
                                                
                                                <li>
                                                  <p>
                                                    <input type="checkbox" class="flat" value="19" name="access_permission[]" <?php if(in_array("19",$permission2)){ echo "checked='checked'"; } ?>>Outward Adjustment</p>
                                                </li>
                       
                                          </ul>
                                          
                                        </div>
                                        
                                      </div>
                                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand_name">Modify Permission <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12" style="overflow: auto;height: 250px; border: 1px solid #ccc !important;">
                          <div class="x_content">

                                        <div class="">
                                         
                                        <p><b>Master/</b>&nbsp;&nbsp;
                                        
                                    <!--    <a onclick="$('#chk').prop('checked', $(this).prop('checked'));">Select All</a>-->
                    	              	<!--	/-->
                  	              		 <!--<a onclick="$('#chk').prop('checked', false);">Unselect All</a></p>    -->
                                          <ul class="to_do">
                                            <li>
                                              <p>
                                                <input type="checkbox" id="chk" class="flat" value="1" name="modify_permission[]" <?php if(in_array("1",$permission3)){ echo "checked='checked'"; } ?>>Warehouse Management</p>
                                            </li>
                                            <li>
                                              <p>
                                                <input type="checkbox" id="chk" class="flat" value="2" name="modify_permission[]" <?php if(in_array("2",$permission3)){ echo "checked='checked'"; } ?>>Rack Management</p>
                                            </li>
                                            <li>
                                              <p>
                                                <input type="checkbox" id="chk" class="flat" value="3" name="modify_permission[]" <?php if(in_array("3",$permission3)){ echo "checked='checked'"; } ?>>SKU Management</p>
                                            </li>
                                          </ul>
                                          
                                          <p><b>Order/</b></p>
                                          <ul class="to_do">
                                              <li>
                                                  <p>
                                                    <input type="checkbox" class="flat" value="14" name="modify_permission[]" <?php if(in_array("14",$permission3)){ echo "checked='checked'"; } ?>>Create Order</p>
                                                </li>
                                                <li>
                                                  <p>
                                                    <input type="checkbox" class="flat" value="15" name="modify_permission[]" <?php if(in_array("15",$permission3)){ echo "checked='checked'"; } ?>>Today's Order</p>
                                                </li>
                                                
                                                <!--<li>-->
                                                <!--  <p>-->
                                                <!--    <input type="checkbox" class="flat" value="20" name="modify_permission[]" <?php if(in_array("20",$permission3)){ echo "checked='checked'"; } ?>>Process Order</p>-->
                                                <!--</li>-->
                                          </ul>
                                          
                                          <p><b>Transaction Management/</b></p>
                                          <ul class="to_do">
                                              <li>
                                                  <p>
                                                    <input type="checkbox" class="flat" value="4" name="modify_permission[]" <?php if(in_array("4",$permission3)){ echo "checked='checked'"; } ?>>Pre-packing</p>
                                                </li>
                                                <li>
                                                  <p>
                                                    <input type="checkbox" class="flat" value="5" name="modify_permission[]" <?php if(in_array("5",$permission3)){ echo "checked='checked'"; } ?>>Goods Inward</p>
                                                </li>
                                                <!--<li>
                                                  <p>
                                                    <input type="checkbox" class="flat" value="6" name="modify_permission[]" <?php if(in_array("6",$permission1)){ echo "checked='checked'"; } ?>>Goods Outward</p>
                                                </li>-->
                                                <li>
                                                  <p>
                                                    <input type="checkbox" class="flat" value="13" name="modify_permission[]" <?php if(in_array("13",$permission3)){ echo "checked='checked'"; } ?>>Inter-warehouse Transaction</p>
                                                </li>
                                                <li>
                                                  <p>
                                                    <input type="checkbox" class="flat" value="16" name="modify_permission[]" <?php if(in_array("16",$permission3)){ echo "checked='checked'"; } ?>>Shortage Transaction</p>
                                                </li>
                                                <li>
                                                  <p>
                                                    <input type="checkbox" class="flat" value="11" name="modify_permission[]" <?php if(in_array("11",$permission3)){ echo "checked='checked'"; } ?>>Approve Transaction</p>
                                                </li>
                                                <li>
                                                  <p>
                                                    <input type="checkbox" class="flat" value="7" name="modify_permission[]" <?php if(in_array("7",$permission3)){ echo "checked='checked'"; } ?>>Returned Transaction</p>
                                                </li>
                                                <li>
                                                  <p>
                                                    <input type="checkbox" class="flat" value="8" name="modify_permission[]" <?php if(in_array("8",$permission3)){ echo "checked='checked'"; } ?>>Damaged Area</p>
                                                </li>
                                            </ul>    
                                          <p><b>User Management/</b></p>
                                          <ul class="to_do">
                                              <li>
                                                  <p>
                                                    <input type="checkbox" class="flat" value="9" name="modify_permission[]" <?php if(in_array("9",$permission3)){ echo "checked='checked'"; } ?>>Usergroup</p>
                                                </li>
                                                <li>
                                                  <p>
                                                    <input type="checkbox" class="flat" value="10" name="modify_permission[]" <?php if(in_array("10",$permission3)){ echo "checked='checked'"; } ?>>User list</p>
                                                </li>    
                                          </ul>
                                          
                                          <p><b>Reports/</b></p>
                                          <ul class="to_do">
                                              <li>
                                                  <p>
                                                    <input type="checkbox" class="flat" value="12" name="modify_permission[]" <?php if(in_array("12",$permission3)){ echo "checked='checked'"; } ?>>Reports</p>
                                                </li>
                                                
                                                <li>
                                                  <p>
                                                    <input type="checkbox" class="flat" value="17" name="modify_permission[]" <?php if(in_array("17",$permission3)){ echo "checked='checked'"; } ?>>Stock Report</p>
                                                </li>
                       
                                          </ul>
                                          
                                          <p><b>Stock Adjustment/</b></p>
                                          <ul class="to_do">
                                              <li>
                                                  <p>
                                                    <input type="checkbox" class="flat" value="18" name="modify_permission[]" <?php if(in_array("18",$permission3)){ echo "checked='checked'"; } ?>>Inward Adjustment</p>
                                                </li>
                                                
                                                <li>
                                                  <p>
                                                    <input type="checkbox" class="flat" value="19" name="modify_permission[]" <?php if(in_array("19",$permission3)){ echo "checked='checked'"; } ?>>Outward Adjustment</p>
                                                </li>
                       
                                          </ul>
                                          
                                        </div>
                                        
                                      </div>
                                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">Status <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <label class="switch">
                          <input type="checkbox" name="status_check" id="status" <?php if($sqlusergroupdata->status==1) { ?> value="1" checked <?php } else { ?> value="0" <?php } ?>>
                          <span class="slider round"></span>
                        </label>
                      </div>
                    </div>
                    
                    <!-- <input type="hidden" name="status" value=""> -->
                    <div class="position_loader" id="loadgif"></div>                     
                    <div class="ln_solid"></div>

                    <div class="form-group">

                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                      	<button type="submit" class="btn btn-success" id="edit" name="edit">Submit</button>

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
            function check_availabilty()
            {
              var sku_id=0;
              var check_name=document.getElementById('sku_name').value;
              if (check_name=='') 
              {
                document.getElementById('check_sku').innerHTML="*This field is required";                
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
                          //call=false;
                      }
                      else
                      {
                          document.getElementById('check_sku').innerHTML="*SKU is available";
                          $(':input[name="add"]').prop('disabled', false);
                          //call=true;             
                      }
                    }
                });
              }
            }
          </script>
        </body>
</html>