<?php include('include/header_top.php'); ?>
<!--<style>-->
<!--    td, th {-->
<!--    border: 1px solid #dddddd;-->
    
<!--}-->

<!--</style>-->

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
       if (!(in_array("20",$permission))) { 
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
                 Process Order
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
                    <a href="order_list.php?id=1" class="btn btn-info btn-s" style="float:right;"><i class="fa fa-history"></i> Back to List</a>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>

          <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">

              <div class="x_panel">

                <div class="x_title">

                  <h2>Process<small>Order</small></h2>

                  <ul class="nav navbar-right panel_toolbox">

                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>

                    </li>

                    <li><a class="close-link"><i class="fa fa-close"></i></a>

                    </li>

                  </ul>

                  <div class="clearfix"></div>

                </div>

                <div class="x_content" style="margin-top: 0px;">

                  <br />
                <?php
                    $sqldata=mysqli_fetch_object(mysqli_query($db_handle,"SELECT * FROM tbl_order WHERE id='".$_REQUEST['id']."'"));
                ?>
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="processorder.php" method="post">
                    
                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand_name">Buyer Name:<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="name" name="name" placeholder="Buyer Name" value="<?=$sqldata->ws_name?>" required="required" class="form-control col-md-7 col-xs-12" disabled>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand_name">Comment: <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="quant" name="quant" placeholder="Comment" required="required" class="form-control col-md-7 col-xs-12" disabled><?=$sqldata->comment?></textarea>
                      </div>
                    </div>
          
                    <input type="hidden" id="order_id" name="order_id" value="<?=$_REQUEST['id']?>">
                    <!--<div class="col-md-12 col-sm-12 col-xs-12">-->
                <!--          <h4 style="margin-bottom: 16px;">Seller Info:</h4>-->
                <!--        <div class="col-md-6 col-sm-6 col-xs-12" >-->
                <!--            <label class="control-label col-md-2 col-sm-2 col-xs-4" for="name">Name<span class="required">*</span>-->
                <!--            </label>-->
                <!--            <div class="col-md-6 col-sm-6 col-xs-12">-->
                <!--                <input type="text" id="name" name="name" placeholder="Seller Name" required="required" class="form-control col-md-4 col-sm-4 col-xs-8">-->
                <!--            </div>-->
                <!--        </div>-->
                    
                <!--    <div class="col-md-6 col-sm-6 col-xs-12" >-->
                <!--       <div class="col-md-6 col-sm-6 col-xs-12" >-->
                <!--            <label class="control-label col-md-3 col-sm-3 col-xs-4" for="name">Comment<span class="required">*</span>-->
                <!--            </label>-->
                <!--            <div class="col-md-6 col-sm-6 col-xs-12">-->
                <!--                <textarea id="name" name="comment" placeholder="Comment" class="form-control col-md-4 col-sm-4 col-xs-8"></textarea>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                    
                   
                    <!--<div class="clearfix"></div>-->
                    
                    <br>
                    <!--<div class="x_title">-->
                    
                    <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px 20px;">
                        <h4>Ordered SKU(s):</h4>
                    </div>
                    <br>
                    <br>
                    <!--</div>-->
                    <!--<div class="x_content">-->
                          
                     <div class="col-md-12 col-sm-12 col-xs-12">
                    
                    <section class="content" id="divPrint">
                      <div class="row" >
                        <div class="col-xs-12">
                          <div>
                                <table class="" width="100%" cellspacing="0" cellpadding="0" border="1">
                                    
                                    <tr>
                                        <td width="100%" align="center">
                                            <table width="100%" cellspacing="5" cellpadding="0" border="0">
                                                <tr>
                                                    <td width="100%" colspan="2" align="center" valign="middle" height="25" style="font-family: Verdana, Geneva, sans-serif; font-size: 14px; font-weight: bold; border: 1px solid #CCC; border-radius: 5px;">
                                                        <strong>PICK LIST</strong>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                    
                                    <?php
                                    
                                    $order_id=$_REQUEST['id'];
                                    $sqlSelect=mysqli_query($db_handle,"SELECT s.id,s.name,s.combo_product_id,s.product_id,od.quantity FROM tbl_order_details od LEFT JOIN tbl_sku s ON od.sku=s.id WHERE od.order_id='".$order_id."'");
                                    // echo mysqli_num_rows($sqlSelect);
                                    while($sqlS=mysqli_fetch_object($sqlSelect))
                                    { ?>
                                    <!--<?=$sqlS->product_id?>-->
                    				<tr>
                                        <td width="100%" align="center" valign="top" style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; color: #000; line-height: 18px;padding: 10px;">
                                            <table width="100%" cellspacing="5" cellpadding="0" border="0">
                                                <tr>
                                                    <td width="100%">
                                                        <table width="100%" cellspacing="0" cellpadding="5" border="0">
                                        
                                                            <tr>
                                                            <td style="border: 1px solid #CCC;text-align:left;font-size: 12px;" width="20%"><strong>SKU:&nbsp;</strong><?=$sqlS->name ?><br><strong>Ordered Quantity: </strong><?=$sqlS->quantity?></td>
                                                            </tr>
                                                            <tr>
                                                            <td style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; color: #000; line-height: 18px;padding: 10px;">
                                                                 
                                                            <table id="datatable-responsive" class="table table-striped table-bordered" cellspacing="0" width="100%">     
                                                            <!--<table width="100%" cellspacing="5" cellpadding="0" border="0">-->
                                               
                                                            <tr> 
                                                         		<th style="width: 16%; text-align: center" >SL No.</th>        
                                                                <th style="width: 17%; text-align: center">Warehouse</th>
                                                                <th style="width: 17%; text-align: center">Rack</th>
                                                                <th style="width: 17%; text-align: center">Edit Quantity</th>
                                                                <th style="text-align: center;width: 16%;">Action</th>
                                                                <!--<th style="text-align: center;width: 17%;">Available Quantity</th>-->
                                                            </tr>
                        										<?php 
                        										$sl=1;
                                                                $pro_id=$sqlS->product_id;
                                                                $sku=$sqlS->name;
                                                                $combo_pro_id=$sqlS->combo_product_id;
                                                                
                                                                if($pro_id!=0)
                                                                {
                                                                    // echo $pro_id;
                                                                    $sqlSelect1=mysqli_query($db_handle,"SELECT w.name,ptw.warehouse_id FROM tbl_warehouse w LEFT JOIN tbl_product_to_warehouse ptw ON w.id=ptw.warehouse_id WHERE ptw.product_id='".$pro_id."' AND ptw.status='1' AND ptw.quantity!=0 GROUP BY ptw.warehouse_id");
                                                                    
                                                                    //$sqlSelect1=mysqli_query($db_handle,"SELECT w.name,GROUP_CONCAT(r.name separator '<br>') rack,GROUP_CONCAT(ptw.quantity separator '<br>') quant,GROUP_CONCAT(ptw.unit_price separator '<br>') unit FROM tbl_product_to_warehouse ptw LEFT JOIN tbl_warehouse w ON ptw.warehouse_id=w.id LEFT JOIN tbl_rack r ON ptw.rack_id=r.id WHERE ptw.product_id='".$pro_id."' AND ptw.quantity!='0' AND ptw.status='1' GROUP BY ptw.warehouse_id");
                                                                    // echo mysqli_num_rows($sqlSelect1);
                                                                    while($sqlS1=mysqli_fetch_object($sqlSelect1))
                                                                    {   
                                                                        $sqlSelect2=mysqli_query($db_handle,"SELECT r.name AS rack,ptw.rack_id,ptw.quantity,ptw.id FROM tbl_rack r LEFT JOIN tbl_product_to_warehouse ptw ON r.id=ptw.rack_id WHERE ptw.product_id='".$pro_id."' AND ptw.warehouse_id='".$sqlS1->warehouse_id."' AND ptw.quantity!='0' AND ptw.status='1'");
                                                                        $count1=mysqli_num_rows($sqlSelect2);
                                                                    ?>
                                                                        
                                                                        <tr>
                                                                          <td rowspan="<?=$count1?>" style="border: 1px solid #CCC;font-size: 12px;" ><?=$sl?></td>
                                                                          <td rowspan="<?=$count1?>" style="border: 1px solid #CCC;font-size: 12px;" ><?=$sqlS1->name?></td>
                                                                          <!--<td  style="border-top: 1px solid #CCC;font-size: 12px;" >dfsdf</td>-->
                                                                          <!--<td  style="border-top: 1px solid #CCC;font-size: 12px;" >dfsdf</td>-->
                                                                        
                                                                          <?php
                                                                          $sl1=0;
                                                                          while($sqlS2=mysqli_fetch_object($sqlSelect2)) { 
                                                                          if($sl1>0){ echo "<tr>"; } ?>
                                                                          <td  style="border: 1px solid #CCC;font-size: 12px;" ><?=$sqlS2->rack?></td>
                                                                          <td  style="border: 1px solid #CCC;font-size: 12px;" ><input type="number" min="0" id="quantity<?=$sqlS2->id?>" name="quantity[]" value="0" readonly="" onkeyup="check_quant(<?=$sqlS2->id?>)"><input type="hidden" value="<?=$sqlS2->id?>" name="ptw_id[]"><input type="hidden" value="<?=$sqlS2->quantity?>" id="rack_quant<?=$sqlS2->id?>" name="rack_quant[]"><input type="hidden" value="" id="flag<?=$sqlS2->id?>" name="flag[]"><input type="hidden" name="sku[]" value="<?=$sqlS->id?>"></td>
                                                                          <td  style="border: 1px solid #CCC;font-size: 12px;" align="center" ><a href="javascript:void(0)" onclick="enable_box(<?=$sqlS2->id?>)">Edit</a></td>
                                                                          <!--<td  style="border: 1px solid #CCC;font-size: 12px;" align="center"><?=$sqlS2->quantity?></td>-->
                                                                          </tr>
                                                                          <?php $sl1++;
                                                                          } ?>
                                                                        
                                                                        <!-- <tr>-->
                                                                          
                                                                        <!--  <td  style="border-top: 1px solid #CCC;font-size: 12px;" >dfsdf</td>-->
                                                                        <!--  <td  style="border-top: 1px solid #CCC;font-size: 12px;" >dfsdf</td>-->
                                                                        
                                                                        <!--</tr>-->
                                                                        
                                                                        
                                                        <?php       
                                                                   $sl++;     
                                                                    }
                                                                } 
                                                                if($combo_pro_id!=0)
                                                                {
                                                                    // echo $pro_id;
                                                                    $sqlSelect1=mysqli_query($db_handle,"SELECT w.name,ptw.warehouse_id FROM tbl_warehouse w LEFT JOIN tbl_product_to_warehouse ptw ON w.id=ptw.warehouse_id WHERE ptw.combo_product_id='".$combo_pro_id."' AND ptw.quantity!=0 AND ptw.status='1' GROUP BY ptw.warehouse_id");
                                                                    
                                                                    //$sqlSelect1=mysqli_query($db_handle,"SELECT w.name,GROUP_CONCAT(r.name separator '<br>') rack,GROUP_CONCAT(ptw.quantity separator '<br>') quant,GROUP_CONCAT(ptw.unit_price separator '<br>') unit FROM tbl_product_to_warehouse ptw LEFT JOIN tbl_warehouse w ON ptw.warehouse_id=w.id LEFT JOIN tbl_rack r ON ptw.rack_id=r.id WHERE ptw.product_id='".$pro_id."' AND ptw.quantity!='0' AND ptw.status='1' GROUP BY ptw.warehouse_id");
                                                                    // echo mysqli_num_rows($sqlSelect1);
                                                                    while($sqlS1=mysqli_fetch_object($sqlSelect1))
                                                                    {   
                                                                        $sqlSelect2=mysqli_query($db_handle,"SELECT r.name AS rack,ptw.rack_id,ptw.quantity,ptw.id FROM tbl_rack r LEFT JOIN tbl_product_to_warehouse ptw ON r.id=ptw.rack_id WHERE ptw.combo_product_id='".$combo_pro_id."' AND ptw.warehouse_id='".$sqlS1->warehouse_id."' AND ptw.quantity!='0' AND ptw.status='1'");
                                                                        $count1=mysqli_num_rows($sqlSelect2);
                                                                    ?>
                                                                        
                                                                        <tr>
                                                                          <td rowspan="<?=$count1?>" style="border: 1px solid #CCC;font-size: 12px;" align="center"><?=$sl?></td>
                                                                          <td rowspan="<?=$count1?>" style="border: 1px solid #CCC;font-size: 12px;" align="center"><?=$sqlS1->name?></td>
                                                                          <!--<td  style="border-top: 1px solid #CCC;font-size: 12px;" >dfsdf</td>-->
                                                                          <!--<td  style="border-top: 1px solid #CCC;font-size: 12px;" >dfsdf</td>-->
                                                                        
                                                                          <?php
                                                                          $sl1=0;
                                                                          while($sqlS2=mysqli_fetch_object($sqlSelect2)) { 
                                                                          if($sl1>0){ echo "<tr>"; } ?>
                                                                          <td  style="border: 1px solid #CCC;font-size: 12px;" align="center"><?=$sqlS2->rack?></td>
                                                                          <td  style="border: 1px solid #CCC;font-size: 12px;" align="center"><input type="number" min="0" id="quantity<?=$sqlS2->id?>" name="quantity[]" value="0" readonly="" onkeyup="check_quant(<?=$sqlS2->id?>)"><input type="hidden" value="<?=$sqlS2->id?>" name="ptw_id[]"><input type="hidden" value="<?=$sqlS2->quantity?>" id="rack_quant<?=$sqlS2->id?>" name="rack_quant[]"><input type="hidden" value="" id="flag<?=$sqlS2->id?>" name="flag[]"><input type="hidden" name="sku[]" value="<?=$sqlS->id?>"></td>
                                                                          <td  style="border: 1px solid #CCC;font-size: 12px;" align="center" ><a href="javascript:void(0)" onclick="enable_box(<?=$sqlS2->id?>)">Edit</a></td>
                                                                          <!--<td  style="border: 1px solid #CCC;font-size: 12px;" align="center"><?=$sqlS2->quantity?></td>-->
                                                                          </tr>
                                                                          <?php $sl1++;
                                                                          } ?>
                                                                        
                                                                        <!-- <tr>-->
                                                                          
                                                                        <!--  <td  style="border-top: 1px solid #CCC;font-size: 12px;" >dfsdf</td>-->
                                                                        <!--  <td  style="border-top: 1px solid #CCC;font-size: 12px;" >dfsdf</td>-->
                                                                        
                                                                        <!--</tr>-->
                                                                        
                                                                        
                                                        <?php       
                                                                   $sl++;     
                                                                    }
                                                                } ?>
                                                            
                                                            </table>
                                                             </td>
                                                            </tr>
                                                             
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    </table>
                                                </div>  
                                            </div>
                                        </div>
                                        </section>
                    
                    </div>
                
                <div class="clearfix"></div>
                <br/><br/>
                
                    <!--</div>    -->
                        
                    <!--<div class="ln_solid"></div>-->

                    <div class="form-group">

                      <div class="col-md-12 col-sm-12 col-xs-12">
                      	<button type="submit" class="btn btn-primary" name="add" style="float:right">Process Order</button>
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
        
        <script>
            function enable_box(id)
            {
                // alert(id);
                
                $('#quantity'+id).prop("readonly", false);
                document.getElementById('quantity'+id).value="";
                $('#flag'+id).val('1');
            }
            function check_quant(id)
            {
                // alert(id);
                var quant=parseInt(document.getElementById('quantity'+id).value);
                var rack_quant=parseInt(document.getElementById('rack_quant'+id).value);
                // alert(rack_quant);
                
                if(quant>rack_quant)
                {
                    alert("Not enough quantity in stock");
                    document.getElementById('quantity'+id).value='';
                }
                
            }
        </script>
        </body>
</html>