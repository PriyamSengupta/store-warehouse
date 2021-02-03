<?php include('include/header_top.php'); ?>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      
                                                      
      <div class="right_col" role="main">

        <div class=""> 

          <div class="clearfix"></div>

          <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                
                <?php if($_REQUEST['type']=='1') { ?>
            
                <div class="x_panel">
                    <a class="pull-right" href="javascript:void(0)" id="close"><i class="fa fa-close"></i></a>
                      
                        <div class="x_content">
                          <br />
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
                                                    <strong>Challan</strong>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <?php
                                    $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_stock_transfer_warehouse WHERE id='".$_REQUEST['id']."'");
                            	    if(mysqli_num_rows($sqlQuery1)>0)
                            	    {
                            	       $record=mysqli_fetch_object($sqlQuery1);
                            	       $approved_by=mysqli_fetch_object(mysqli_query($db_handle,"SELECT fname,lname FROM tbl_user WHERE id='".$record->approved_by."'"))
                            	 ?>  
                                    <!--<tr>
                                        <td align="center" width="100%" valign="top">
                                            <table width="100%" cellspacing="5" cellpadding="0" border="0">
                                                <tr>
                                                    <td width="50%" align="left" valign="top" style="border: 1px solid #CCC; border-radius: 5px; font-family: Verdana, Geneva, sans-serif; font-size: 12px; color: #000; line-height: 18px; padding: 10px">
                                                        
                                                        
                                                        <br />
                                                	</td>
                                                	
                                                </tr>
                                              
                                            </table>
                                        </td>
                                    </tr>-->
                                
                				<tr>
                                    <td width="100%" align="center" valign="top" style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; color: #000; line-height: 18px;padding: 10px;">
                                        <table width="100%" cellspacing="5" cellpadding="0" border="0">
                                            <tr>
                                                <td width="100%">
                                                    <table width="100%" cellspacing="0" cellpadding="5" border="0">
                                    
                                                        <tr>
                                                        <td style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; color: #000; line-height: 18px;padding: 10px;">
                                                             
                                                        <table width="100%" cellspacing="5" cellpadding="0" border="0">
                                            
                                                    
                    									<tr>
                    									    <td align="left" valign="top" style="border: 1px solid #CCC; border-radius: 5px; font-family: Verdana, Geneva, sans-serif; font-size: 12px; color: #000; line-height: 18px; padding: 10px"><strong><span>SKU:</span></strong>&nbsp;<?php $sqlsku=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_sku WHERE id='".$record->sku."'")); echo $sqlsku->name;?></td>
                    									    <td align="left" valign="top" style="border: 1px solid #CCC; border-radius: 5px; font-family: Verdana, Geneva, sans-serif; font-size: 12px; color: #000; line-height: 18px; padding: 10px"><strong>Approved By:</strong>&nbsp;<span><?= $approved_by->fname.' '.$approved_by->lname ?></span></td>
                                                            
                    									</tr>
                    									<tr>        
                                                            <td align="left" valign="top" style="border: 1px solid #CCC; border-radius: 5px; font-family: Verdana, Geneva, sans-serif; font-size: 12px; color: #000; line-height: 18px; padding: 10px"><strong><span>From Warehouse:</span></strong>&nbsp;<?php $sqlsku=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_warehouse WHERE id='".$record->from_warehouse."'")); echo $sqlsku->name; ?></td>
                    									    <td align="left" valign="top" style="border: 1px solid #CCC; border-radius: 5px; font-family: Verdana, Geneva, sans-serif; font-size: 12px; color: #000; line-height: 18px; padding: 10px"><strong><span>From Rack:</span></strong>&nbsp;<?php $sqlsku=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_rack WHERE id='".$record->from_rack."'")); echo $sqlsku->name; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" valign="top" style="border: 1px solid #CCC; border-radius: 5px; font-family: Verdana, Geneva, sans-serif; font-size: 12px; color: #000; line-height: 18px; padding: 10px"><strong><span>To Warehouse:</span></strong>&nbsp;<?php $sqlsku=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_warehouse WHERE id='".$record->to_warehouse."'")); echo $sqlsku->name; ?></td>
                    									    <td align="left" valign="top" style="border: 1px solid #CCC; border-radius: 5px; font-family: Verdana, Geneva, sans-serif; font-size: 12px; color: #000; line-height: 18px; padding: 10px"><strong><span>To Rack:</span></strong>&nbsp;<?php $sqlsku=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_rack WHERE id='".$record->to_rack."'")); echo $sqlsku->name; ?></td>
                                                        </tr>
                    									<tr>
                                                            <td align="left" valign="top" style="border: 1px solid #CCC; border-radius: 5px; font-family: Verdana, Geneva, sans-serif; font-size: 12px; color: #000; line-height: 18px; padding: 10px"><strong><span>Quantity:</span></strong>&nbsp;<?=$record->stock_quant?></td>
                                                            <td align="left" valign="top" style="border: 1px solid #CCC; border-radius: 5px; font-family: Verdana, Geneva, sans-serif; font-size: 12px; color: #000; line-height: 18px; padding: 10px"><strong><span>Status:</span></strong>&nbsp;<?php if($record->sku_condition==0) { echo "Damaged"; } else { echo "Working"; } ?></td>
                                                        </tr>
                                                        
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
                     <?php } else { ?>
          
                          <div class="x_panel">
                            <a class="pull-right" href="javascript:void(0)" id="close"><i class="fa fa-close"></i></a>
                          
                            <div class="x_content">
                              <br />
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
                                                        <strong>Challan</strong>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    
                                    
                    				<tr>
                                        <td width="100%" align="center" valign="top" style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; color: #000; line-height: 18px;padding: 10px;">
                                            <table width="100%" cellspacing="5" cellpadding="0" border="0">
                                                <tr>
                                                    <td width="100%">
                                                        <table width="100%" cellspacing="0" cellpadding="5" border="0">
                                        
                                                            <tr>
                                                            <td style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; color: #000; line-height: 18px;padding: 10px;">
                                                                 
                                                            <table width="100%" cellspacing="5" cellpadding="0" border="0">
                                                <!--<tr>-->
                                                    <!--<td width="100%" align="center">-->
                                                        <!--<table width="100%" cellspacing="0" cellpadding="5" border="0">-->
                                                            <tr> 
                                                         		<th style="text-align: left">SL No.</th>
                                                         		<th style="text-align: left">SKU</th> 
                                                                <th style="text-align: left">Warehouse</th>
                                                                <th style="text-align: left">Rack</th>
                                                                <th style="text-align: right">Unit Price</th>
                                                                <th style="text-align: right">Quantity</th>
                                                            </tr>
                        										
                                                                <?php
                                                                    $sl=1;
                                                                    $order_id=$_REQUEST['id'];
                                                                    $sqlSelect=mysqli_query($db_handle,"SELECT s.name AS sku,w.name AS warehouse,r.name AS rack, po.quantity,po.unit_price FROM tbl_processed_order po LEFT JOIN tbl_sku s ON po.sku=s.id LEFT JOIN tbl_warehouse w ON po.warehouse_id=w.id LEFT JOIN tbl_rack r ON po.rack_id=r.id WHERE po.order_id='".$order_id."'");
                                                                    
                                                                    while($sqlS=mysqli_fetch_object($sqlSelect))
                                                                    { ?>
                                                                        
                                                                        <tr>
                                                                          <td style="border-top: 1px solid #CCC;font-size: 12px;" align="left"><?=$sl?></td>
                                                                          <td style="border-top: 1px solid #CCC;font-size: 12px;" align="left"><?=$sqlS->sku?></td>
                                                                          <td style="border-top: 1px solid #CCC;font-size: 12px;" align="left"><?=$sqlS->warehouse?></td>
                                                                          <td style="border-top: 1px solid #CCC;font-size: 12px;" align="left"><?=$sqlS->rack?></td>
                                                                          <td style="border-top: 1px solid #CCC;font-size: 12px;" align="right"><?=$sqlS->unit_price?></td>
                                                                          <td style="border-top: 1px solid #CCC;font-size: 12px;" align="right"><?=$sqlS->quantity?></td>
                                                                        </tr>
                                                        <?php       
                                                                   $sl++;     
                                                                    
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
                                    
                                    <?php
                                        $sqlS1=mysqli_fetch_object(mysqli_query($db_handle,"SELECT u.fname,u.lname,o.process_date FROM tbl_order o LEFT JOIN tbl_user u ON u.id=o.processed_by WHERE o.id='".$_REQUEST['id']."'"));
                                    ?>  
                                    <tr>
                                    <td align="center" width="100%" valign="top">
                                        <table width="100%" cellspacing="5" cellpadding="0" border="0">
                                            <tr>
                                                
                                            	<?php
                                            	
                                            	$sqlS2=mysqli_query($db_handle,"SELECT * FROM tbl_revised_order WHERE order_id='".$_REQUEST['id']."'");
                                            	$count=mysqli_num_rows($sqlS2);
                                            	?>
                                            	  <td width="50%" align="left" valign="top" style="border: 1px solid #CCC; border-radius: 5px; font-family: Verdana, Geneva, sans-serif; font-size: 12px; color: #000; line-height: 18px; padding: 10px">
                                                    <strong>Revised Order:</strong>
                                                    <span><?php if($count>0){ echo "Yes"; } else { echo "No"; }?></span>
                                            	  </td>
                                            	  
                                            	  <td width="50%" align="left" valign="top" style="border: 1px solid #CCC; border-radius: 5px; font-family: Verdana, Geneva, sans-serif; font-size: 12px; color: #000; line-height: 18px; padding: 10px">
                                                    
                                                    <strong>Processed By:</strong>
                                                    <span><?= $sqlS1->fname.' '.$sqlS1->lname ?></span>
                                                    <br />
                                                    <strong>Date :</strong>
                                                    <span><?=date('d F Y',strtotime($sqlS1->process_date))?></span>
                                                    <br />
                                            	</td>
                                            </tr>
                                          
                                        </table>
                                    </td>
                                </tr>
                                    
                                    </table>
                                                </div>  
                                            </div>
                                        </div>
                                        </section>
                            </div>
                          </div>
                          <?php } ?>
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
                    var quant1=document.getElementById('quantity1').value;
                    var quant=document.getElementById('quantity').value;
                    // alert(rack);
                    // alert(warehouse);
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
    </html>