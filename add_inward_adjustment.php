<?php include('include/header_top.php'); ?>
<style>
    .search{
        margin: 23px 0 0 0px;
        background: #fff;
        position: absolute;
        z-index: 999;
        width: 96%;
        border: solid 1px #ddd;
    }
   .search ul li a {
    padding: 8px 10px;
    display: block;
    color: #999;
   }
   .search a{
       text-decoration: none;
       color: #44444a;
   }
   .search ul {
    list-style: none;
    padding: 0;
    background: #fff;
    margin: 0;
    border: solid 1px #ddd;
   }
</style>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
    <?php include('include/leftbar.php'); ?>
      <!-- top navigation -->
      <?php include('include/top_navigation.php'); ?>
      <!-- /top navigation -->
       <!-- page content -->
    
      <div class="right_col" role="main">
          <?php
               if (!(in_array("18",$permission1))) { 
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

              <h3>Add Inward Adjustment</h3>

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

                  <h2>Add <small>Inward Adjustment</small></h2>

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

                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="addInwardAdjustment.php" method="post">
                      
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sku">SKU <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <!--<input type="text" id="sku" name="sku" required="required" class="form-control col-md-7 col-xs-12" onblur="check_sku()">-->
                        <input type="text" id="s1" name="sku_name" required="required" class="form-control col-md-7 col-xs-12" placeholder="Select SKU" onkeyup="search_sku1()" autocomplete="off">
                        <input type="hidden" id="sku" name="sku" value="">
                          <div class="search" id="div_search" style="display:none"></div>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="warehouse">Select Warehouse <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="warehouse_id" id="warehouse_id" required>
                           <option value="">Select warehouse</option>
                                      <?php 
                                      $sqlselect=mysqli_query($db_handle,"SELECT * FROM tbl_warehouse WHERE status='1' AND flag='1' ORDER BY id ASC"); while($record=mysqli_fetch_object($sqlselect)) { ?><option value="<?php echo $record->id; ?>" ><?php echo $record->name; ?>
                                        
                            </option>
                            <?php }  ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rack">Select Rack<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="rack_id" id="rack_id" disabled="" required>
                           <option value="">Select Rack</option>
                                
                        </select>
                      </div>
                    </div>

                    <div class="position_loader" id="loadgif"></div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="unit_price">Unit Price <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="unit_price" name="unit_price" onkeyup="check_negative()" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="unit_price">Quantity <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" min="0" id="quantity" name="quantity" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Reason">Reason <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea id="reason" class="form-control col-md-7 col-xs-12"  name="reason"></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="unit_price">Condition<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top: 8px;">
                        
                          Good:
                          <input type="radio" class="flat" name="condition" id="genderM" value="1" checked="" required /> Bad:
                          <input type="radio" class="flat" name="condition" id="genderF" value="0" />
                        
                        </div>
                    </div>
                    <div class="ln_solid"></div>

                    <div class="form-group">

                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                      	<button type="submit" id="add" class="btn btn-success" name="add" disabled="">Submit</button>

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
                function check_negative()
                {
                    var unit = parseInt(document.getElementById('unit_price').value);
                    
                    if(unit<0)
                    {
                        alert("Price can't be less than 0");
                        document.getElementById('unit_price').value='';
                    }
                    // alert(unit);
                }
            </script>
          <script>
              function get_product()
              {
                  var sku=document.getElementById('sku').value;
                  //alert(sku);
                  $.ajax({
                      type: "POST",
                      url: "ajax_get_returned_product.php",
                      data: {sku : sku },
                      dataType: "html",
                      beforeSend: function() {
                        $('#loadgif').html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');
                      },
                      complete: function() {
                        $('#loadgif').html('<i style="display:none" class="fa fa-refresh"></i>');
                      },
                                          
                      success: function (data) {
                                  $('#name').val(data);                          
                      }
                  });
              }
          </script>
          <script>
            $('select[name="warehouse_id"]').on('change', function() {
              var warehouseId = $(this).val();
              var sku=document.getElementById('sku').value;
              //alert (warehouseId);
              $.ajax({
                  type: "POST",
                  url: "ajax_get_rack.php",
                  data: {warehouse : warehouseId, sku : sku},

                  beforeSend: function() {
                    $('#loadgif').html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');
                  },
                  complete: function() {
                    $('#loadgif').html('<i style="display:none" class="fa fa-refresh"></i>');
                  },
                                      
                  success: function (data) {
                              //remove disabled from province and change the options
                              $('select[name="rack_id"]').prop("disabled", false);
                              $('select[name="rack_id"]').html(data);
                            //   $('#add').prop('disabled',false);
                  }
              });
          });
          </script>
          
          <script>
              function search_sku1()
              {
                    var type=8;
                    var sku=document.getElementById('s1').value;
                    // var sku_id=document.getElementById('sku').value;
                //   alert(sku);
                    if(sku!='')
                    {
                        $.ajax({
                           
                            type: 'POST',
                            url: 'ajax_sku_search.php',
                            data: {'sku':sku,'type':type},
                            success: function(data)
                            {
                                $('#div_search').show();
                                $('#div_search').prop("disabled",false);
                                $('#div_search').html(data);  
                                // $('#warehouse_id').prop('disabled',false);
                            }    
                            
                        });
                    }
                    else
                    {
                        $('#div_search').prop("disabled",true);
                    }
                }
          </script>
          
          <script>
              function check_sku()
              {
                  var sku= document.getElementById('sku').value;
                   $.ajax({
                      type: "POST",
                      url: "ajax_returned_sku.php",
                      data: {sku : sku },
    
                                
                      success: function (data) {
                                  //remove disabled from province and change the options
                                  if(data==1)
                                  {
                                      
                                      $('#warehouse_id').prop("disabled",false);
                                  }
                                  else
                                  {
                                     $('#add').prop("disabled", true);
                                     $('#warehouse_id').prop("disabled",true);
                                     alert("Sku is not listed in any warehouse");
                                     document.getElementById('sku').value='';
                                  }
                      }
                  });
              }
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
                document.getElementById('total_price').value=total_price;
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
                document.getElementById('total_price').value=total_price.toFixed(2);
              }
              else
              {
                document.getElementById('total_price').value=unit_price; 
              }
            }

          </script>

        </body>
</html>