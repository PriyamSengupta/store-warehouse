<?php include('include/header_top.php'); ?>

<style>
    .search{
        margin: 24px 0 0 0px;
        background: #fff;
        position: absolute;
        z-index: 999;
        width: 89%;
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
      <link rel="stylesheet" href="css/fancybox.css">
       <script src="js/fancybox.js"></script>
      <!-- /top navigation -->
       <!-- page content -->
      <div class="right_col" role="main">
        <?php
           if (!(in_array("13",$permission1))) { 
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
            <div class="col-md-6 col-sm-6 col-xs-12">
              <h3>Add Inter-warehouse Transaction</h3>
            </div>
            </div>

            <div class="title_right">

              <div class="col-md-4 col-sm-4 col-xs-12 form-group pull-right top_search">

               <a href="warehouse_transaction.php" class="btn btn-info btn-s" style="float:right;"><i class="fa fa-history"></i> Back to Transaction List</a>
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

                <div class="x_content">

                  <br />

                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="addcomboproduct.php" method="post">
                      <div class="form-group">
                        <!--<div class="col-md-6 col-sm-6 col-xs-12" >
                           <label class="control-label col-md-4 col-sm-4 col-xs-12" for="brand_name">Transaction Type <span class="required">*</span>
                              </label>
                            <div class="col-md-6 col-sm-6 col-xs-12" >
                            <select class="form-control" name="type" id="type" onchange="get_list()" required>
                                   <option value="">Select Type</option>
                                   <option value="1">Warehouse</option>
                                   <option value="2">Wholeseller</option>
                                </select>
                            </div>
                        </div>-->
                        
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand_name">SKU Name <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="sku_name" id="s1" class="form-control col-md-7 col-xs-12" placeholder="Select SKU" style="float: left;" autocomplete="off" onkeyup="search_sku()"/>
                                  <input type="hidden" name="sku_id" id="sku1" value="">
                                  <div class="search" id="div1" style="display:none"></div>
                                  <button type="button" onclick="get_list();" class="btn btn-success btn-s" style="margin-top: 9px;float: right;">proceed</button>
                        <!--<select class="form-control" name="sku_id" id="sku_id" onchange="get_list()" required>
                               <option value="">Select SKU</option>
                                          <?php 
                                          $sqlselect=mysqli_query($db_handle,"SELECT * FROM tbl_sku WHERE status=1 AND ( product_id!=0 OR combo_product_id!=0 ) ORDER BY id ASC"); while($record=mysqli_fetch_object($sqlselect)) { ?><option value="<?php echo $record->id; ?>" ><?php echo $record->name; ?>  
                                </option>
                                <?php }  ?>
                            </select>-->
                        </div>
                        
                   </div>
                    <div class="clearfix"></div>
                    

                    <!--<div class="form-group">-->
                    <!--  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="unit_price">Unit Price <span class="required">*</span>-->
                    <!--  </label>-->
                    <!--  <div class="col-md-6 col-sm-6 col-xs-12">-->
                    <!--    <input type="text" id="unit_price" name="unit_price" required="required" class="form-control col-md-7 col-xs-12" onkeyup="get_total1()">-->
                    <!--  </div>-->
                    <!--</div>-->

                    <!--<div class="form-group">-->
                    <!--  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="unit_price">Quantity <span class="required">*</span>-->
                    <!--  </label>-->
                    <!--  <div class="col-md-6 col-sm-6 col-xs-12">-->
                    <!--    <input type="text" id="quantity" name="quantity" required="required" class="form-control col-md-7 col-xs-12" onkeyup="get_total()">-->
                    <!--  </div>-->
                    <!--</div>-->

                    <!--<div class="form-group">-->
                    <!--  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="total_price">Total Price <span class="required">*</span>-->
                    <!--  </label>-->
                    <!--  <div class="col-md-6 col-sm-6 col-xs-12">-->
                    <!--    <input type="text" id="total_price" name="total_price" required="required" class="form-control col-md-7 col-xs-12">-->
                    <!--  </div>-->
                    <!--</div>-->

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
                    <br>
                    <!--<div class="x_title">-->
                    <!--</div>-->
                    <!--<div class="x_content">-->
                    
                      <div id="dyn_div"  class="col-sm-12 col-xs-12" style="padding: 0;">
                        
                          
                      </div>  
                    <!--</div>    -->
                        
                    <!--<div class="ln_solid"></div>-->

                    <!--<div class="form-group">-->

                    <!--  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">-->
                        
                    <!--  	<button type="submit" class="btn btn-primary"  name="add" style="float:right">Submit</button>-->
                        <!--<button type="reset" class="btn btn-primary">Cancel</button>                        -->
                    <!--  </div>-->
                    <!--</div>-->
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
        function get_list()
        {
            // alert(sku_id);
            var sku_id=$('#sku1').val()
            var type=$('#type').val()
            // alert(type);
            // alert(sku_id);
            if(sku_id!=''){
            $.ajax({
                
                type: "POST",
                  url: "ajax_get_list.php",
                  data: {sku : sku_id, type : type },

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
            else
            {
                alert("Enter an SKU");
            }
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
                var sku=$('#sku1').val();
                // var type=$('#type').val();
                var type=1;
                // alert(sku);
                // alert(id);
            	$.fancybox({
                     href : 'transaction_window.php?id='+id+'&sku='+sku+'&type='+type,
                     closeBtn: true
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
            
            function search_sku()
              {
                  var type=5;
                    var sku=document.getElementById('s1').value;
                //   alert(id);
                    if(sku!='')
                    {
                        $.ajax({
                           
                            type: 'POST',
                            url: 'ajax_sku_search.php',
                            data: {'sku':sku,'type':type},
                            success: function(data)
                            {
                                $('#div1').show();
                                $('#div1').prop("disabled",false);
                                $('#div1').html(data);  
                            }    
                            
                        });
                    }
                    else
                    {
                        $('#div1').prop("disabled",true);
                    }
              }

          </script>

        