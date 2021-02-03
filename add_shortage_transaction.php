<?php include('include/header_top.php'); ?>

<style>
    #d1{
        margin: 24px 0 0 0px;
        background: #fff;
        position: absolute;
        z-index: 999;
        width: 96%;
        border: solid 1px #ddd;
    }
   #d1 ul li a {
    padding: 8px 10px;
    display: block;
    color: #999;
   }
   #d1 a{
       text-decoration: none;
   }
   #d1 ul {
    list-style: none;
    padding: 0;
    background: #fff;
    margin: 0;
    border: solid 1px #ddd;
   }
</style>

<!--<style>-->
<!--    .search_holder{ width:431px; float:left; background:#fff; border:solid 1px #dddddd; border-radius:100px 100px 100px 100px; padding:4px 10px; margin:22px 0 0 146px;}-->
<!--    .search{ float:left; width:84%; float:left;}-->
<!--    .search input[type="text"]{ width:100%; border:none; background:none; padding:8px 0; }-->
<!--    .sub{ width:12%; float:right; border-left:solid 1px #dddddd;padding: 5px 0;}-->

<!--</style>-->

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
      <div class="right_col" role="main"><?php
           if (!(in_array("16",$permission1))) { 
                echo "<script>alert('You donot have access to open this page')</script>";
          ?>
        </div>
        </div>
        </div>
        
        <?php } else { ?>

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
                   <a href="shortage_transaction.php" class="btn btn-info btn-s" style="float:right;"><i class="fa fa-history"></i> Back to list</a>
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

                  <h2>Add <small>Transaction</small></h2>

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

                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="addShortageTransaction.php" method="post">



                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand_name">SKU <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="sku" name="sku" required="required" class="form-control col-md-7 col-xs-12" autocomplete="off" onkeyup="search_sku()">
                        <input type="hidden" id="sku_id" name="sku_id" value=''>
                        <div class="search" id="d1" style="display:none"></div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="warehouse">Source Warehouse <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="warehouse_id" id="warehouse_id" disabled=''  required>
                           <option value="">Select warehouse</option>
                                      
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rack">Source Rack<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="ptw_id" id="ptw_id" disabled="" required>
                           <option value="">Select Rack</option>
                           <!-- <option id="opt"></option>-->
                        </select>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="warehouse">Select Warehouse <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="warehouse_id1" id="warehouse_id1"  required>
                           <option value="">Select warehouse</option>
                           <option value="6">Scrap warehouse</option>
                                      
                        </select>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rack">Destination Rack<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="rack_id" id="rack_id" required>
                           <option value="">Select Rack</option>
                           <option value="8">Scrap Rack</option>
                           <!-- <option id="opt"></option>-->
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand_name">Quantity <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" min="0" id="quantity" name="quantity" required="required" class="form-control col-md-7 col-xs-12">
                        <input type="hidden" id="quant" value=''>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand_name">Unit Price <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="unit_price" required="required" class="form-control col-md-7 col-xs-12" placeholder="Unit Price" readonly>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand_name">Condition <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="condition" required="required" class="form-control col-md-7 col-xs-12" placeholder="Condition" readonly>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand_name">Reason <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="reason" name="reason" required="required" class="form-control col-md-7 col-xs-12" placeholder="Reason for shortage">
                      </div>
                    </div>

                    <div class="ln_solid"></div>

                    <div class="form-group">

                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                      	<button type="submit" class="btn btn-success"  name="add">Submit</button>

                        <!--<button type="reset" class="btn btn-primary">Cancel</button> -->
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        <!-- /page content -->
        <?php include('include/footer.php'); } ?>
        </body>
        
        <script>
            function search_sku()
            {
                var type=1;
                var sku=document.getElementById('sku').value;
                if(sku!='')
                {
                    $.ajax({
                       
                        type: 'POST',
                        url: 'ajax_sku_search.php',
                        data: {'sku':sku,'type':type},
                        success: function(data)
                        {
                            $('#d1').show();
                            $('#d1').prop("disabled",false);
                            $('#d1').html(data);  
                        }    
                        
                    });
                }
                else
                {
                    $('#d1').prop("disabled",true);
                }
            }
        </script>
        <script>
            $('select[name="warehouse_id"]').on('change', function() {
              var warehouseId = $(this).val();
              var sku = document.getElementById('sku_id').value;
              //alert (warehouseId);
              $.ajax({
                  type: "POST",
                  url: "ajax_get_assigned_rack1.php",
                  data: {warehouse : warehouseId, sku : sku },

                  beforeSend: function() {
                    $('#loadgif').html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');
                  },
                  complete: function() {
                    $('#loadgif').html('<i style="display:none" class="fa fa-refresh"></i>');
                  },
                                      
                  success: function (data) {
                              //remove disabled from province and change the options
                              $('select[name="ptw_id"]').prop("disabled", false);
                              $('select[name="ptw_id"]').html(data);                          
                  }
              });
          });
          
          
          </script>
          
          <script>
            $('select[name="ptw_id"]').on('change', function() {
              var id = $(this).val();
            //   alert (id);
              $.ajax({
                  type: "POST",
                  url: "ajax_get_detail.php",
                  data: {id : id},

                  beforeSend: function() {
                    $('#loadgif').html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');
                  },
                  complete: function() {
                    $('#loadgif').html('<i style="display:none" class="fa fa-refresh"></i>');
                  },
                                      
                  success: function (data) {
                              //remove disabled from province and change the options
                              document.getElementById('unit_price').value=data['unit'];
                              document.getElementById('condition').value=data['status'];
                              
                            //   $('#unit_price').html(data['unit']);
                            //   $('#condition').html(data['status']);                          
                  }
              });
          });
          </script>
          
        </script>
        
        
</html>