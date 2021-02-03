<?php include('include/header_top.php'); ?>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <?php include('include/leftbar.php'); ?>
      <!-- top navigation -->
      <?php include('include/top_navigation.php'); ?>
      <!-- /top navigation -->
      <link rel="stylesheet" href="css/fancybox.css">
       <script src="js/fancybox.js"></script>
       <!-- page content -->
      <div class="right_col" role="main">
        <div class="">
          <div class="page-title">
              <div class="col-sm-6">
            <div class="title_left">
              <h3>
                  Pick List
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

                  <!--<h2><small>Product List</small></h2>-->

                  <ul class="nav navbar-right panel_toolbox">
                    <li><a href="#"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>



 <!--Content Header (Page header) -->
	<div class="pull-right" style="margin-right: 0px; margin-top: 25px;">
		<button type='submit' name='btnPrint' class='btn btn-success btn-s' style="float:right;margin-right: 0px;" value='Print' id='btnPrint' style='font-family:Arial; font-size:11px; font-weight:bold; color:#FFF; background:#73879C; border:none; padding:5px 20px;' onclick='printform();'><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</button>
	</div>

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
                $sqlSelect=mysqli_query($db_handle,"SELECT s.name,s.combo_product_id,s.product_id,od.quantity FROM tbl_order_details od LEFT JOIN tbl_sku s ON od.sku=s.id WHERE od.order_id='".$order_id."'");
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
                                        
                                        <tr> 
                                     		<th style="text-align: left">SL No.</th>        
                                            <th style="text-align: left">Warehouse</th>
                                            <th style="text-align: left">Rack</th>
                                            <!--<th style="text-align: right">Unit Price</th>-->
                                            <!--<th style="text-align: right">Available Quantity</th>-->
                                        </tr>
    									<?php 
                                            $pro_id=$sqlS->product_id;
                                            $sku=$sqlS->name;
                                            $combo_pro_id=$sqlS->combo_product_id;
                                            $q=$sqlS->quantity;
                                            $data=[];
                                            if($pro_id!=0)
                                            {
                                                // echo $pro_id;
                                              $sqlS1=mysqli_query($db_handle,"SELECT * FROM tbl_product_to_warehouse WHERE product_id='".$pro_id."' AND quantity>0 AND status=1 ORDER BY id ASC");
                                            
                                              while ($r=mysqli_fetch_object($sqlS1)) 
                                              {
                              
                                                    $quant=$r->quantity;
                                                    $ptw_id=$r->id;
                                                    if($q>$quant)
                                                    {
                                                      $q=$q-$quant;
                                                      $sqlSelect1=mysqli_fetch_object(mysqli_query($db_handle,"SELECT w.name AS warehouse,r.name AS rack,ptw.quantity,ptw.unit_price FROM tbl_product_to_warehouse ptw LEFT JOIN tbl_warehouse w ON ptw.warehouse_id=w.id LEFT JOIN tbl_rack r ON ptw.rack_id=r.id WHERE ptw.id='".$ptw_id."'"));
                                                    
                                                      
                                                      $data[]=array(
    
                                                        'warehouse'=>$sqlSelect1->warehouse,
                                                        'rack'     =>$sqlSelect1->rack,  
                                                        'quantity' =>$sqlSelect1->quantity,
                                                        'unit_price'=>$sqlSelect1->unit_price   
                                                      );
        
                                                    }
                                                    elseif($quant>=$q)
                                                    {
                                                        if($q!=0) {
                                                                                                 
                                                        $q=0;
                                                        // echo $q; 
                                                        $sqlSelect1=mysqli_fetch_object(mysqli_query($db_handle,"SELECT w.name AS warehouse,r.name AS rack,ptw.quantity,ptw.unit_price FROM tbl_product_to_warehouse ptw LEFT JOIN tbl_warehouse w ON ptw.warehouse_id=w.id LEFT JOIN tbl_rack r ON ptw.rack_id=r.id WHERE ptw.id='".$ptw_id."'"));  
                                                          $data[]=array(
    
                                                          'warehouse'=>$sqlSelect1->warehouse,
                                                          'rack'     =>$sqlSelect1->rack,  
                                                          'quantity' =>$sqlSelect1->quantity,
                                                          'unit_price'=>$sqlSelect1->unit_price   
                                                        );
                                                        }          
                                                    }   
                                               }
                                            //  }
                                                // print_r($data);
                                                $sl=1;
                                                foreach($data as $val)
                                                // while($sqlS1=mysqli_fetch_object($sqlSelect1))
                                                {   ?>
                                                    
                                                    <tr>
                                                      <td style="border-top: 1px solid #CCC;font-size: 12px;" align="left"><?=$sl?></td>
                                                      <td style="border-top: 1px solid #CCC;font-size: 12px;" align="left"><?=$val['warehouse']?></td>
                                                      <td style="border-top: 1px solid #CCC;font-size: 12px;" align="left"><?=$val['rack']?></td>
                                                      <!--<td style="border-top: 1px solid #CCC;font-size: 12px;" align="right"><?=$sqlS1->unit?></td>-->
                                                      <!--<td style="border-top: 1px solid #CCC;font-size: 12px;" align="right"><?=$val['quantity']?></td>-->
                                                    </tr>
                                    <?php       
                                                    $sl++;     
                                                }
                                            }
                                            $data=[];
                                            if($combo_pro_id!=0)
                                            {
                                                $sqlS1=mysqli_query($db_handle,"SELECT * FROM tbl_product_to_warehouse WHERE combo_product_id='".$combo_pro_id."' AND quantity>0 AND status=1 ORDER BY id ASC");
                                            
                                                  while ($r=mysqli_fetch_object($sqlS1)) 
                                                  {
                                  
                                                        $quant=$r->quantity;
                                                        $ptw_id=$r->id;
                                                        if($q>$quant)
                                                        {
                                                          $q=$q-$quant;
                                                          $sqlSelect1=mysqli_fetch_object(mysqli_query($db_handle,"SELECT w.name AS warehouse,r.name AS rack,ptw.quantity,ptw.unit_price FROM tbl_product_to_warehouse ptw LEFT JOIN tbl_warehouse w ON ptw.warehouse_id=w.id LEFT JOIN tbl_rack r ON ptw.rack_id=r.id WHERE ptw.id='".$ptw_id."'"));
                                                        
                                                          
                                                          $data[]=array(
        
                                                            'warehouse'=>$sqlSelect1->warehouse,
                                                            'rack'     =>$sqlSelect1->rack,  
                                                            'quantity' =>$sqlSelect1->quantity,
                                                            'unit_price'=>$sqlSelect1->unit_price   
                                                          );
            
                                                        }
                                                        elseif($quant>=$q)
                                                        {
                                                            if($q!=0) {
                                                                                                     
                                                            $q=0;
                                                            // echo $q; 
                                                            $sqlSelect1=mysqli_fetch_object(mysqli_query($db_handle,"SELECT w.name AS warehouse,r.name AS rack,ptw.quantity,ptw.unit_price FROM tbl_product_to_warehouse ptw LEFT JOIN tbl_warehouse w ON ptw.warehouse_id=w.id LEFT JOIN tbl_rack r ON ptw.rack_id=r.id WHERE ptw.id='".$ptw_id."'"));  
                                                              $data[]=array(
        
                                                              'warehouse'=>$sqlSelect1->warehouse,
                                                              'rack'     =>$sqlSelect1->rack,  
                                                              'quantity' =>$sqlSelect1->quantity,
                                                              'unit_price'=>$sqlSelect1->unit_price   
                                                            );
                                                            }          
                                                        }   
                                                   }
                                            //  }
                                                // print_r($data);
                                                $sl=1;
                                                foreach($data as $val)
                                                // while($sqlS1=mysqli_fetch_object($sqlSelect1))
                                                {   ?>
                                                    
                                                    <tr>
                                                      <td style="border-top: 1px solid #CCC;font-size: 12px;" align="left"><?=$sl?></td>
                                                      <td style="border-top: 1px solid #CCC;font-size: 12px;" align="left"><?=$val['warehouse']?></td>
                                                      <td style="border-top: 1px solid #CCC;font-size: 12px;" align="left"><?=$val['rack']?></td>
                                                      <!--<td style="border-top: 1px solid #CCC;font-size: 12px;" align="right"><?=$sqlS1->unit?></td>-->
                                                      <!--<td style="border-top: 1px solid #CCC;font-size: 12px;" align="right"><?=$val['quantity']?></td>-->
                                                    </tr>
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
                </div>
              </div>
            </div>
      <!--</body>-->
      <!--</html>-->
       <!-- /page content -->
        <!-- footer content -->
<?php include('include/footer.php'); ?>
<script type="text/javascript">
    function printform() {
        var printContent = document.getElementById('divPrint');
        // var windowUrl = 'about:blank';
        var uniqueName = new Date();
        var windowName = 'Print' + uniqueName.getTime();
        //var printWindow = window.open('', '', 'left=50000,top=50000,width=0,height=0');
        var printWindow = window.open('windowUrl', 'windowName', 'toolbar=no,status=no,menubar=no,scrollbars=1,directories=no');
        printWindow.document.write(printContent.innerHTML);
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
        printWindow.close();
        return false;
    }
</script>