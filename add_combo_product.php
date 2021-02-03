<?php include('include/header_top.php'); ?>

<style>
    .search{
        margin: 23px 0 0 0px;
        background: #fff;
        position: absolute;
        z-index: 999;
        width: 93%;
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
       if (!(in_array("4",$permission1))) { 
            echo "<script>alert('You donot have access to open this page')</script>";
      ?>
    </div>
    </div>
    </div>
    
    <?php include('include/footer.php'); 
    } else { ?>
     
        <div class="">
          <div class="page-title">
              <div class="col-sm-6">
            <div class="title_left">
              <h3>
                  Add Combo Product
               </h3>
           </div>
</div>
            <div class="title_right">
              <div class="col-md-2 col-sm-2 col-xs-12 form-group pull-right top_search">
                <!--<div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                </div>-->
                <!--<button type="button" class="btn btn-info btn-s add"><i class="fa fa-plus"></i> Add Product</button>-->
                    <a href="pre_packing_list.php" class="btn btn-info btn-s" style="float:right;"><i class="fa fa-history"></i> Back to Pre-packing Area</a>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>

          <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">

              <div class="x_panel">

                <div class="x_title">

                  <h2>Add <small>Combo Product</small></h2>

                  <ul class="nav navbar-right panel_toolbox">

                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>

                    </li>

                    <li><a class="close-link"><i class="fa fa-close"></i></a>

                    </li>

                  </ul>

                  <div class="clearfix"></div>

                </div>
                
                <?php if(($_REQUEST['msg'] && $_REQUEST['msg'] == '1')) { ?>

                <div class="alert alert-success alert-dismissible fade in" role="alert">

                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>

                  </button>

                  <strong>Destination SKU doesn't Exist</strong>

                </div>

                <?php } ?>

                <div class="x_content" style="margin-top: 0px;">

                  <br />

                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="addcomboproduct.php" method="post">
                    
                    <div class="col-md-8 col-sm-8 col-xs-12">
                      <!--<label class="control-label col-md-2 col-sm-2 col-xs-4" for="name">Name<span class="required">*</span>-->
                      <!--</label>-->
                      <!--<div class="col-md-4 col-sm-4 col-xs-8">-->
                      <!--  <input type="text" id="name" name="name" placeholder="Name For Combo Product" required="required" class="form-control col-md-4 col-sm-4 col-xs-8">-->
                      <!--</div>-->
                      <!--<label class="control-label col-md-2 col-sm-2 col-xs-4" for="name">Quantity<span class="required">*</span>-->
                      <!--</label>-->
                      <!--<div class="col-md-3 col-sm-3 col-xs-8">-->
                      <!--  <input type="text" id="quant" name="quant" placeholder="Quantity of Combo Product" required="required" class="form-control col-md-4 col-sm-4 col-xs-8">-->
                      <!--</div>-->
                    </div>
                    
                   
                    <!--<div class="clearfix"></div>-->
                    
                    <br>
                    <!--<div class="x_title">-->
                    <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px 20px;">
                        <h4>Source Product(s):</h4>
                        <button type="button" class="btn btn-link" id="add_row" name="add_row"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>Add row</button>
                    </div>
                    <br>
                    <br>
                    <!--</div>-->
                    <!--<div class="x_content">-->
                    
                    <div  id="dyn_div"  class="col-sm-12 col-xs-12" style="padding: 0;">
                          
                       <!--<div class="col-md-12 col-sm-12 col-xs-12">
    
                      <div class="col-md-2 col-sm-2 col-xs-8" >
                          <input type="text" id="sku_search1" name="sku_search[]" required="required" class="form-control col-md-7 col-xs-12" placeholder="Select SKU" onkeyup="search_sku(1)" autocomplete="off">
                          <div class="search" id="div1" style="display:none"></div>

                            <input type="hidden" id="product_id1" name="product_id[]" required="required" value="">
                            <input type="hidden" id="unit_price1" name="unit_price[]" required="required" value="">
                            <input type="hidden" id="rack_quant1" name="rack_quant[]" required="required" value="">
                            <input type="hidden" id="rack_id1" name="rack_id[]" required="required" value="">
                        </div>
                    <div class='col-md-2 col-sm-2 col-xs-8'>
                        <select class='form-control col-md-2 col-sm-2 col-xs-8' name='warehouse_id[]' id='warehouse_id1' onchange='get_assigned_rack(this.value,1)' required>
                            <option value=''>Select warehouse</option>
                            <?php 
                                          $sqlselect=mysqli_query($db_handle,"SELECT id,name FROM tbl_warehouse WHERE status='1'  ORDER BY id ASC"); while($record=mysqli_fetch_object($sqlselect)) { ?><option value="<?php echo $record->id; ?>" ><?php echo $record->name; ?></option> <?php } ?>
                            
                        </select>
                    </div>
                    
                    <div class='col-md-2 col-sm-2 col-xs-8' id='ptw_div1'>
                        <select class='form-control col-md-2 col-sm-2 col-xs-8' name='ptw_id[]' id='ptw_id1'>
                            <option value=''>Select a Rack</option>
                            </select>
                      
                    </div>
                                     
                    <div class="col-md-2 col-sm-2 col-xs-8" >
                       <input type="text" id="quantity1" name="quantity[]" required="required" class="form-control col-md-7 col-xs-12" disabled='' placeholder="Quantity" onkeyup="get_total(1)">
                    </div>
                    
                    <div class="col-md-2 col-sm-2 col-xs-8" >
                       <input type="text" id="total_price1" name="total_price[]" required="required" placeholder="Total Price" class="form-control col-md-7 col-xs-12" readonly>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-8" >
                      	<button type="button" id="remove" class="btn btn-danger" disabled=""><span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span>Delete Row</button>
                    </div>
                    </div>-->
                </div>
                
                <div class="clearfix"></div>
                <br/><br/>
                
                <div class="col-md-12 col-sm-12 col-xs-12">
                          <h4 style="margin-bottom: 16px;">Destination Product:</h4>
                        <div class="col-md-3 col-sm-3 col-xs-8" >
                        <select class="form-control" name="warehouse" id="warehouse" onchange="get_rack(this.value)" required>
                               <option value="">Select warehouse</option>
                                          <?php 
                                          $sqlselect=mysqli_query($db_handle,"SELECT * FROM tbl_warehouse WHERE status=1 AND flag='1' ORDER BY id ASC"); while($record=mysqli_fetch_object($sqlselect)) { ?><option value="<?php echo $record->id; ?>" ><?php echo $record->name; ?>
                                            
                                </option>
                                <?php }  ?>
                            </select>
                        </div>
                    
                    <div class="col-md-3 col-sm-3 col-xs-8" >
                       <select class="form-control" name="rack" id="rack"  disabled="" required>
                               <option value="">Select Rack</option>
                               <!-- <option id="opt"></option> -->
                        </select>
                    </div>
                    
                    <div class="col-md-3 col-sm-3 col-xs-8" >
                       <input type="text" id="s1" name="s1" required="required" class="form-control col-md-7 col-xs-12" placeholder="Select SKU" onkeyup="search_sku1()" autocomplete="off">
                       <input type="hidden" id="sku" name="sku" value="">
                          <div class="search" id="div_search" style="display:none"></div>
                       <!--<select class="form-control" name="sku" id="sku"  required>
                               <option value="">Select sku</option>
                               <?php 
                                          $sqlselect=mysqli_query($db_handle,"SELECT * FROM tbl_sku WHERE status='1' AND ( product_id=0 AND combo_product_id=0 ) AND flag='1' ORDER BY id ASC"); if(mysqli_num_rows($sqlselect)>0){ while($record=mysqli_fetch_object($sqlselect)) { ?><option value="<?php echo $record->id; ?>" ><?php echo $record->name; ?>
                                            
                                </option>
                                <?php } } else{ ?>
                                        <option value="">No Sku Found</option>
                                <?php } ?>                                                                              
                            </select>-->
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-8">
                        <input type="number" min="0" id="quant" name="quant" placeholder="Quantity of Combo Product" required="required" class="form-control col-md-4 col-sm-4 col-xs-8">
                      </div>
                    </div>
                
                
                    <!--</div>    -->
                        
                    <!--<div class="ln_solid"></div>-->

                    <div class="form-group">

                      <div class="col-md-12 col-sm-12 col-xs-12">
                        
                      	<button type="submit" class="btn btn-primary" id="addbtn" name="add" style="float:right" disabled>Submit</button>
                        <!--<button type="reset" class="btn btn-primary">Cancel</button>                        -->
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
        $(document).ready(function(){  
            var id=0;
            $("#add_row").on("click", function(){  
             id=id+1;
             //alert(id);
                $("#dyn_div").append("<div class='col-md-12 col-sm-12 col-xs-12' id='d1"+id+"'><div class='col-md-2 col-sm-2 col-xs-8'><input type='text' id='sku_search"+id+"' name='sku_search[]' required='required' class='form-control col-md-7 col-xs-12' placeholder='Select SKU' onkeyup='search_sku("+id+")' autocomplete='off'><div class='search' id='div"+id+"' style='display:none; margin: 33px 0 0 0px; width: 90%;'></div></div><input type='hidden' name='rack_quant[]' id='rack_quant"+id+"' required='required' value=''><input type='hidden' name='rack_id[]' id='rack_id"+id+"' required='required' value=''><div class='col-md-2 col-sm-2 col-xs-8'><select class='form-control col-md-2 col-sm-2 col-xs-8' name='warehouse_id[]' id='warehouse_id"+id+"' onchange='get_assigned_rack(this.value,"+id+")' required><option value=''>Select warehouse</option></select></div><div class='col-md-2 col-sm-2 col-xs-8' id='ptw_div"+id+"'><select class='form-control col-md-2 col-sm-2 col-xs-8' name='ptw_id[]' id='ptw_id1'><option value=''>Select a Rack</option></select></div><div class='col-md-1 col-sm-1 col-xs-8' ><input type='number' min='0' id='quantity"+id+"' name='quantity[]' placeholder='Qty' onkeyup='get_total("+id+")' required='required' class='form-control col-md-7 col-xs-12' disabled=''></div><div class='col-md-2 col-sm-2 col-xs-8' ><input type='text' name='unit_price[]' id='unit_price"+id+"' placeholder='Unit Price' class='form-control col-md-7 col-xs-12' required='required' value='' readonly></div><div class='col-md-2 col-sm-2 col-xs-8' ><input type='text' id='total_price"+id+"' placeholder='Total Price' name='total_price[]' required='required' class='form-control col-md-7 col-xs-12' readonly></div><div class='col-md-1 col-sm-1 col-xs-8' ><button type='button' id='remove' onclick='delete_row("+id+")' class='btn btn-danger'><span class='glyphicon glyphicon-minus-sign' aria-hidden='true'></span>Delete</button></div></div>");
                    $("#addbtn").prop('disabled',false);
            });
        });  
    </script>
    <script>
        function delete_row(id)
        {
            // alert(id);
            $('#d1'+id).remove();
            if(id==1)
            {
                $("#addbtn").prop("disabled",true);
            }
        }
    </script>
    
            <script>
                function search_sku(id)
                {
                    var type=2;
                    var sku=document.getElementById('sku_search'+id).value;
                //   alert(id);
                    if(sku!='')
                    {
                        $.ajax({
                           
                            type: 'POST',
                            url: 'ajax_sku_search.php',
                            data: {'sku':sku,'type':type,'count':id},
                            success: function(data)
                            {
                                $('#div'+id).show();
                                $('#div'+id).prop("disabled",false);
                                $('#div'+id).html(data);  
                            }    
                            
                        });
                    }
                    else
                    {
                        $('#div'+id).prop("disabled",true);
                    }
                }
                
                function search_sku1()
                {
                    var type=3;
                    var sku=document.getElementById('s1').value;
                    // var sku_id=document.getElementById('sku').value;
                //   alert(id);
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
           function get_rack(warehouseId){
            //   var warehouseId = $(this).val();
            //   alert (warehouseId);
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
                              //remove disabled from province and change the options
                              $('select[name="rack"]').prop("disabled", false);
                              $('#rack').html(data);                          
                  }
              });
           }
          </script>
          <script>
        //   function get_assigned_rack(warehouse_id,id)
        //   {
        //       var product_id=document.getElementById('product_id'+id).value;
        //       $.ajax({
        //           type: "POST",
        //           url: "ajax_get_assigned_rack.php",
        //           data: {product : product_id, warehouse : warehouse_id },

        //           beforeSend: function() {
        //             $('#loadgif').html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');
        //           },
        //           complete: function() {
        //             $('#loadgif').html('<i style="display:none" class="fa fa-refresh"></i>');
        //           },
                                      
        //           success: function (data) {
        //               alert(data);
        //                       //remove disabled from province and change the options
        //                       $('#ptw_div'+id).prop("disabled", false);
        //                       $('#ptw_div'+id).html(data);
                              
        //           }
        //       });
        //   }
          
          function get_assigned_rack(warehouse_id,id)
          {
              var sku=document.getElementById('sku_search'+id).value;
              $.ajax({
                  type: "POST",
                  url: "ajax_get_assigned_rack2.php",
                  data: {sku : sku, warehouse : warehouse_id, count : id },

                  beforeSend: function() {
                    $('#loadgif').html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');
                  },
                  complete: function() {
                    $('#loadgif').html('<i style="display:none" class="fa fa-refresh"></i>');
                  },
                                      
                  success: function (data) {
                              //remove disabled from province and change the options
                               
                              $('#ptw_div'+id).html(data);
                              
                  }
              });
          }
          </script>
          <script>
          function get_warehouse(product_id,id)
          {
              $.ajax({
                  type: "POST",
                  url: "ajax_get_warehouse.php",
                  data: {product : product_id },

                  beforeSend: function() {
                    $('#loadgif').html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');
                  },
                  complete: function() {
                    $('#loadgif').html('<i style="display:none" class="fa fa-refresh"></i>');
                  },
                                      
                  success: function (data) {
                              //remove disabled from province and change the options
                              $('#warehouse_id'+id).prop("disabled", false);
                              $('#warehouse_id'+id).html(data);
                              
                  }
              });
          }
          </script>
          <script>
          function get_id(ptw_id,id)
          {
            var quantity=  document.getElementById("quantity"+id).value;
            
            //   var warehouse_id=document.getElementById('warehouse_id'+id).value;
              
                      $.ajax({
                          type: "POST",
                          url: "ajax_get_id.php",
                          data: {id : ptw_id},
                          dataType: "json",
                          beforeSend: function() {
                            $('#loadgif').html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');
                          },
                          complete: function() {
                            $('#loadgif').html('<i style="display:none" class="fa fa-refresh"></i>');
                          },
                                              
                          success: function (data) {
                                      //remove disabled from province and change the options
                                      $('#quantity'+id).prop("disabled", false);
                                    //   $('#warehouse_id'+id).html(data);
                                      $('#unit_price'+id).val(data['unit_price']);
                                      $('#rack_quant'+id).val(data['rack_quant']);
                                      $('#rack_id'+id).val(data['rack_id']);
                                      document.getElementById("quantity"+id).value='';
                                      document.getElementById('total_price'+id).value='';
                                      
                                      if(quantity!='')
                                      {
                                         var total_price=parseFloat(quantity*$('#unit_price'+id).val()).toFixed(2);
                                      document.getElementById('total_price'+id).value=total_price; 
                                      }
                                      
                          }
                      });
              
          }
          </script>
          <script>
          //$( '#dyn_div' ).on( 'change', '#product_id', function () {
            //$('select[name="product_id[]"]').on('change', function() {
            function get_price(productId,id){
                //alert(id);
              //var productId = $(this).val();
              //var productId=document.getElementById('product_id').value;
              //var productId= this.value;
              //alert (productId);
              $.ajax({
                  type: "POST",
                  url: "ajax_get_price.php",
                  data: {product : productId },
                  dataType: "json",                    
                  success: function (data) {
                            $('#unit_price'+id).val(data['unit_price']);
                            // $('#quant'+id).val(data['quantity'])
                  }
              });
            }
          //});
          </script>

          <script>
            
            function get_total(id)
            {
              var rack_quant=parseInt(document.getElementById('rack_quant'+id).value);        
              var quantity=parseInt(document.getElementById('quantity'+id).value);
              var unit_price=document.getElementById('unit_price'+id).value;
              //var total_price=document.getElementById('total_price').value;
            //   alert(quantity);
            //   alert(rack_quant);
            //   if(quantity>rack_quant)
            //   {
            //       alert("not enough quantity in stock");
            //       document.getElementById('quantity'+id).value='';
            //       document.getElementById('total_price'+id).value=0.00; 
            //   }
              if(isNaN(quantity))
              {
                  document.getElementById('total_price'+id).value=0.00; 
              }
              else
              {
                  if(quantity>rack_quant)
                  {
                      alert("not enough quantity in stock");
                      document.getElementById('quantity'+id).value='';
                      document.getElementById('total_price'+id).value=0.00; 
                  }
                  else
                  {
                        var total_price=parseFloat(quantity*unit_price).toFixed(2);
                        document.getElementById('total_price'+id).value=total_price;
                  }
              }
            }

          </script>

        </body>
</html>