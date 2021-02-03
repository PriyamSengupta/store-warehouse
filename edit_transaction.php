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
	       $product_id = $_REQUEST['id'];
	       $sqlbranchdata = mysqli_fetch_object(mysqli_query($db_handle,"SELECT * FROM tbl_products WHERE id = '".$product_id."'"));	 
	   ?>    
    
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

              <h3>Edit Inward Transaction</h3>

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

                  <h2>Edit <small>Info</small></h2>

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

                  <strong>Data Updated Successfully!</strong>
                </div>

                <?php } ?>


                <div class="x_content">

                  <br />

                    
                  <!--<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="addInwardTransaction.php">-->
                            <div class="form-group">
                                      <label class="control-label col-md-4 col-sm-4 col-xs-12" for="brand_name">SKU Name</label>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                  <?php 
                                                $sku_id= $sqlbranchdata->sku;
                                                $sqlSKU=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_sku WHERE id='".$sku_id."'"));
                                    ?>
                                <input type="text" id="sku_name" name="sku" value="<?=$sqlSKU->name?>" class="form-control col-md-7 col-xs-12" style="width:60%" disabled>
                                
                              </div>
                            </div>
                    
                    <br/><br/><br/><br/>
                  
                  
                        
                        
                        <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="col-md-2 col-sm-2 col-xs-8">
                                    <p class="col-md-2 col-sm-2 col-xs-8"><b>Warehouse</b></p>
                                </div>
                                
                                <div class="col-md-2 col-sm-2 col-xs-8">
                                    <div class="col-md-2 col-sm-2 col-xs-8">
                                        <p class="col-md-2 col-sm-2 col-xs-8"><b>Rack</b></p>
                                    </div>
                                </div>
                                
                                <div class="col-md-2 col-sm-2 col-xs-8">
                                    <div class="col-md-2 col-sm-2 col-xs-8">
                                        <p class="col-md-2 col-sm-2 col-xs-8"><b>UnitPrice</b></p>
                                    </div>
                                </div>
                                
                                <div class="col-md-2 col-sm-2 col-xs-8">
                                    <div class="col-md-2 col-sm-2 col-xs-8">
                                        <p class="col-md-2 col-sm-2 col-xs-8"><b>Quantity</b></p>
                                    </div>
                                </div>
                                
                                <div class="col-md-2 col-sm-2 col-xs-8">
                                    <div class="col-md-2 col-sm-2 col-xs-8">
                                        <p class="col-md-2 col-sm-2 col-xs-8"><b>Condition</b></p>
                                    </div>
                                </div>
                                
                                <!--<div class='col-md-2 col-sm-2 col-xs-8' >-->
                                <!--    <button type='button' id='remove' class='btn btn-danger'><span class='glyphicon glyphicon-pencil-sign' aria-hidden='true'></span>edit</button>-->
                                <!--</div>-->
                                
                                </div>
                        
                        <?php
                            $sqldata = mysqli_query($db_handle,"SELECT * FROM tbl_product_to_warehouse WHERE product_id = '".$product_id."' AND warehouse_id!=6");
                            
                            while($res=mysqli_fetch_object($sqldata))
                            { ?>
                            
                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="editTransaction.php">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="col-md-2 col-sm-2 col-xs-8">
                                    <select class="form-control col-md-2 col-sm-2 col-xs-8" name='warehouse_id' id='warehouse_id' disabled>
                                        <?php $sqlwh=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_warehouse WHERE id='".$res->warehouse_id."'")); ?>
                                            <option><?php echo $sqlwh->name;?></option>
                                    </select>
                                </div>
                                <input type="hidden" value="<?=$res->id?>" name="tab_id">
                                <input type="hidden" value="<?=$product_id?>" name="pro_id">
                                <input type="hidden" value="<?=$res->total_price?>" name="total">
                                <input type="hidden" value="<?=$res->quantity?>" name="quant">
                                <input type="hidden" name="sku_id" value="<?=$sku_id?>">
                                <input type="hidden" name="sku_name" value="<?=$sqlSKU->name?>">
                                <input type="hidden" id="unit<?=$res->id?>" value="<?=$res->unit_price?>">
                                <div class="col-md-2 col-sm-2 col-xs-8">
                                    <select class="form-control col-md-2 col-sm-2 col-xs-8" name='rack_id1' id='rack_id' disabled>
                                        <?php $sqlrc=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_rack WHERE id='".$res->rack_id."'")); ?>
                                            <option><?php echo $sqlrc->name;?></option>
                                    </select>
                                </div>
                                
                                <div class="col-md-2 col-sm-2 col-xs-8">
                                    <input type="text" name="unit_price1" onkeyup="check_negative(<?=$res->id?>)" id="unit_price<?=$res->id?>" required='required' class="form-control col-md-2 col-sm-2 col-xs-8" value="<?=$res->unit_price?>">
                                </div>
                                
                                <div class="col-md-2 col-sm-2 col-xs-8">
                                    <input type="number" min="0" name="quantity1" id="quantity1" required='required' class="form-control col-md-2 col-sm-2 col-xs-8" value="<?=$res->quantity?>">
                                </div>
                                
                                <div class="col-md-2 col-sm-2 col-xs-8">
                                    <select class="form-control col-md-2 col-sm-2 col-xs-8" name='condition1' id='condition1' <?php if($res->status==1) { echo 'style="color: #14a819"'; } else { echo 'style="color: #ef281a"'; }?>>
                                            <option id="working" value="1" <?php if($res->status==1) { echo 'selected="selected"'; }?>>Working</option>
                                            <option id="damaged" value="0" <?php if($res->status==0) { echo 'selected="selected"'; }?>>Damaged</option>
                                    </select>
                                </div>
                                
                                <div class='col-md-2 col-sm-2 col-xs-8' >
                                    <!--<button type="button" class="btn btn-dark">Dark</button>-->
                                    <button type="submit" name='edit' value="<?=$res->id?>" class="btn btn-dark"><span class='glyphicon glyphicon-save' aria-hidden='true'></span>save</button>
                                    <!--<a class="btn btn-dark" href="delete_inward_transaction.php?<?=$res->id?>"><span class='glyphicon glyphicon-trash' aria-hidden='true'></span>remove</a>-->
                                </div>
                                
                                </div>
                                </form>
                        <?php
                            }
                        ?>
                        
                        <div id="show_form">
                        <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px 20px;">
                        <!--<h4>Detailed Warehouse Info</h4>-->
                        <button type="button" class="btn btn-link" id="add_row" name="add_row"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>Allocate to new warehouse</button>
                        </div>
                        <form method="post" action="editInwardTransaction.php">
                        <!--<a href="javascript:void(0);" id="link" style="float:left">Add Warehouse Info</a>-->
                        <div  id="dyn_div" style="padding: 0;">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                              <input type="hidden" name="sku_id" value="<?=$sku_id?>">
                          </div>
                        </div>
                        <!--</form>-->
                    <!--</div>-->
                    
                    <div class="ln_solid"></div>
                    <div class="form-group" style="float:right">

                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" id="add_pro" style="display:none;">

                      	<button type="submit" class="btn btn-primary" name="add"><span class='glyphicon glyphicon-plus-sign' aria-hidden='true'></span>Add</button>
                       
                      </div>
                    </div>
                    <input type="hidden" value="<?=$product_id?>" name="pro_id1">
                    </form>
                    </div>
                    <!--</form>-->
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
                function check_negative(id)
                {
                    var unit = parseInt(document.getElementById('unit_price'+id).value);
                    var unit1= document.getElementById('unit'+id).value;
                    if(unit<0)
                    {
                        alert("Price can't be less than 0");
                        document.getElementById('unit_price'+id).value=unit1;
                    }
                    // alert(unit);
                }
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
          
          $('select[name="condition1"]').on('change', function() {
              var status = $(this).val();
              if(status==1)
              {
                  $(this).css('color','#14a819');
                //   $("#condition1").css("color", "#14a819");
              }
              else if(status==0)
              {
                  $(this).css('color','#ef281a');
              }
          });
          </script>
        <script>  
            $(document).ready(function(){  
                var id=1;
                $("#add_row").on("click", function(){  
                 id=id+1;
                 $("#add_pro").show();
                 //alert(id);
                    $("#dyn_div").append("<div class='col-md-12 col-sm-12 col-xs-12' id='d1"+id+"'><div class='col-md-2 col-sm-2 col-xs-8'><select class='form-control col-md-2 col-sm-2 col-xs-8' name='warehouse_id[]' id='warehouse_id"+id+"' onchange='get_rack(this.value,"+id+")' required><option value=''>Select warehouse</option><?php $sqlselect=mysqli_query($db_handle,'SELECT * FROM tbl_warehouse WHERE status=1 AND flag=1 ORDER BY id ASC'); while($record=mysqli_fetch_object($sqlselect)) { ?><option value='<?php echo $record->id; ?>'><?php echo $record->name; } ?></option></select></div><div class='col-md-2 col-sm-2 col-xs-8'><select class='form-control col-md-2 col-sm-2 col-xs-8' name='rack_id[]' id='rack_id"+id+"' required><option value=''>Select rack</option></select></div><div class='col-md-2 col-sm-2 col-xs-8'><input type='text' name='unit_price[]' id='unit_price"+id+"' required='required' placeholder='Unit Price' class='form-control col-md-2 col-sm-2 col-xs-8' onkeyup='get_total1("+id+")'></div><div class='col-md-1 col-sm-1 col-xs-8' ><input type='number' min='0' id='quantity"+id+"' name='quantity[]' placeholder='Qty' onkeyup='get_total("+id+")' required='required' class='form-control col-md-2 col-sm-2 col-xs-8'></div><div class='col-md-2 col-sm-2 col-xs-8' ><input type='text' id='total_price"+id+"' placeholder='Total Price' name='total_price[]' required='required' class='form-control col-md-2 col-sm-2 col-xs-8'></div><div class='col-md-2 col-sm-2 col-xs-8'><select class='form-control col-md-2 col-sm-2 col-xs-8' name='status[]' id='status"+id+"' required><option value=''>Select status</option><option id='working' value='1'>Working</option><option id='damaged' value='0'>Damaged</option></select></div><div class='col-md-1 col-sm-1 col-xs-8' ><button type='button' id='remove' onclick='delete_row("+id+")' class='btn btn-danger'><span class='glyphicon glyphicon-minus-sign' aria-hidden='true'></span>Remove</button></div></div>");
      
                });
            });  
        </script>
        <script>
            function delete_row(id)
            {
                //alert(id);
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
              var unit_price=document.getElementById('unit_price'+count).value;
              //var total_price=document.getElementById('total_price').value;
              if(unit_price!='')
              {
                var total_price=parseFloat(quantity*unit_price);
                document.getElementById('total_price'+count).value=total_price.toFixed(2);
              }
              else
              {
                document.getElementById('total_price'+count).value=0.00; 
              }
            }

            function get_total1(count)
            {
              var quantity=document.getElementById('quantity'+count).value;
              var unit_price=document.getElementById('unit_price'+count).value;
              if(unit_price<0)
              {
                  alert("Price can't be less than 0");
                  document.getElementById('unit_price'+count).value='';
                  document.getElementById('total_price'+count).value='';
              }
              //var total_price=document.getElementById('total_price').value;
              if(quantity!='')
              {
                var total_price=parseFloat(quantity*unit_price);
                document.getElementById('total_price'+count).value=total_price.toFixed(2);
              }
              else
              {
                    if(unit_price<0)
                    {
                        document.getElementById('total_price'+count).value='';
                    }
                    else
                    {
                        document.getElementById('total_price'+count).value=unit_price;
                    }    
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
                  }
                  else
                  {
                    $("#show_form").show();
                  }
                });
            });
          </script>

        </body>
</html>