<?php
	session_start();

	if(@$_SESSION['valid_admin'] == "" )
	{

		@header("Location:login.php");
	}

	include_once("include/inc.php");
	
    if(isset($_REQUEST['type'])) 
    {
        $date = date('Y-m-d');
        $sku=$_REQUEST['sku']; 
        $role=$_SESSION['role'];
		$sqlrole=mysqli_fetch_object(mysqli_query($db_handle,"SELECT access_permission,modify_permission FROM tbl_usergroup WHERE id='".$role."'"));
		$access_permission=$sqlrole->access_permission;
		$permission=explode(",",$access_permission);
		
		$strt_date=$_REQUEST['start_dt'];
        $end_date=$_REQUEST['end_dt'];
        
    if($_REQUEST['type']=='1') { ?>
      <h4><u>Opening Stock</u></h4>

    
            <table id="datatable-brand" class="table table-striped table-bordered abc">
               
                    <thead>

                      <tr>
                       <!--<th>Sl No.</th>-->
                        <th>SKU</th>
                        <th>Warehouse</th>
                        <th>Rack</th>
                        <?php if((in_array("21",$permission))) { ?><th>Unit Price</th><?php } ?>
                        <th>Quantity</th>
                        <?php if((in_array("21",$permission))) { ?><th>Total Price</th><?php } ?>
                        <th>Status</th>
                      </tr>

                    </thead>

                    <tbody>
                        
                    <?php 
                    
                    if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']==''){
                        $sqlSS=mysqli_query($db_handle,"SELECT * FROM tbl_opening_stock WHERE sku='".$sku."'");
                    }
                    if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']=='')
                    {
                        $start_dt=date("Y-m-d", strtotime($strt_date) );
                        $sqlSS=mysqli_query($db_handle,"SELECT * FROM tbl_opening_stock WHERE sku='".$sku."' AND DATE(date)>='".$start_dt."'");
                    }
                    if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']!='')
                    {
                         $end_dt=date("Y-m-d", strtotime($end_date));
                        $sqlSS=mysqli_query($db_handle,"SELECT * FROM tbl_opening_stock WHERE sku='".$sku."' AND DATE(date)<='".$end_dt."'");
                    }
                    if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']!='')
                    {
                        $end_dt=date("Y-m-d", strtotime($end_date));
                        $start_dt=date("Y-m-d", strtotime($strt_date));
                        $sqlSS=mysqli_query($db_handle,"SELECT * FROM tbl_opening_stock WHERE sku='".$sku."' AND (DATE(date) BETWEEN '".$start_dt."' AND '".$end_dt."')");
                    }    
                    // $sl=1;
                    while($record=mysqli_fetch_object($sqlSS))
                    { ?>
                        <tr>
                            <!--<td><?=$sl?></td>-->
                            <td><?php $sqlsku=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_sku WHERE id='".$record->sku."'")); echo $sqlsku->name;?></td>
                            <td><?php $sqlsku=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_warehouse WHERE id='".$record->warehouse_id."'")); echo $sqlsku->name; ?></td>
	                        <td><?php $sqlsku=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_rack WHERE id='".$record->rack_id."'")); echo $sqlsku->name; ?></td>
                            <?php if((in_array("21",$permission))) { ?><td><i class="fa fa-rupee" style="font-size:15px"></i>&nbsp;<?=$record->unit_price?></td><?php } ?>
                            <td><?=$record->quantity?></td>
                            <?php if((in_array("21",$permission))) { ?><td><i class="fa fa-rupee" style="font-size:15px"></i>&nbsp;<?=$record->total_price?></td><?php } ?>
                            <td>
                               <?php if($record->status==0) {
	                           
            	                    echo "<button class='btn btn-danger btn-xs'>Damaged</button>";  
            	               }
            	               else
            	               {
            	                    echo "<button class='btn btn-success btn-xs'>Working</button>";
            	               }
            	               ?>    
                            </td>
                        </tr>
                    <?php
                    $sl++;
                        
                    }
                    
                    ?>
                    </tbody>
                    </table>
        <?php } if($_REQUEST['type']=='3') { ?>            
                    
            <h4><u>Closing Stock</u></h4>

    
            <table id="datatable-brand" class="table table-striped table-bordered abc">
               
                    <thead>

                      <tr>
                       <!--<th>Sl No.</th>-->
                        <th>SKU</th>
                        <th>Warehouse</th>
                        <th>Rack</th>
                        <?php if((in_array("21",$permission))) { ?><th>Unit Price</th><?php } ?>
                        <th>Quantity</th>
                        <?php if((in_array("21",$permission))) { ?><th>Total Price</th><?php } ?>
                        <th>Status</th>
                      </tr>

                    </thead>

                    <tbody>
                        
                    <?php 
                    if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']==''){
                        $sqlSS=mysqli_query($db_handle,"SELECT * FROM tbl_closing_stock WHERE sku='".$sku."' AND quantity!='0'");
                    }
                    if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']=='')
                    {
                        $start_dt=date("Y-m-d", strtotime($strt_date));
                        $sqlSS=mysqli_query($db_handle,"SELECT * FROM tbl_closing_stock WHERE sku='".$sku."' AND quantity!='0' AND DATE(date)>='".$start_dt."'");
                    }
                    if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']!='')
                    {
                        $end_dt=date("Y-m-d", strtotime($end_date));
                        $sqlSS=mysqli_query($db_handle,"SELECT * FROM tbl_closing_stock WHERE sku='".$sku."' AND quantity!='0' AND DATE(date)<='".$end_dt."'");
                    }
                    if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']!='')
                    {
                        $end_dt=date("Y-m-d", strtotime($end_date));
                        $start_dt=date("Y-m-d", strtotime($strt_date));
                        // echo $start_dt."<br>".$end_dt;
                        $sqlSS=mysqli_query($db_handle,"SELECT * FROM tbl_closing_stock WHERE sku='".$sku."' AND quantity!='0' AND (DATE(date) BETWEEN '".$start_dt."' AND '".$end_dt."')");
                        // echo $sku;
                    }    
                    // $sl=1;
                    while($record=mysqli_fetch_object($sqlSS))
                    { ?>
                        <tr>
                            <!--<td><?=$sl?></td>-->
                            <td><?php $sqlsku=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_sku WHERE id='".$record->sku."'")); echo $sqlsku->name;?></td>
                            <td><?php $sqlsku=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_warehouse WHERE id='".$record->warehouse_id."'")); echo $sqlsku->name; ?></td>
	                        <td><?php $sqlsku=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_rack WHERE id='".$record->rack_id."'")); echo $sqlsku->name; ?></td>
                            <?php if((in_array("21",$permission))) { ?><td><i class="fa fa-rupee" style="font-size:15px"></i>&nbsp;<?=$record->unit_price?></td><?php } ?>
                            <td><?=$record->quantity?></td>
                            <?php if((in_array("21",$permission))) { ?><td><i class="fa fa-rupee" style="font-size:15px"></i>&nbsp;<?=$record->total_price?></td><?php } ?>
                            <td>
                                <?php if($record->status==0) {
	                           
            	                    echo "<button class='btn btn-danger btn-xs'>Damaged</button>";  
            	               }
            	               else
            	               {
            	                    echo "<button class='btn btn-success btn-xs'>Working</button>";
            	               }
            	               ?>    
                            </td>
                        </tr>
                    <?php
                    $sl++;
                        
                    }
                    
                    ?>
                    </tbody>
                    </table>    
                    
                    
