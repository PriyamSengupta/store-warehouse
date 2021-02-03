<?php include('include/header_top.php'); ?>
<style>
    .search{
        margin: 25px 0 0 0px;
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
      <!-- /top navigation -->
       <!-- page content -->
        
      <?php 
	       $id = $_REQUEST['id'];
	       $sqlbranchdata = mysqli_fetch_object(mysqli_query($db_handle,"SELECT * FROM tbl_combo_product WHERE id = '".$id."'"));	 
	   ?>    
    
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

            <div class="title_left">

              <h3>Edit</h3>

            </div>

            <div class="title_right">

              <div class="col-md-4 col-sm-4 col-xs-12 form-group pull-right top_search">

               <a href="pre_packing_list.php" class="btn btn-info btn-s" style="float:right;"><i class="fa fa-history"></i> Back to Transaction List</a>
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
                                <div class="col-md-3 col-sm-3 col-xs-8">
                                    <p class="col-md-4 col-sm-4 col-xs-8"><b>SKU</b></p>
                                </div>

                                
                                <div class="col-md-3 col-sm-3 col-xs-8">
                                    <div class="col-md-3 col-sm-3 col-xs-8">
                                        <p class="col-md-3 col-sm-3 col-xs-8"><b>Quantity</b></p>
                                    </div>
                                </div>
                                
                                <div class="col-md-3 col-sm-3 col-xs-8">
                                    <div class="col-md-3 col-sm-4 col-xs-8">
                                        <p class="col-md-3 col-sm-3 col-xs-8"><b>UnitPrice</b></p>
                                    </div>
                                </div>
                                
                                <div class="col-md-3 col-sm-3 col-xs-8">
                                    <div class="col-md-3 col-sm-3 col-xs-8">
                                        <p class="col-md-3 col-sm-3 col-xs-8"><b>Total(Rs)</b></p>
                                    </div>
                                </div>
                                
                                <!--<div class='col-md-2 col-sm-2 col-xs-8' >-->
                                <!--    <button type='button' id='remove' class='btn btn-danger'><span class='glyphicon glyphicon-pencil-sign' aria-hidden='true'></span>edit</button>-->
                                <!--</div>-->
                                
                                </div>
                        
                        <?php
                            $sqldata = mysqli_query($db_handle,"SELECT * FROM tbl_combo_product_details WHERE combo_product_id = '".$id."'");
                            
                            while($res=mysqli_fetch_object($sqldata))
                            { 
                                $sqlSs=mysqli_fetch_object(mysqli_query($db_handle,"SELECT s.name FROM tbl_products p LEFT JOIN tbl_sku s ON p.sku=s.id WHERE p.id='".$res->product_id."'"));
                            ?>
                            
                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom:5px;">
                                
                                <!--<input type="hidden" value="<?=$res->id?>" name="tab_id">-->
                                <!--<input type="hidden" value="<?=$product_id?>" name="pro_id">-->
                                <!--<input type="hidden" value="<?=$res->total_price?>" name="total">-->
                                <!--<input type="hidden" value="<?=$res->quantity?>" name="quant">-->
                                <!--<input type="hidden" name="sku_id" value="<?=$sku_id?>">-->
                                <!--<input type="hidden" name="sku_name" value="<?=$sqlSKU->name?>">-->
                                
                                <div class="col-md-3 col-sm-3 col-xs-8">
                                    <input type="text" name="sku1" id="sku1" required='required' class="form-control col-md-2 col-sm-2 col-xs-8" value="<?=$sqlSs->name?>" disabled>
                                </div>
                                
                                
                                <div class="col-md-3 col-sm-3 col-xs-8">
                                    <input type="number" min="0" name="quant1" id="quant1" required='required' class="form-control col-md-2 col-sm-2 col-xs-8" value="<?=$res->quantity?>" disabled>
                                </div>
                                
                                <div class="col-md-3 col-sm-3 col-xs-8">
                                    <input type="number" min="0" name="unit1" id="unit1" required='required' class="form-control col-md-2 col-sm-2 col-xs-8" value="<?=$res->unit_price?>" disabled>
                                </div>
                                
                                <div class="col-md-3 col-sm-3 col-xs-8">
                                    <input type="text" name="total1" id="total1" required='required' class="form-control col-md-2 col-sm-2 col-xs-8" value="<?=$res->total_price?>" disabled>
                                </div>
                                

                            </div>
                        <?php
                            }
                        ?>
                        
                        <div id="show_form">
                        <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px 20px;">
                        <!--<h4>Detailed Warehouse Info</h4>-->
                        <button type="button" class="btn btn-link" id="add_row" name="add_row"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>Add new</button>
                        </div>
                        <form method="post" action="editcombo.php">
                        <!--<a href="javascript:void(0);" id="link" style="float:left">Add Warehouse Info</a>-->
                        <div  id="dyn_div" style="padding: 0;">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                              <input type="hidden" name="combo_id" value="<?=$id?>">
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
        
        
        <script>  
            $(document).ready(function(){  
                var id=0;
                $("#add_row").on("click", function(){  
                 id=id+1;
                 //alert(id);
                    $("#dyn_div").append("<div class='col-md-12 col-sm-12 col-xs-12' id='d1"+id+"'><div class='col-md-2 col-sm-2 col-xs-8'><input type='text' id='sku_search"+id+"' name='sku_search[]' required='required' class='form-control col-md-7 col-xs-12' placeholder='Select SKU' onkeyup='search_sku("+id+")' autocomplete='off'><div class='search' id='div"+id+"' style='display:none; margin: 33px 0 0 0px; width: 91%;'></div></div><input type='hidden' name='unit_price[]' id='unit_price"+id+"' required='required' value=''><input type='hidden' name='rack_quant[]' id='rack_quant"+id+"' required='required' value=''><input type='hidden' name='rack_id[]' id='rack_id"+id+"' required='required' value=''><div class='col-md-2 col-sm-2 col-xs-8'><select class='form-control col-md-2 col-sm-2 col-xs-8' name='warehouse_id[]' id='warehouse_id"+id+"' onchange='get_assigned_rack(this.value,"+id+")' required><option value=''>Select warehouse</option></select></div><div class='col-md-2 col-sm-2 col-xs-8' id='ptw_div"+id+"'><select class='form-control col-md-2 col-sm-2 col-xs-8' name='ptw_id[]' id='ptw_id1'><option value=''>Select a Rack</option></select></div><div class='col-md-2 col-sm-2 col-xs-8' ><input type='number' min='0' id='quantity"+id+"' name='quantity[]' placeholder='Quantity' onkeyup='get_total("+id+")' required='required' class='form-control col-md-7 col-xs-12' disabled=''></div><div class='col-md-2 col-sm-2 col-xs-8' ><input type='text' id='total_price"+id+"' placeholder='Total Price' name='total_price[]' required='required' class='form-control col-md-7 col-xs-12' readonly></div><div class='col-md-2 col-sm-2 col-xs-8' ><button type='button' id='remove' onclick='delete_row("+id+")' class='btn btn-danger'><span class='glyphicon glyphicon-minus-sign' aria-hidden='true'></span>Delete Row</button></div></div>");
                        $("#add_pro").show();
                });
            });  
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
                                      
                                      
                                      if(quantity!='')
                                      {
                                         var total_price=parseFloat(quantity*$('#unit_price'+id).val()).toFixed(2);
                                      document.getElementById('total_price'+id).value=total_price; 
                                      }
                                      
                          }
                      });
              
        }
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
            function delete_row(id)
            {
                // alert(id);
                $('#d1'+id).remove();
                if(id==1)
                {
                    $("#add_pro").hide();
                }
            }
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