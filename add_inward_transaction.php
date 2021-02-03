<?php include('include/header_top.php'); ?>

<style>
    .focused{
      border: solid 1px red;
      }
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
       if (!(in_array("5",$permission1))) { 
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

              <h3>Add Inward Transaction</h3>

            </div>

            <div class="title_right">

              <div class="col-md-4 col-sm-4 col-xs-12 form-group pull-right top_search">

               <a id="back" class="btn btn-info btn-s" style="float:right;"><i class="fa fa-history"></i> Back to Transaction List</a>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
        
          <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">

              <div class="x_panel">

                <div class="x_title">

                  <h2>Add <small>Info</small></h2>

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

                   
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="addInwardTransaction.php">
                        
                            <div class="form-group">
                              <!--<label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand_name">SKU Name <span class="required">*</span>-->
                              <!--</label>-->
                              <div class="col-md-6 col-sm-6 col-xs-12" id='sku_div'>
                                  <input type="text" name="sku_name" id="s1" class="form-control col-md-10" placeholder="Select SKU" style="float: left;" autocomplete="off" onkeyup="search_sku()"/>
                                  <input type="hidden" name="sku" id="sku1" value="">
                                  <div class="search" id="div1" style="display:none"></div>
                                  
                                  <!--  <div id="autocomplete-container" style="position: relative; float: left; width: 400px; margin: 10px;"></div>-->
                                 <!--<select class="form-control" name="sku" id="sku" style="width:60%" required>
                                   <option value="">Select sku</option>
                                   <?php 
                                              $sqlselect=mysqli_query($db_handle,"SELECT * FROM tbl_sku WHERE status=1 AND ( product_id=0 AND combo_product_id=0 ) ORDER BY id ASC"); while($record=mysqli_fetch_object($sqlselect)) { ?><option value="<?php echo $record->id; ?>" ><?php echo $record->name; ?>
                                                
                                    </option>
                                    <?php }  ?>                                                                              
                                 </select>-->
                              </div>
                              
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type='text' id="unit_price" name='unit_price' id='unit_price' required='required' placeholder='Unit Price'  style=" display:none" class='form-control col-md-10 unit' onkeyup="get_total1()">
                              </div>
                              
                              <!--<button type="submit" class="btn btn-success" id="add" name="add" style="float:left;">Submit</button>-->
                            </div>
                    
                        <div id="show_form" style="display:none">
                        <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px 20px;">
                        <h3><small>Allocate to Warehouse</small></h3>
                        <button type="button" class="btn btn-link" id="add_row" name="add_row"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>Add warehouse info</button>
                        </div>
                        <!--<a href="javascript:void(0);" id="link" style="float:left">Add Warehouse Info</a>-->
                        <div  id="dyn_div" style="padding: 0;">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                          </div>
                        </div>  
                    <!--</div>-->
                    <input type="hidden" id="count" value="">
                    <div class="ln_solid"></div>
                    <div class="form-group" style="float:right">

                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" id="add_pro" >

                      	<button type="submit" class="btn btn-primary" name="add" id="add_in" disabled=""><span class='glyphicon glyphicon-plus-sign' aria-hidden='true'></span>Add</button>
                       
                      </div>
                    </div> 
                    </div>
                    </form>
                    </div>
                    
                    <div class="position_loader" id="loadgif"></div>
                  
                </div>
              </div>
            </div>
           <!--</form>-->
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
                                      
                  success: function (data) {
                              //remove disabled from province and change the options
                              $('select[name="rack_id"]').prop("disabled", false);
                              $('select[name="rack_id"]').html(data);                          
                  }
              });
          });
          </script>
        <script>  
            $(document).ready(function(){  
                var id=1;
                $("#add_row").on("click", function(){
                    $("#count").val(id);
                    id=id+1;
                    $("#add_pro").show();
                    $("#add_in").prop("disabled",false);
                    //alert(id);
                    $("#dyn_div").append("<div class='col-md-12 col-sm-12 col-xs-12' id='d1"+id+"'><div class='col-md-2 col-sm-2 col-xs-8'><select class='form-control col-md-2 col-sm-2 col-xs-8' name='warehouse_id[]' id='warehouse_id"+id+"' onchange='get_rack(this.value,"+id+")' required><option value=''>Select warehouse</option><?php $sqlselect=mysqli_query($db_handle,"SELECT id,name FROM tbl_warehouse WHERE status='1' AND flag='1' ORDER BY id ASC");while($record=mysqli_fetch_object($sqlselect)) { ?><option value='<?php echo $record->id; ?>'' ><?php echo $record->name;?></option> <?php } ?></select></div><div class='col-md-2 col-sm-2 col-xs-8'><select class='form-control col-md-2 col-sm-2 col-xs-8' name='rack_id[]' id='rack_id"+id+"' onchange='check_rack(this.value,"+id+")' required><option value=''>Select rack</option></select></div><div class='col-md-2 col-sm-2 col-xs-8' ><input type='number' min='0' id='quantity"+id+"' name='quantity[]' placeholder='Quantity' onkeyup='get_total("+id+")' required='required' class='form-control col-md-2 col-sm-2 col-xs-8'></div><div class='col-md-2 col-sm-2 col-xs-8' ><input type='text' id='total_price"+id+"' placeholder='Total Price' name='total_price[]' required='required' class='form-control col-md-2 col-sm-2 col-xs-8' readonly></div><div class='col-md-2 col-sm-2 col-xs-8'><select class='form-control col-md-2 col-sm-2 col-xs-8' name='status[]' id='status"+id+"' required><option value=''>Select status</option><option value='1'>Good</option><option value='0'>Bad</option></select></div><div class='col-md-2 col-sm-2 col-xs-8' ><button type='button' id='remove' onclick='delete_row("+id+")' class='btn btn-danger'><span class='glyphicon glyphicon-minus-sign' aria-hidden='true'></span>Remove</button></div></div>");
                    
                });
            });  
        </script>
        
        <script>
        /*var rack_array=[];
            function check_rack(rack_id,id)
            {
                
                var index=id-2;
                // alert(index);
                
                if(rack_array.indexOf(rack_id)==-1)
                {
                    rack_array[index]=rack_id;
                    // rack_array.push(rack_id);
                    $('#add_in').prop('disabled', false);
                    $('#remove').prop('disabled', false);
                    // console.log(rack_array);
                }
                else
                {
                    if(rack_array[index]=='')
                    {
                        document.getElementById('rack_id'+id).value='';
                    }    
                        alert("warehouse/rack must be different");
                        $('#add_in').prop('disabled', true);
                }
            } */  
        </script>
        
        <script>
            function delete_row(id)
            {
                var rack=document.getElementById('rack_id'+id).value;
                
                /*for( var i = 0; i < rack_array.length; i++){ 
                   if ( rack_array[i] === rack) {
                     rack_array.splice(i, 1); 
                   }
                }*/
                // console.log(rack_array);

                if(id==2)
                {
                    $('#add_pro').hide();
                }
                $('#d1'+id).remove();
            }
        </script> 
         
          <script>
            
            function get_total(count)
            {
              var quantity=document.getElementById('quantity'+count).value;
              var unit_price=document.getElementById('unit_price').value;
              //var total_price=document.getElementById('total_price').value;
              if(unit_price!='' && quantity!='')
              {
                var total_price=parseFloat(quantity*unit_price);
                document.getElementById('total_price'+count).value=total_price.toFixed(2);
              }
              else
              {
                document.getElementById('total_price'+count).value=0.00; 
              }
            }

            function get_total1()
            {
              var i,j=2;
              var count=document.getElementById('count').value;
            //   var quantity=document.getElementById('quantity'+count).value;
              var unit_price=document.getElementById('unit_price').value;
              if(unit_price<0)
              {
                  alert("Price can't be less than 0");
                  document.getElementById('unit_price').value='';
              }
              for (i = 1; i <= count; i++) {
                  //alert(i);
                  var quantity=document.getElementById('quantity'+j).value;
                  if(quantity!='')
                  {  
                    var total_price=parseFloat(quantity*unit_price);
                    document.getElementById('total_price'+j).value=total_price.toFixed(2);
                  }
                  else
                  {
                    document.getElementById('total_price'+j).value=unit_price.toFixed(2); 
                  }
                  j=j+1;
              }
            }
          </script>
          
           <script>
                function get_rack(warehouse_id,count)
                {
                //   var warehouseId = $(this).val();
                //   alert (warehouse_id);
                  $.ajax({
                      type: "POST",
                      url: "ajax_get_rack.php",
                      data: {warehouse : warehouse_id },
    
                      beforeSend: function() {
                        $('#loadgif').html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');
                      },
                      complete: function() {
                        $('#loadgif').html('<i style="display:none" class="fa fa-refresh"></i>');
                      },
                                          
                      success: function (data) {
                                  //remove disabled from province and change the options
                                //   $('select[name="rack_id"]').prop("disabled", false);
                                  $('#rack_id'+count).html(data);                          
                      }
                  });
                }
            </script>
          
          <script>
                    // $(function () {

                    //     $('#demo-form2').on('submit', function(e) {
                
                    //       e.preventDefault();
                
                    //       $.ajax({
                    //         type: 'post',
                    //         url: 'addproduct.php',
                    //         data: $('form').serialize(),
                    //         dataType:'json',
                    //         success: function(json) {
                    //             $('#name').hide();
                    //             $("#sku").hide();
                    //             $("#colour").hide();
                    //             $("#unit_price").hide();
                    //             $("#add").hide();
                                
                    //             $("#unit_price1").show();
                    //             $("#colour1").show();
                    //             $('#name1').show();
                    //             $("#sku1").show();
                                
                    //             $('#name1').val(json['name']);
                    //             $("#sku1").val(json['sku']);
                    //             $("#colour1").val(json['colour']);
                    //             $("#unit_price1").val(json['unit_price']);
                    //             $("#pro_id").val(json['id']);
                                
                    //             $("#sku1").attr("disabled", "disabled");
                    //             $("#colour1").attr("disabled", "disabled"); 
                    //             $("#name1").attr("disabled", "disabled");
                    //             $("#unit_price1").attr("disabled", "disabled"); 
                    //             // $('#unit_price').val(json['unit_price']);
                    //             alert("Product added successfully");
                    //         }
                    //       });
                
                    //     });
                
                    //   });
          </script>
          <script>  
            $(document).ready(function(){
              $(document).on("click", "#back", function() {
                //var id=$(this).attr("id");
            	window.location.href='inward_transaction_list.php';
              });
            });
        </script>
          <script>
              $(document).ready(function(){
                $('#sku').on('change', function() {
                  if ( this.value == '')
                  {
                    $("#show_form").hide();
                    $(".unit").hide();
                  }
                  else
                  {
                    $("#show_form").show();
                    $(".unit").show();
                  }
                });
            });
          </script>
          <script>
            //   function validate()
            //   {
            //       var sku=document.getElementById('sku1');
            //       if(sku=='')
            //       {
            //             $('#sku1').addClass("focused");
            //             document.getElementById('chk').innerHTML="This field is required";
    			    	// return false;
                      
            //       }
            //       else
            //       {
            //           return true;
            //       }
            //   }
              function search_sku()
              {
                  var type=4;
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
          <script type="text/javascript">
            $(function() {
              'use strict';
              var countriesArray = $.map(countries, function(value, key) {
                return {
                  value: value,
                  data: key
                };
              });
              // Initialize autocomplete with custom appendTo:
              $('#autocomplete-custom-append').autocomplete({
                lookup: countriesArray,
                appendTo: '#autocomplete-container'
              });
            });
          </script>

        </body>
</html>