<?php } if($_REQUEST['type']=='2') { ?>

        <h4><u>Stock In</u></h4>

            <table id="datatable-brand" class="table table-striped table-bordered abc">
               
                    <thead>

                      <tr>
                       <!--<th>Sl No.</th>-->
                        <th>SKU</th>
                        <th>Warehouse</th>
                        <th>Rack</th>
                        <?php if((in_array("21",$permission))) { ?><th>Unit Price</th><?php } ?>
                        <th>Quantity</th>
                        <?php if((in_array("21",$permission))) { ?><th>Total Price</th><?php } ?>
                        <th>Status</th>
                        <th>Type</th>
                        <!--<th>Created On</th>-->
                      </tr>

                    </thead>

                    <tbody>
                        
                    <?php
                    if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']==''){
                        $sqlSS=mysqli_query($db_handle,"SELECT * FROM tbl_stock_in WHERE sku='".$sku."'");
                    }
                    if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']=='')
                    {
                        $start_dt=date("Y-m-d", strtotime($strt_date));
                        $sqlSS=mysqli_query($db_handle,"SELECT * FROM tbl_stock_in WHERE sku='".$sku."' AND DATE(creation_date)>='".$start_dt."'");
                    }
                    if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']!='')
                    {
                        $end_dt=date("Y-m-d", strtotime($end_date));    
                        $sqlSS=mysqli_query($db_handle,"SELECT * FROM tbl_stock_in WHERE sku='".$sku."' AND DATE(creation_date)<='".$end_dt."'");
                    }
                    if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']!='')
                    {
                        $end_dt=date("Y-m-d", strtotime($end_date));
                        $start_dt=date("Y-m-d", strtotime($strt_date));
                        $sqlSS=mysqli_query($db_handle,"SELECT * FROM tbl_stock_in WHERE sku='".$sku."' AND (DATE(creation_date) BETWEEN '".$start_dt."' AND '".$end_dt."')");
                        
                    }    
                    // $sl=1;
                    // echo mysqli_num_rows($sqlSS);
                    while($record=mysqli_fetch_object($sqlSS))
                    { 
                        $data[]=array(
                            
                            'sku'=>$sku,
                            'warehouse'=>$record->warehouse_id,
                            'rack'=>$record->rack_id,
                            'unit_price'=>$record->unit_price,
                            'quantity'=>$record->quantity,
                            'total_price'=>$record->total_price,
                            'type'=>$record->type,
                            'status'=>$record->status
                            // 'creation_date'=>$record->creation_date
                            );
                    }
                    
                    if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']==''){
                        $sqlSS1=mysqli_query($db_handle,"SELECT * FROM tbl_returned_product WHERE sku='".$sku."'");
                    }
                    if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']=='')
                    {
                        $start_dt=date("Y-m-d", strtotime($strt_date));
                        $sqlSS1=mysqli_query($db_handle,"SELECT * FROM tbl_returned_product WHERE sku='".$sku."' AND DATE(creation_date)>='".$start_dt."'");
                    }
                    if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']!='')
                    {
                        $end_dt=date("Y-m-d", strtotime($end_date));    
                        $sqlSS1=mysqli_query($db_handle,"SELECT * FROM tbl_returned_product WHERE sku='".$sku."' AND DATE(creation_date)<='".$end_dt."'");
                    }
                    if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']!='')
                    {
                        $end_dt=date("Y-m-d", strtotime($end_date));
                        $start_dt=date("Y-m-d", strtotime($strt_date));
                        $sqlSS1=mysqli_query($db_handle,"SELECT * FROM tbl_returned_product WHERE sku='".$sku."' AND (DATE(creation_date) BETWEEN '".$start_dt."' AND '".$end_dt."')");
                        
                    }
                    
                    // $sqlSS1=mysqli_query($db_handle,"SELECT * FROM tbl_returned_product WHERE sku='".$sku."' AND DATE(creation_date) ='".$date."'");
                    while($record1=mysqli_fetch_object($sqlSS1))
                    {
                        $data[]=array(
                            
                            'sku'=>$sku,
                            'warehouse'=>$record1->warehouse_id,
                            'rack'=>$record1->rack_id,
                            'unit_price'=>$record1->unit_price,
                            'quantity'=>$record1->quantity,
                            'total_price'=>$record1->total_price,
                            'type'=>0,
                            'status'=>$record1->status
                            // 'creation_date'=>$record1->creation_date
                            );
                    }
                    foreach($data as $val)
                    { 
                        
                    ?>
                    <tr>
                        <td><?php $sqlsku=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_sku WHERE id='".$val['sku']."'")); echo $sqlsku->name;?></td>
                        <td><?php $sqlwh=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_warehouse WHERE id='".$val['warehouse']."'")); echo $sqlwh->name;?></td>
                        <td><?php $sqlrck=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_rack WHERE id='".$val['rack']."'")); echo $sqlrck->name;?></td>
                        <?php if((in_array("21",$permission))) { ?><td><i class="fa fa-rupee" style="font-size:15px"></i>&nbsp;<?=$val['unit_price']?></td><?php } ?>
                        <td><?=$val['quantity']?></td>
                        <?php if((in_array("21",$permission))) { ?><td><i class="fa fa-rupee" style="font-size:15px"></i>&nbsp;<?=$val['total_price']?></td><?php } ?>
                        <td>
                            <?php if($val['status']==0) {
	                           
            	                    echo "<button class='btn btn-danger btn-xs'>Damaged</button>";  
            	               }
            	               else
            	               {
            	                    echo "<button class='btn btn-success btn-xs'>Working</button>";
            	               }
            	               ?>
                            
                        </td>
                        <td>
                            <?php if($val['type']==0) 
                            { 
                                echo "<button class='btn btn-primary btn-xs'>Return</button>"; 
                            }
                            elseif($val['type']==1) 
                            { 
                                echo "<button class='btn btn-info btn-xs'>Inward Transaction</button>"; 
                            }
                            else
                            {
                                echo "<button class='btn btn-success btn-xs'>Inward Adjustment</button>"; 
                            }?>
                        </td>
                        <!--<td><?=date("d F Y",strtotime($val['creation_date'])); ?></?></td>-->
                    </tr>    
                    <?php
                    }
                    ?>
                    </tbody>
                    </table>


