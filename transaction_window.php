<?php include('include/header_top.php'); ?>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      
    
      <div class="right_col" role="main">

        <div class=""> 

          <div class="clearfix"></div>

          <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">

              <div class="x_panel">

                <div class="x_title">

                  <h2>Transaction Window</h2>

                  <ul class="nav navbar-right panel_toolbox">

                    <!--<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>-->

                    <!--</li>-->

                    <li><a class="close-link" id="close"><i class="fa fa-close"></i></a>

                    </li>

                  </ul>

                  <div class="clearfix"></div>

                </div>
                <!--<a href="product_excel_report.php?id=<?php echo $_REQUEST['id']; ?>" class="btn btn-primary btn-s" >Download</a>-->
                <div class="x_content">
                  <br />
                  
                    <?php
                        $id = $_REQUEST['id'];
                        $sql = mysqli_fetch_object(mysqli_query($db_handle,"SELECT * FROM tbl_product_to_warehouse WHERE id = '".$id."'"));	 
                     ?>
                      <div id="alert"></div>
                      <?php if($_REQUEST['type']=='1') { ?>
                    <form id="demo-form" data-parsley-validate class="form-horizontal form-label-left" action="add_stock.php" method="post" onsubmit="return validate_form()">
                        <div class='col-md-12 col-sm-12 col-xs-12'>
                            <label class='col-md-3 col-sm-3 col-xs-8' for="stock transfer from"> Stock Transfer From: <span class="required">*</span></label>
                        </div>
                        <div class='col-md-12 col-sm-12 col-xs-12'>
                            <div class='col-md-4 col-sm-4 col-xs-8'>
                                <!--<label>Warehouse</label>-->
                                <input type="text" class='form-control col-md-2 col-sm-2 col-xs-8' <?php $sqldata=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_warehouse WHERE id='".$sql->warehouse_id."'")); ?> value="<?=$sqldata->name?>" readonly>
                                <input type="hidden" id="warehouse1" name="warehouse1" value="<?=$sql->warehouse_id?>">
                            </div>
                            <input type="hidden" name="row_id" value="<?=$_REQUEST['id']?>">
                             <input type="hidden" name="row_unit_price" value="<?=$sql->unit_price?>">
                            <div class='col-md-4 col-sm-4 col-xs-8'>
                                <!--<label>Warehouse</label>-->
                                <input type="text" class='form-control col-md-2 col-sm-2 col-xs-8' <?php $sqldata=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_rack WHERE id='".$sql->rack_id."'")); ?> value="<?=$sqldata->name?>" readonly>
                                <input type="hidden"id="rack1" name="rack1" value="<?=$sql->rack_id?>">
                            </div>
                            <input type="hidden" name="pro_id" value="<?=$sql->product_id?>">
                            <input type="hidden" name="combo_pro_id" value="<?=$sql->combo_product_id?>">
                            <div class='col-md-4 col-sm-4 col-xs-8'>
                                <!--<label>Warehouse</label>-->
                                <input type="text" class='form-control col-md-2 col-sm-2 col-xs-8' id="quantity1" name="quantity1" <?php $sqldata=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_rack WHERE id='".$sql->rack_id."'")); ?> value="<?=$sql->quantity?>" readonly>
                                <!--<input type="hidden" value="<?=$sql->quantity?>">-->
                            </div>
                        </div>
                        <br/>
                        <br/>
                        <div class='col-md-12 col-sm-12 col-xs-12' style="top: 10px;">
                            <label class='col-md-3 col-sm-3 col-xs-8' for="stock transfer from"> Stock Transfer to: <span class="required">*</span></label>
                        </div>    
                        <div class='col-md-12 col-sm-12 col-xs-12' style="top: 10px;">
                            <div class='col-md-4 col-sm-4 col-xs-8'>
                                <!--<label>Warehouse</label>-->
                                <select class='form-control col-md-2 col-sm-2 col-xs-8' name='warehouse_id' id='warehouse_id' onchange='get_rack(this.value)' required>
                                    <option value=''>Select warehouse</option>
                                    <?php $sqlselect=mysqli_query($db_handle,'SELECT * FROM tbl_warehouse WHERE status=1 AND flag=1 ORDER BY id ASC');
                                            while($record=mysqli_fetch_object($sqlselect)) 
                                            { ?>
                                            <option value='<?php echo $record->id; ?>'><?php echo $record->name; } ?></option>
                                </select>
                            </div>
                            
                            <div class='col-md-4 col-sm-4 col-xs-8'>
                                
                                    <select class='form-control col-md-2 col-sm-2 col-xs-8' name='rack_id' id='rack_id' required>
                                        <option value=''>Select rack</option>
                                    </select>
                                    
                            </div>
                            
                            <div class='col-md-4 col-sm-4 col-xs-8'>
                                <!--<label>Warehouse</label>-->
                                <input type="number" min="0" class='form-control col-md-2 col-sm-2 col-xs-8' id="quantity" name="quantity" required>
                                <input type="hidden" value="">
                            </div>
                        </div>
                        
                        <div class='col-md-12 col-sm-12 col-xs-12' style="top: 20px;">
                         <label class='col-md-3 col-sm-3 col-xs-8' for="stock transfer from"> Status: <span class="required">*</span></label>
                          <!--<div class="form-group">-->
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <p>
                                  Damaged:
                                  <input type="radio" class="flat" name="status" id="genderM" value="0" checked="" required /> 
                                  Working:
                                  <input type="radio" class="flat" name="status" id="genderF" value="1" />
                            </p>
                          </div>
                          <!--</div>        -->
                          </div>
                       <input type="hidden" value="<?=$_REQUEST['sku']?>" name="sku">
                        <div class='col-md-12 col-sm-12 col-xs-12' style="top: 10px;">
                      	    <button type="submit" style="margin-top:10px;float:right" class="btn btn-dark" id="add" name="add1"><span class="glyphicon glyphicon-saved" aria-hidden="true"></span>Send Request</button>
                        </div>
                        
                    </form>     
                    <?php } if($_REQUEST['type']=='2') { ?>
                       <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="add_stock.php" method="post" onsubmit="return validate_form()">
                        <div class='col-md-12 col-sm-12 col-xs-12'>
                            <label class='col-md-2 col-sm-2 col-xs-8' for="stock transfer from"> Stock Transfer From: <span class="required">*</span></label>
                        </div>
                        <div class='col-md-12 col-sm-12 col-xs-12'>
                            <div class='col-md-4 col-sm-4 col-xs-8'>
                                <!--<label>Warehouse</label>-->
                                <input type="text" class='form-control col-md-2 col-sm-2 col-xs-8' <?php $sqldata=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_warehouse WHERE id='".$sql->warehouse_id."'")); ?> value="<?=$sqldata->name?>" readonly>
                                <input type="hidden" id="warehouse1" name="warehouse1" value="<?=$sql->warehouse_id?>">
                            </div>
                            <input type="hidden" name="row_id" value="<?=$_REQUEST['id']?>">
                            <input type="hidden" name="row_unit_price" value="<?=$sql->unit_price?>">
                            
                            <div class='col-md-4 col-sm-4 col-xs-8'>
                                <!--<label>Warehouse</label>-->
                                <input type="text" class='form-control col-md-2 col-sm-2 col-xs-8' <?php $sqldata=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_rack WHERE id='".$sql->rack_id."'")); ?> value="<?=$sqldata->name?>" readonly>
                                <input type="hidden"id="rack1" name="rack1" value="<?=$sql->rack_id?>">
                            </div>
                            <input type="hidden" name="pro_id1" value="<?=$sql->product_id?>">
                            <div class='col-md-4 col-sm-4 col-xs-8'>
                                <!--<label>Warehouse</label>-->
                                <input type="text" class='form-control col-md-2 col-sm-2 col-xs-8' id="quantity1" name="quantity1" <?php $sqldata=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_rack WHERE id='".$sql->rack_id."'")); ?> value="<?=$sql->quantity?>" readonly>
                                <!--<input type="hidden" value="<?=$sql->quantity?>">-->
                            </div>
                        </div>
                        <br/>
                        <br/>
                        <div class="">
                        <div class='col-md-12 col-sm-12 col-xs-12' style="top: 10px;">
                            <label class='col-md-2 col-sm-2 col-xs-8' for="wholeseller info"> Wholeseller Info: <span class="required">*</span></label>
                        </div>    
                        <div class='col-md-12 col-sm-12 col-xs-12' style="top: 10px;">
                            <div class='col-md-4 col-sm-4 col-xs-8'>
                                <!--<label>Warehouse</label>-->
                                <input type="text" class='form-control col-md-2 col-sm-2 col-xs-8' id="ws_name" name="ws_name" placeholder="Name" required>
                            </div>
                            
                            <div class='col-md-4 col-sm-4 col-xs-8'>
                                    <textarea class='form-control col-md-2 col-sm-2 col-xs-8' name="comment" placeholder="Comment"></textarea>
                            </div>
                            
                            <div class='col-md-4 col-sm-4 col-xs-8'>
                                <!--<label>Warehouse</label>-->
                                <input type="number" min="0" class='form-control col-md-2 col-sm-2 col-xs-8' id="quantity" name="quantity" placeholder="Quantity" required>
                                <input type="hidden" value="">
                            </div>
                        </div>
                        </div>
                       <input type="hidden" value="<?=$_REQUEST['sku']?>" name="sku1">
                        <div class='col-md-12 col-sm-12 col-xs-12' style="top: 10px;">
                      	    <button type="submit" style="margin-top:10px;float:right" class="btn btn-dark" id="add" name="add2"><span class="glyphicon glyphicon-saved" aria-hidden="true"></span>Send Request</button>
                        </div>
                        
                    </form>
                    <?php } ?>
                </div>
              </div>
            </div>
          </div>
          
          </div>
        </div>
    </div>
    </body>
    
            <script>
                function get_rack(warehouse_id)
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
                                  $('#rack_id').html(data);                          
                      }
                  });
                }
            </script>
            
            <script>
                $('#close').click(function() {
                        parent.$.fancybox.close();
                    })
            </script>
            
            <script>
                function validate_form()
                {
                    var warehouse1=document.getElementById('warehouse1').value;
                    var warehouse=$('#warehouse_id').val();
                    var rack1=document.getElementById('rack1').value;
                    var rack=$('#rack_id').val();
                    var quant1=parseInt(document.getElementById('quantity1').value);
                    var quant=parseInt(document.getElementById('quantity').value);
                    // alert(quant);
                    // alert(quant1);
                    if(quant>quant1)
                    {
                        document.getElementById('alert').innerHTML='<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Not Enough quantity in the rack</strong></div>';
                        return false;
                    }
                    if(warehouse1==warehouse && rack1==rack)
                    {
                        document.getElementById('alert').innerHTML='<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>You cannot select the same rack in the same warehouse</strong></div>';
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
            </script>
    </html>