<?php } if($_REQUEST['type']=='4') { ?> 
            
            <h4><u>Stock Out</u></h4>

            <!--<p id="date_filter">-->
            <!--    <span id="date-label-from" class="date-label">From: </span><input class="date_range_filter date" type="text" id="datepicker_from" />-->
            <!--    <span id="date-label-to" class="date-label">To:<input class="date_range_filter date" type="text" id="datepicker_to" />-->
            <!--</p>-->
            <table id="datatable-brand" class="table table-striped table-bordered abc">
               
                    <thead>

                      <tr>
                       <!--<th>Sl No.</th>-->
                        <th>SKU</th>
                        <th>Buyer</th>
                        <th>Comment/Reason</th>
                        <!--<th>Processing Date</th>-->
                        <th>From Warehouse</th>
                        <th>From Rack</th>
                        <?php if((in_array("21",$permission))) { ?><th>Unit Price</th><?php } ?>
                        <th>Quantity</th>
                        <th>Type</th>
                        <!--<th>Total Price</th>-->
                        
                      </tr>

                    </thead>

                    <tbody>
                        
                    <?php 
                    if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']==''){
                        $sqls=mysqli_query($db_handle,"SELECT po.id,po.order_id FROM tbl_processed_order po LEFT JOIN tbl_order o ON o.id=po.order_id WHERE po.sku='".$sku."'");
                    }
                    if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']=='')
                    {
                        $start_dt=date("Y-m-d", strtotime($strt_date));
                        $sqls=mysqli_query($db_handle,"SELECT po.id,po.order_id FROM tbl_processed_order po LEFT JOIN tbl_order o ON o.id=po.order_id WHERE po.sku='".$sku."' AND DATE(o.process_date)>='".$start_dt."'");  
                    }
                    if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']!='')
                    {
                        $end_dt=date("Y-m-d", strtotime($end_date));
                        $sqls=mysqli_query($db_handle,"SELECT po.id,po.order_id FROM tbl_processed_order po LEFT JOIN tbl_order o ON o.id=po.order_id WHERE po.sku='".$sku."' AND DATE(o.process_date)<='".$end_dt."'");
                    }
                    if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']!='')
                    {
                        $end_dt=date("Y-m-d", strtotime($end_date));
                        $start_dt=date("Y-m-d", strtotime($strt_date));
                        $sqls=mysqli_query($db_handle,"SELECT po.id,po.order_id FROM tbl_processed_order po LEFT JOIN tbl_order o ON o.id=po.order_id WHERE po.sku='".$sku."' AND (DATE(o.process_date) BETWEEN '".$start_dt."' AND '".$end_dt."')");
                    }    
                    while($rec=mysqli_fetch_object($sqls))
                    {
                        $order_id=$rec->order_id;
                        $sqls1=mysqli_fetch_object(mysqli_query($db_handle,"SELECT s.name AS sku,w.name AS warehouse,r.name AS rack,o.ws_name,o.comment,po.unit_price,po.quantity,o.process_date FROM tbl_processed_order po LEFT JOIN tbl_order o ON po.order_id=o.id LEFT JOIN tbl_warehouse w ON po.warehouse_id=w.id LEFT JOIN tbl_rack r ON po.rack_id=r.id LEFT JOIN tbl_sku s ON po.sku=s.id WHERE po.sku='".$sku."' AND po.order_id='".$order_id."' AND po.id='".$rec->id."'"));
                        
                        $data[]=array(
                            
                            'sku'=>$sqls1->sku,
                            'buyer'=>$sqls1->ws_name,
                            'comment'=>$sqls1->comment,
                            'warehouse'=>$sqls1->warehouse,
                            'rack'=>$sqls1->rack,
                            'unit_price'=>$sqls1->unit_price,
                            'quantity'=>$sqls1->quantity,
                            'type'=>'Outward'
                            );
                    } 
                    if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']==''){
                        $sqls2=mysqli_query($db_handle,"SELECT w.name AS warehouse,r.name AS rack,s.name AS sku,st.unit_price,st.quantity,st.reason FROM tbl_shortage_transaction st LEFT JOIN tbl_sku s ON st.sku=s.id LEFT JOIN tbl_warehouse w ON st.from_warehouse=w.id LEFT JOIN tbl_rack r ON st.from_rack=r.id WHERE st.sku='".$sku."'");
                    }
                    if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']=='')
                    {
                        $start_dt=date("Y-m-d", strtotime($strt_date));
                        $sqls2=mysqli_query($db_handle,"SELECT w.name AS warehouse,r.name AS rack,s.name AS sku,st.unit_price,st.quantity,st.reason FROM tbl_shortage_transaction st LEFT JOIN tbl_sku s ON st.sku=s.id LEFT JOIN tbl_warehouse w ON st.from_warehouse=w.id LEFT JOIN tbl_rack r ON st.from_rack=r.id WHERE st.sku='".$sku."' AND DATE(st.creation_date)>='".$start_dt."'");
                    }
                    if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']!='')
                    {
                        $end_dt=date("Y-m-d", strtotime($end_date));
                        $sqls2=mysqli_query($db_handle,"SELECT w.name AS warehouse,r.name AS rack,s.name AS sku,st.unit_price,st.quantity,st.reason FROM tbl_shortage_transaction st LEFT JOIN tbl_sku s ON st.sku=s.id LEFT JOIN tbl_warehouse w ON st.from_warehouse=w.id LEFT JOIN tbl_rack r ON st.from_rack=r.id WHERE st.sku='".$sku."' AND DATE(st.creation_date)<='".$end_dt."'");
                    }
                    if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']!='')
                    {
                        $end_dt=date("Y-m-d", strtotime($end_date));
                        $start_dt=date("Y-m-d", strtotime($strt_date));
                        $sqls2=mysqli_query($db_handle,"SELECT w.name AS warehouse,r.name AS rack,s.name AS sku,st.unit_price,st.quantity,st.reason FROM tbl_shortage_transaction st LEFT JOIN tbl_sku s ON st.sku=s.id LEFT JOIN tbl_warehouse w ON st.from_warehouse=w.id LEFT JOIN tbl_rack r ON st.from_rack=r.id WHERE st.sku='".$sku."' AND (DATE(st.creation_date) BETWEEN '".$start_dt."' AND '".$end_dt."')");
                    }    
                    
                    while($rec1=mysqli_fetch_object($sqls2))
                    {
                        $data[]=array(
                            
                            'sku'=>$rec1->sku,
                            'buyer'=>'NA',
                            'comment'=>$rec1->reason,
                            'warehouse'=>$rec1->warehouse,
                            'rack'=>$rec1->rack,
                            'unit_price'=>$rec1->unit_price,
                            'quantity'=>$rec1->quantity,
                            'type'=>'Shortage'
                            );
                    }
                    if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']==''){
                        $sqls3=mysqli_query($db_handle,"SELECT w.name AS warehouse,r.name AS rack,s.name AS sku,o.buyer,o.unit_price,o.quantity FROM tbl_outward_adjustment o LEFT JOIN tbl_sku s ON o.sku=s.id LEFT JOIN tbl_warehouse w ON o.warehouse_id=w.id LEFT JOIN tbl_rack r ON o.rack_id=r.id WHERE o.sku='".$sku."'");
                    }
                    if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']=='')
                    {
                        $start_dt=date("Y-m-d", strtotime($strt_date));
                        $sqls3=mysqli_query($db_handle,"SELECT w.name AS warehouse,r.name AS rack,s.name AS sku,o.buyer,o.unit_price,o.quantity FROM tbl_outward_adjustment o LEFT JOIN tbl_sku s ON o.sku=s.id LEFT JOIN tbl_warehouse w ON o.warehouse_id=w.id LEFT JOIN tbl_rack r ON o.rack_id=r.id WHERE o.sku='".$sku."' AND DATE(o.creation_date)>='".$start_dt."'");
                    }
                    if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']!='')
                    {
                        $end_dt=date("Y-m-d", strtotime($end_date));
                        $sqls3=mysqli_query($db_handle,"SELECT w.name AS warehouse,r.name AS rack,s.name AS sku,o.buyer,o.unit_price,o.quantity FROM tbl_outward_adjustment o LEFT JOIN tbl_sku s ON o.sku=s.id LEFT JOIN tbl_warehouse w ON o.warehouse_id=w.id LEFT JOIN tbl_rack r ON o.rack_id=r.id WHERE o.sku='".$sku."' AND DATE(o.creation_date)<='".$end_dt."'");
                    }
                    if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']!='')
                    {
                        $end_dt=date("Y-m-d", strtotime($end_date));
                        $start_dt=date("Y-m-d", strtotime($strt_date));
                        $sqls3=mysqli_query($db_handle,"SELECT w.name AS warehouse,r.name AS rack,s.name AS sku,o.buyer,o.unit_price,o.quantity FROM tbl_outward_adjustment o LEFT JOIN tbl_sku s ON o.sku=s.id LEFT JOIN tbl_warehouse w ON o.warehouse_id=w.id LEFT JOIN tbl_rack r ON o.rack_id=r.id WHERE o.sku='".$sku."' AND (DATE(o.creation_date) BETWEEN '".$start_dt."' AND '".$end_dt."')");
                    }    
                    while($rec2=mysqli_fetch_object($sqls3))
                    {
                        $data[]=array(
                            
                            'sku'=>$rec2->sku,
                            'buyer'=>$rec2->buyer,
                            'comment'=>'NA',
                            'warehouse'=>$rec2->warehouse,
                            'rack'=>$rec2->rack,
                            'unit_price'=>$rec2->unit_price,
                            'quantity'=>$rec2->quantity,
                            'type'=>'Adjustment'
                            );
                    }
                    
                    // print_r($data);    
                    foreach($data as $val)
                    {
                    ?>
                        <tr>
                            <td><?=$val['sku']?></td>
                            <td><?=$val['buyer']?></td>
                            <td><?=$val['comment']?></td>
                            <td><?=$val['warehouse']?></td>
                            <td><?=$val['rack']?></td>
                            <?php if((in_array("21",$permission))) { ?><td><i class="fa fa-rupee" style="font-size:15px"></i>&nbsp;<?=$val['unit_price']?></td><?php } ?>
                            <td><?=$val['quantity']?></td>
                            <td><?=$val['type']?></td>
                        </tr>
                    <?php    
                    }
                    ?>
                    </tbody>
                    </table>
            
    <?php } ?>
<?php } ?>	