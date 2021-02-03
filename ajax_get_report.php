<?php

	session_start();

	if(@$_SESSION['valid_admin'] == "" )
	{

		@header("Location:login.php");
	}

	include_once("include/inc.php");

    if(isset($_POST['type'])) { 

			$role=$_SESSION['role'];
			$sqlrole=mysqli_fetch_object(mysqli_query($db_handle,"SELECT access_permission,modify_permission FROM tbl_usergroup WHERE id='".$role."'"));
			$access_permission=$sqlrole->access_permission;
			$permission=explode(",",$access_permission);
      
        $strt_date=$_REQUEST['start_dt'];
         
        $end_date=$_REQUEST['end_dt'];
        
        
 	if($_POST['type']=='3') { ?>
 	        
         	 <table id="datatable-brand" class="table table-striped table-bordered datatable">
                    <thead>

                      <tr>
                       <th class="text-center">Sl No</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Creation Date</th>
                      </tr>

                    </thead>

                    <tbody>
                        
                        <?php
                        // $j=0;
                        if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']==''){
						    $sqlview = mysqli_query($db_handle,"SELECT * FROM tbl_sku WHERE product_id='0' AND combo_product_id='0' ORDER BY id DESC");
                            $count = mysqli_num_rows($sqlview);
                        }
                        if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']=='')
                        {
                            $start_dt=date("Y-m-d", strtotime($strt_date) );
                            // echo $start_dt."<br>";
                            $sqlview = mysqli_query($db_handle,"SELECT * FROM tbl_sku WHERE product_id='0' AND combo_product_id='0' AND (DATE(creation_date)>='".$start_dt."') ORDER BY id DESC");
                            $count = mysqli_num_rows($sqlview);
                            //echo $count;
                        }
                        if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']!='')
                        {
                            $end_dt=date("Y-m-d", strtotime($end_date));
                            // echo $end_dt."<br>";
                            $sqlview = mysqli_query($db_handle,"SELECT * FROM tbl_sku WHERE product_id='0' AND combo_product_id='0' AND (DATE(creation_date)<='".$end_dt."') ORDER BY id DESC");
                            $count = mysqli_num_rows($sqlview);
                            //echo $count;
                        }
                        if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']!='')
                        {
                            $end_dt=date("Y-m-d", strtotime($end_date));
                            $start_dt=date("Y-m-d", strtotime($strt_date));
                            // echo $start_dt."<br>".$end_dt."<br>";
                            $sqlview = mysqli_query($db_handle,"SELECT * FROM tbl_sku WHERE product_id='0' AND combo_product_id='0' AND (DATE(creation_date) BETWEEN '".$start_dt."' AND '".$end_dt."') ORDER BY id DESC");
                            $count = mysqli_num_rows($sqlview);
                            //echo $count;
                        }
						//echo $count;
						if($count > 0)
						{ 
						    $sl=1;
						  //  echo $count;
						while($record=mysqli_fetch_object($sqlview))
						{ ?>

                      <tr>
                      
                        <td class="text-center"><?=$sl; ?></td>
                        <td class="text-center"><?=$record->name; ?></td>
                        <td class="text-center"><?=date("d F Y",strtotime($record->creation_date)); ?></td>
                    
                     </tr>
                      <?php $sl++; } } ?>                      
                    </tbody>
                  </table>
    <?php } if($_POST['type']=='5') { ?> 
    		<table id="datatable-brand" class="table table-striped table-bordered datatable">
                    <thead>
                      <tr class="headings">
                        <th>Sl no</th>
                        <th>Sku</th>
                        <th>From Warehouse</th>
                        <th>From Rack</th>
                        <th>Wholesaler</th>
                        <th>Comment </th>
                        <th>Stock Quantity</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                <?php
                        if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']==''){
						    $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_stock_transfer_wholeseller");
                            $count = mysqli_num_rows($sqlQuery1);
                        }
                        if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']=='')
                        {
                            $start_dt=date("Y-m-d", strtotime($strt_date) );
                            // echo $start_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_stock_transfer_wholeseller WHERE DATE(creation_date)>='".$start_dt."' ORDER BY id DESC");
                            $count = mysqli_num_rows($sqlQuery1);
                            //echo $count;
                        }
                        if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']!='')
                        {
                            $end_dt=date("Y-m-d", strtotime($end_date));
                            // echo $end_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_stock_transfer_wholeseller WHERE DATE(creation_date)<='".$end_dt."' ORDER BY id DESC");
                            $count = mysqli_num_rows($sqlQuery1);
                            //echo $count;
                        }
                        if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']!='')
                        {
                            $end_dt=date("Y-m-d", strtotime($end_date));
                            $start_dt=date("Y-m-d", strtotime($strt_date));
                            // echo $start_dt."<br>".$end_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_stock_transfer_wholeseller WHERE DATE(creation_date) BETWEEN '".$start_dt."' AND '".$end_dt."' ORDER BY id DESC");
                            $count = mysqli_num_rows($sqlQuery1);
                            //echo $count;
                        }
                
                    //$sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_stock_transfer_wholeseller");
	    	    if($count>0)
	    	    {
	    	        $sl=1;
	    	        while($record=mysqli_fetch_object($sqlQuery1))
	    	        { ?>
	    	            <tr>
	                          
	                            <td><?=$sl; ?></td>
	                            <td><?php $sqlsku=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_sku WHERE id='".$record->sku."'")); echo $sqlsku->name;?></td>
	                            <td><?php $sqlsku=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_warehouse WHERE id='".$record->from_warehouse."'")); echo $sqlsku->name; ?></td>
	                            <td><?php $sqlsku=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_rack WHERE id='".$record->from_rack."'")); echo $sqlsku->name; ?></td>
	                            <td><?=$record->ws_name?></td>
	                            <td><?php if($record->comment=="") { echo "No comments yet"; } else { echo $record->comment; }?></td>
	                            <td><?=$record->stock_quant?></td>
	                            <td><?php if($record->status==0) { echo "Unapproved"; } else { echo "Approved"; }?></td>
	    		    </tr>
	    		    <?php $sl++; } } ?>  
	    	    </tbody>
	    	    </table>
    <?php } if($_POST['type']=='6') { ?>
        
        <table id="datatable-brand" class="table table-striped table-bordered datatable">
                    <thead>

                      <tr class="headings">
                        <th>Sl no</th>
                        <th>Sku</th>
                        <th>From Warehouse</th>
                        <th>From Rack</th>
                        <th>To Warehouse</th>
                        <th>To Rack</th>
                        <th>Stock Quantity</th>
                        <th>Status</th>
                      </tr>

                    </thead>

                    <tbody>
                        
                        <?php
                            
                        if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']==''){
						    $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_stock_transfer_warehouse");
                            $count = mysqli_num_rows($sqlQuery1);
                        }
                        if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']=='')
                        {
                            $start_dt=date("Y-m-d", strtotime($strt_date) );
                            // echo $start_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_stock_transfer_warehouse WHERE DATE(creation_date)>='".$start_dt."' ORDER BY id DESC");
                            $count = mysqli_num_rows($sqlQuery1);
                            //echo $count;
                        }
                        if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']!='')
                        {
                            $end_dt=date("Y-m-d", strtotime($end_date));
                            // echo $end_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_stock_transfer_warehouse WHERE DATE(creation_date)<='".$end_dt."' ORDER BY id DESC");
                            $count = mysqli_num_rows($sqlQuery1);
                            //echo $count;
                        }
                        if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']!='')
                        {
                            $end_dt=date("Y-m-d", strtotime($end_date));
                            $start_dt=date("Y-m-d", strtotime($strt_date));
                            // echo $start_dt."<br>".$end_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_stock_transfer_warehouse WHERE DATE(creation_date) BETWEEN '".$start_dt."' AND '".$end_dt."' ORDER BY id DESC");
                            $count = mysqli_num_rows($sqlQuery1);
                            //echo $count;
                        }
                        
						if($count > 0)
						{ $sl=1;

						while($record=mysqli_fetch_object($sqlQuery1))
						{ 

					   ?>

                      <tr>
                      
                        <td><?=$sl; ?></td>
	                    <td><?php $sqlsku=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_sku WHERE id='".$record->sku."'")); echo $sqlsku->name;?></td>
	                    <td><?php $sqlsku=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_warehouse WHERE id='".$record->from_warehouse."'")); echo $sqlsku->name; ?></td>
	                    <td><?php $sqlsku=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_rack WHERE id='".$record->from_rack."'")); echo $sqlsku->name; ?></td>
	                    <td><?php $sqlsku=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_warehouse WHERE id='".$record->to_warehouse."'")); echo $sqlsku->name; ?></td>
                        <td><?php $sqlsku=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_rack WHERE id='".$record->to_rack."'")); echo $sqlsku->name; ?></td>
                        <td><?=$record->stock_quant?></td>
                        <td>
	                                <?php if($record->status==0) {
	                                    
	                                    echo "<button class='btn btn-danger btn-xs'>Unapproved</button>";  
	                                }
	                                else
	                                {
	                                    echo "<button class='btn btn-success btn-xs'>Approved</button>";
	                                }
	                                ?>
	                            </td>
                     </tr>
                      <?php $sl++; } } ?>                      
                    </tbody>
                  </table>
    
    <?php } if($_POST['type']=='7') { ?>
        
            <table id="datatable-brand" class="table table-striped table-bordered datatable">

                    <thead>

                      <tr class="headings">
                       <th>Sl No</th>
                        <!--<th>Product Name</th>-->
                        <th>SKU</th>
                        <th>Current Warehouse</th>
                        <th>Quantity</th>
                        <th>Returned From</th>
                        <th>Condition</th>
                        <!--<th>Action</th>-->

                      </tr>

                    </thead>
                    <tbody>        
                    <?php
                        if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']==''){
						    $sqlQuery1=mysqli_query($db_handle,"SELECT rp.status,w.name AS warehouse,s.name AS sku,rp.quantity,rp.return_from FROM tbl_returned_product rp LEFT JOIN tbl_sku s ON s.id=rp.sku LEFT JOIN tbl_warehouse w ON w.id=rp.warehouse_id ORDER BY rp.id DESC");
                            $count = mysqli_num_rows($sqlQuery1);
                        }
                        if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']=='')
                        {
                            $start_dt=date("Y-m-d", strtotime($strt_date) );
                            // echo $start_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT rp.status,w.name AS warehouse,s.name AS sku,rp.quantity,rp.return_from FROM tbl_returned_product rp LEFT JOIN tbl_sku s ON s.id=rp.sku LEFT JOIN tbl_warehouse w ON w.id=rp.warehouse_id WHERE DATE(rp.creation_date)>='".$start_dt."' ORDER BY rp.id DESC");
                            $count = mysqli_num_rows($sqlQuery1);
                            //echo $count;
                        }
                        if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']!='')
                        {
                            $end_dt=date("Y-m-d", strtotime($end_date));
                            // echo $end_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT rp.status,w.name AS warehouse,s.name AS sku,rp.quantity,rp.return_from FROM tbl_returned_product rp LEFT JOIN tbl_sku s ON s.id=rp.sku LEFT JOIN tbl_warehouse w ON w.id=rp.warehouse_id WHERE DATE(rp.creation_date)<='".$end_dt."' ORDER BY rp.id DESC");
                            $count = mysqli_num_rows($sqlQuery1);
                            //echo $count;
                        }
                        if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']!='')
                        {
                            $end_dt=date("Y-m-d", strtotime($end_date));
                            $start_dt=date("Y-m-d", strtotime($strt_date));
                            // echo $start_dt."<br>".$end_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT rp.status,w.name AS warehouse,s.name AS sku,rp.quantity,rp.return_from FROM tbl_returned_product rp LEFT JOIN tbl_sku s ON s.id=rp.sku LEFT JOIN tbl_warehouse w ON w.id=rp.warehouse_id WHERE DATE(rp.creation_date) BETWEEN '".$start_dt."' AND '".$end_dt."' ORDER BY rp.id DESC");
                            $count = mysqli_num_rows($sqlQuery1);
                            //echo $count;
                        }
            
        
//             $sqlview = mysqli_query($db_handle,"SELECT rp.status,w.name AS warehouse,s.name AS sku,rp.quantity,rp.return_from FROM tbl_returned_product rp LEFT JOIN tbl_sku s ON s.id=rp.sku LEFT JOIN tbl_warehouse w ON w.id=rp.warehouse_id ORDER BY rp.id DESC");
// 			$count = mysqli_num_rows($sqlview);
			if($count > 0)
			{ 
			    $sl=1;
                while($record=mysqli_fetch_object($sqlQuery1))
				{ ?>
                      <tr>
                        <td><?=$sl; ?></td>
                        <td><?=$record->sku?></td>
                        <td><?=$record->warehouse?></td>
                        <td><?=$record->quantity?></td>
                        <td><?=$record->return_from?></td>
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
                      <?php $sl++; 
                } 
            } ?>  
        <?php } if($_POST['type']==1) { ?>
            <table id="datatable-brand" class="table table-striped table-bordered datatable">

                    <thead>

                      <tr class="headings">
                       <th>Sl No</th>
                        <th>Name</th>
                        <th>Status</th>
                        
                        <th>No of Racks</th>
                        <th>Racks</th>
                        
                        <!--<th>Action</th>-->

                      </tr>
                    </thead>
                    
                    <tbody> 
                    <?php
                        if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']==''){
						    $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_warehouse WHERE status='1'");
                            $count = mysqli_num_rows($sqlQuery1);
                            // echo $count;
                        }
                        if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']=='')
                        {
                            $start_dt=date("Y-m-d", strtotime($strt_date) );
                            // echo $start_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_warehouse WHERE status='1' AND DATE(creation_date)>='".$start_dt."'");
                            $count = mysqli_num_rows($sqlQuery1);
                            //echo $count;
                        }
                        if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']!='')
                        {
                            $end_dt=date("Y-m-d", strtotime($end_date));
                            // echo $end_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_warehouse WHERE status='1' AND DATE(creation_date)<='".$end_dt."'");
                            $count = mysqli_num_rows($sqlQuery1);
                            // echo $count;
                        }
                        if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']!='')
                        {
                            $end_dt=date("Y-m-d", strtotime($end_date));
                            $start_dt=date("Y-m-d", strtotime($strt_date));
                            // echo $start_dt."<br>".$end_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_warehouse WHERE status='1' AND (DATE(creation_date) BETWEEN '".$start_dt."' AND '".$end_dt."')");
                            $count = mysqli_num_rows($sqlQuery1);
                            // echo $count;
                        }
        
			if($count > 0)
			{ 
			    $sl=1;
                while($record=mysqli_fetch_object($sqlQuery1))
				{ 
				    $w_id=$record->id;
                    $sqlrck=mysqli_query($db_handle,"SELECT * FROM tbl_rack WHERE warehouse_id='".$w_id."'");
                    $count1=mysqli_num_rows($sqlrck); 
                    while($rec=mysqli_fetch_object($sqlrck)) { ?>
                      <tr>
                        <td><?=$sl; ?></td>
                        <td><?=$record->name?></td>
                        <td>
                             <?php if($record->status==0) {
	                                    
	                                    echo "<button class='btn btn-danger btn-xs'>Disable</button>";  
	                                }
	                                else
	                                {
	                                    echo "<button class='btn btn-success btn-xs'>Enable</button>";
	                                }
	                                ?>
                        </td>
                        <td><?=$count1?></td>
                        <td><?php echo $rec->name; ?></td>
                        
                      </tr>
                      <?php } ?>
                      <?php $sl++; 
                } 
            } ?>
            </tbody>
            </table>
                    
        <?php } if($_POST['type']=='4') { ?>
            
             <table id="datatable-brand" class="table table-striped table-bordered datatable">

                    
                    <thead>
                      <tr class="headings">
                        <!--<th>Sl-No.</th>-->
                        <th>SKU</th>
                        <th>Warehouse</th>
                        <th>Rack(s)</th>
                        
                        <th>Quantity</th>
                        <?php if((in_array("21",$permission))) { ?>
                        <th>Unit Price</th>
                        <?php } ?>
                        <?php if((in_array("21",$permission))) { ?>
                        <th>Total Price</th>
                        <?php } ?>
                        <th>Status</th>
                        <!--<th>Action</th>-->

                      </tr>
                      <tr class="headings">
                        <!--<th>Sl-No.</th>-->
                        <th>SKU</th>
                        <th>Warehouse</th>
                        <th>Rack(s)</th>
                        <th>Quantity</th>
                        <?php if((in_array("21",$permission))) { ?>
                        <th>Unit Price</th>
                        <?php } ?>
                        <?php if((in_array("21",$permission))) { ?>
                        <th>Total Price</th>
                        <?php } ?>
                        <th>Status</th>
                        <!--<th>Action</th>-->

                      </tr>
                    </thead>
                    
                    <tbody>
                    <?php
                    if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']==''){
						    $sqlQuery1=mysqli_query($db_handle,"SELECT p.id,s.name,p.quantity,p.total_price FROM tbl_products p LEFT JOIN tbl_sku s ON p.sku=s.id ORDER BY p.id");
						    $sqlQuery2=mysqli_query($db_handle,"SELECT c.id,s.name,c.quantity,c.total_price FROM tbl_combo_product c LEFT JOIN tbl_sku s ON c.sku=s.id ORDER BY c.id");
                            $count = mysqli_num_rows($sqlQuery1);
                            $count1=mysqli_num_rows($sqlQuery2);
                        }
                        if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']=='')
                        {
                            $start_dt=date("Y-m-d", strtotime($strt_date) );
                            // echo $start_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT p.id,s.name,p.quantity,p.total_price FROM tbl_products p LEFT JOIN tbl_sku s ON p.sku=s.id WHERE DATE(p.creation_date)>='".$start_dt."' ORDER BY p.id");
                            $count = mysqli_num_rows($sqlQuery1);
                            
                            $sqlQuery2=mysqli_query($db_handle,"SELECT c.id,s.name,c.quantity,c.total_price FROM tbl_combo_product c LEFT JOIN tbl_sku s ON c.sku=s.id WHERE DATE(c.creation_date)>='".$start_dt."' ORDER BY c.id");
                            $count1 = mysqli_num_rows($sqlQuery2);

                            //echo $count;
                        }
                        if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']!='')
                        {
                            $end_dt=date("Y-m-d", strtotime($end_date));
                            // echo $end_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT p.id,s.name,p.quantity,p.total_price FROM tbl_products p LEFT JOIN tbl_sku s ON p.sku=s.id WHERE DATE(p.creation_date)<='".$end_dt."' ORDER BY p.id");
                            $count = mysqli_num_rows($sqlQuery1);
                            $sqlQuery2=mysqli_query($db_handle,"SELECT c.id,s.name,c.quantity,c.total_price FROM tbl_combo_product c LEFT JOIN tbl_sku s ON c.sku=s.id WHERE DATE(c.creation_date)<='".$end_dt."' ORDER BY c.id");
                            $count1 = mysqli_num_rows($sqlQuery2);
                            
                            //echo $count;
                        }
                        if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']!='')
                        {
                            $end_dt=date("Y-m-d", strtotime($end_date));
                            $start_dt=date("Y-m-d", strtotime($strt_date));
                            // echo $start_dt."<br>".$end_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT p.id,s.name,p.quantity,p.total_price FROM tbl_products p LEFT JOIN tbl_sku s ON p.sku=s.id WHERE DATE(p.creation_date) BETWEEN '".$start_dt."' AND '".$end_dt."' ORDER BY p.id");
                            $count = mysqli_num_rows($sqlQuery1);
                            $sqlQuery2=mysqli_query($db_handle,"SELECT c.id,s.name,c.quantity,c.total_price FROM tbl_combo_product c LEFT JOIN tbl_sku s ON c.sku=s.id WHERE DATE(c.creation_date) BETWEEN '".$start_dt."' AND '".$end_dt."' ORDER BY c.id");
                            $count1 = mysqli_num_rows($sqlQuery2);
                            
                            //echo $count;
                        }
                    
                //      $sqlview = mysqli_query($db_handle,"SELECT p.id,s.name,p.quantity,p.total_price FROM tbl_products p LEFT JOIN tbl_sku s ON p.sku=s.id ORDER BY p.id");
				// 		$count = mysqli_num_rows($sqlview);
						if($count > 0 || $count1 > 0)
						{ 
						    $sl=1;

						while($record=mysqli_fetch_object($sqlQuery1))
						{  
						    $product_id=$record->id;
						    $sqlsel1=mysqli_query($db_handle,"SELECT s.name AS sku,w.name AS warehouse,w.id,r.name AS rack,ptw.unit_price,ptw.quantity,ptw.status,ptw.total_price FROM tbl_product_to_warehouse ptw LEFT JOIN tbl_warehouse w ON ptw.warehouse_id=w.id LEFT JOIN tbl_rack r ON ptw.rack_id=r.id LEFT JOIN tbl_sku s ON ptw.product_id=s.product_id WHERE ptw.product_id='".$product_id."'");
                            $count2=mysqli_num_rows($sqlsel1);
                            
						?>
						
						    
						        
    						  <?php
    						  $sl1=0;
    						        while($rec=mysqli_fetch_object($sqlsel1))
                                    {
                                        $data[]=array(
                                            'sku'=>$rec->sku,
                                            'warehouse'=>$rec->warehouse,
                                            'rack'=>$rec->rack,
                                            'quantity'=>$rec->quantity,
                                            'unit_price'=>$rec->unit_price,
                                            'total_price'=>$rec->total_price,
                                            'status'=>$rec->status
                                            );
                                    }
						}
						
						while($record1=mysqli_fetch_object($sqlQuery2))
						{  
						    $combo_product_id=$record1->id;
						    $sqlsel2=mysqli_query($db_handle,"SELECT s.name AS sku,w.name AS warehouse,w.id,r.name AS rack,ptw.unit_price,ptw.quantity,ptw.status,ptw.total_price FROM tbl_product_to_warehouse ptw LEFT JOIN tbl_warehouse w ON ptw.warehouse_id=w.id LEFT JOIN tbl_rack r ON ptw.rack_id=r.id LEFT JOIN tbl_sku s ON ptw.combo_product_id=s.combo_product_id WHERE ptw.combo_product_id='".$combo_product_id."'");
                            $count3=mysqli_num_rows($sqlsel2);
                            
						?>
						
						    
						        
    						  <?php
    						  $sl1=0;
    						        while($rec1=mysqli_fetch_object($sqlsel2))
                                    {
                                        $data[]=array(
                                            'sku'=>$rec1->sku,
                                            'warehouse'=>$rec1->warehouse,
                                            'rack'=>$rec1->rack,
                                            'quantity'=>$rec1->quantity,
                                            'unit_price'=>$rec1->unit_price,
                                            'total_price'=>$rec1->total_price,
                                            'status'=>$rec1->status
                                            );
                                    }
						}
				// 		$grand_total=0;
						foreach($data as $val)
						{
						  //  $grand_total=$grand_total+$val['total_price'];
                        ?>
                                        <tr>
                                        <!--<td><?=$sl;?></td>-->
                                            <td><?=$val['sku']?></td>
                                            <td><?=$val['warehouse']?></td>
                                            <td><?=$val['rack']?></td>
                                            <td><?=$val['quantity']?></td>
                                            <?php if((in_array("21",$permission))) { ?><td><i class="fa fa-rupee" style="font-size:15px"></i>&nbsp;<?=$val['unit_price']?></td><?php } ?>
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
                                        </tr>
                                        <?php
                                        
                        }
					} ?>
						</tbody>
						   </table>
		<?php } if($_POST['type']=='8') { ?>
		        
		        <table id="datatable-brand" class="table table-striped table-bordered datatable">

                    <thead>

                      <tr class="headings">
                        <th>Sl-No</th>
                        <th>SKU</th>
                        <th>Warehouse</th>
                        <th>Rack(s)</th>
                        
                        <th>Quantity</th>
                        <?php if((in_array("21",$permission))) { ?><th>Unit Price</th><?php } ?>
                        <!--<th>Action</th>-->

                      </tr>
                    </thead>
                    
                    <tbody>
                        
                    <?php
                    if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']==''){
						    $sqlQuery1=mysqli_query($db_handle,"SELECT id,quantity,total_price FROM tbl_combo_product ORDER BY id ASC");
                            $count = mysqli_num_rows($sqlQuery1);
                        }
                        if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']=='')
                        {
                            $start_dt=date("Y-m-d", strtotime($strt_date) );
                            // echo $start_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT id,quantity,total_price FROM tbl_combo_product WHERE DATE(creation_date)>='".$start_dt."' ORDER BY id");
                            $count = mysqli_num_rows($sqlQuery1);
                            //echo $count;
                        }
                        if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']!='')
                        {
                            $end_dt=date("Y-m-d", strtotime($end_date));
                            // echo $end_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT id,quantity,total_price FROM tbl_combo_product WHERE DATE(creation_date)<='".$end_dt."' ORDER BY id");
                            $count = mysqli_num_rows($sqlQuery1);
                            //echo $count;
                        }
                        if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']!='')
                        {
                            $end_dt=date("Y-m-d", strtotime($end_date));
                            $start_dt=date("Y-m-d", strtotime($strt_date));
                            // echo $start_dt."<br>".$end_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT id,quantity,total_price FROM tbl_combo_product WHERE DATE(creation_date) BETWEEN '".$start_dt."' AND '".$end_dt."' ORDER BY id");
                            $count = mysqli_num_rows($sqlQuery1);
                            //echo $count;
                        }
                        if($count > 0)
						{ $sl=1;

						while($record=mysqli_fetch_object($sqlQuery1))
						{  
						    $combo_product_id=$record->id;
						    $sqlsel1=mysqli_query($db_handle,"SELECT s.name AS sku,w.name AS warehouse,w.id,r.name AS rack,ptw.unit_price,ptw.quantity FROM tbl_product_to_warehouse ptw LEFT JOIN tbl_warehouse w ON ptw.warehouse_id=w.id LEFT JOIN tbl_rack r ON ptw.rack_id=r.id LEFT JOIN tbl_sku s ON ptw.combo_product_id=s.combo_product_id WHERE ptw.combo_product_id='".$combo_product_id."' GROUP BY ptw.warehouse_id");
                            $count1=mysqli_num_rows($sqlsel1);
                            
						?>
						
						    
						        
    						  <?php
    						  $sl1=0;
    						        while($rec=mysqli_fetch_object($sqlsel1))
                                    {
                                    ?>
                                        <tr>
                                        <td><?=$sl;?></td>
                                        <td><a href="javascript:void(0)" id="<?=$record->id?>" class="combo-details"><?=$rec->sku?></a></td>
                                        <td><?=$rec->warehouse?></td>
                                        <td><?=$rec->rack?></td>
                                        <td><?=$rec->quantity?></td>
                                        <?php if((in_array("21",$permission))) { ?><td><i class="fa fa-rupee" style="font-size:15px"></i>&nbsp;<?=$rec->unit_price?></td><?php } ?>
                                        </tr>
                                        <?php
                                        $sl1++;
                                    }
						            ?>
						    
						   <?php $sl++; } } ?>
						   </tbody>
						   </table>
		        
		<?php }if($_POST['type']=='10') { ?> 
    		<table id="datatable-brand" class="table table-striped table-bordered datatable">
                    <thead>
                      <tr class="headings">
                        <th>Sl no</th>
                        <th>Wholeseller Name</th>
                        <th>Comment </th>
                        <th>Sku</th>
                        <th>From Warehouse</th>
                        <th>From Rack</th>
                        <th>Quantity</th>
                        <?php if((in_array("21",$permission))) { ?><th>Unit Price</th><?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                        
                <?php
                        if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']==''){
						    $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_order WHERE status='1'");
                            $count = mysqli_num_rows($sqlQuery1);
                        }
                        if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']=='')
                        {
                            $start_dt=date("Y-m-d", strtotime($strt_date) );
                            // echo $start_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_order WHERE DATE(process_date)>='".$start_dt."' AND status='1' ORDER BY id DESC");
                            $count = mysqli_num_rows($sqlQuery1);
                            //echo $count;
                        }
                        if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']!='')
                        {
                            $end_dt=date("Y-m-d", strtotime($end_date));
                            // echo $end_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_order WHERE DATE(process_date)<='".$end_dt."' AND status='1' ORDER BY id DESC");
                            $count = mysqli_num_rows($sqlQuery1);
                            //echo $count;
                        }
                        if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']!='')
                        {
                            $end_dt=date("Y-m-d", strtotime($end_date));
                            $start_dt=date("Y-m-d", strtotime($strt_date));
                            // echo $start_dt."<br>".$end_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_order WHERE (DATE(process_date) BETWEEN '".$start_dt."' AND '".$end_dt."') AND status='1' ORDER BY id DESC");
                            $count = mysqli_num_rows($sqlQuery1);
                            //echo $count;
                        }
                
                    //$sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_stock_transfer_wholeseller");
	    	    if($count>0)
	    	    {
	    	        $sl=1;
	    	        while($record=mysqli_fetch_object($sqlQuery1))
	    	        {
	    	            $order_id=$record->id;
	    	            $rec1=mysqli_query($db_handle,"SELECT sku,warehouse_id,rack_id,quantity,unit_price FROM tbl_processed_order WHERE order_id='".$order_id."'");
	    	            $count1=mysqli_num_rows($rec1);
	    	            while($rec=mysqli_fetch_object($rec1)){ 
    	    	        ?>
    	    	        <tr>
    	    	        <td><?=$sl; ?></td>
    	                <td><?=$record->ws_name?></td>
    	                <td><?=$record->comment?></td>
    	    	        <td><?php $sqlsku=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_sku WHERE id='".$rec->sku."'")); echo $sqlsku->name;?></td>
    	    	        <td><?php $sqlwh=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_warehouse WHERE id='".$rec->warehouse_id."'")); echo $sqlwh->name; ?></td>              
    	    	        <td><?php $sqlrck=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_rack WHERE id='".$rec->rack_id."'")); echo $sqlrck->name; ?></td>
    	    	        <td><?=$rec->quantity?></td>
    	    	        <?php if((in_array("21",$permission))) { ?><td><i class="fa fa-rupee" style="font-size:15px"></i>&nbsp;<?=$rec->unit_price?></td><?php } ?>
    	    	        </tr>      
    	   	          
    	    		    <?php } $sl++; } } ?>  
	    	    </tbody>
	    	    </table>
    <?php } if($_POST['type']=='9') { ?> 
    		<table id="datatable-brand" class="table table-striped table-bordered datatable">
                    <thead>
                      <tr class="headings">
                        <th>Sl no</th>
                        <th>Wholeseller Name</th>
                        <th>Comment </th>
                        <th>Sku</th>
                        <th>Quantity</th>
                      </tr>
                    </thead>
                    <tbody>
                        
                <?php
                        if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']==''){
						    $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_order WHERE status='0'");
                            $count = mysqli_num_rows($sqlQuery1);
                        }
                        if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']=='')
                        {
                            $start_dt=date("Y-m-d", strtotime($strt_date) );
                            // echo $start_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_order WHERE DATE(creation_date)>='".$start_dt."' AND status='0' ORDER BY id DESC");
                            $count = mysqli_num_rows($sqlQuery1);
                            //echo $count;
                        }
                        if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']!='')
                        {
                            $end_dt=date("Y-m-d", strtotime($end_date));
                            // echo $end_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_order WHERE DATE(creation_date)<='".$end_dt."' AND status='0' ORDER BY id DESC");
                            $count = mysqli_num_rows($sqlQuery1);
                            //echo $count;
                        }
                        if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']!='')
                        {
                            $end_dt=date("Y-m-d", strtotime($end_date));
                            $start_dt=date("Y-m-d", strtotime($strt_date));
                            // echo $start_dt."<br>".$end_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_order WHERE (DATE(creation_date) BETWEEN '".$start_dt."' AND '".$end_dt."') AND status='0' ORDER BY id DESC");
                            $count = mysqli_num_rows($sqlQuery1);
                            //echo $count;
                        }
                
                    //$sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_stock_transfer_wholeseller");
	    	    if($count>0)
	    	    {
	    	        $sl=1;
	    	        while($record=mysqli_fetch_object($sqlQuery1))
	    	        {
	    	           $order_id=$record->id;
	    	           $rec1=mysqli_query($db_handle,"SELECT sku,quantity FROM tbl_order_details WHERE order_id='".$order_id."'");
	    	          // $count1=mysqli_num_rows($rec1);
	    	           while($rec=mysqli_fetch_object($rec1)){ ?>
                        
    	    	        <tr>
    	    	        <td><?=$sl; ?></td>
    	                <td><?=$record->ws_name?></td>
    	                <td><?=$record->comment?></td>
    	    	        <td><?php $sqlsku=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_sku WHERE id='".$rec->sku."'")); echo $sqlsku->name;?></td>
    	    	        <td><?=$rec->quantity?></td>
    	    	        </tr>      
    	   	          
    	    		    <?php } $sl++; } } ?>  
	    	    </tbody>
	    	    </table>
    <?php } if($_POST['type']==11) { ?>
        
                <table id="datatable-brand" class="table table-striped table-bordered datatable">
                    <thead>
                      <tr class="headings">
                        <th>Sl no</th>
                        <th>SKU</th>
                        <th>From Warehouse </th>
                        <th>From Rack</th>
                        <th>Reason</th>
                        <th>Current Rack</th>
                        <?php if((in_array("21",$permission))) { ?><th>Unit Price</th><?php } ?>
                        <th>Quantity</th>
                      </tr>
                    </thead>
                    <tbody>
                        
                <?php
                        if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']==''){
						    $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_shortage_transaction");
                            $count = mysqli_num_rows($sqlQuery1);
                        }
                        if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']=='')
                        {
                            $start_dt=date("Y-m-d", strtotime($strt_date) );
                            // echo $start_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_shortage_transaction WHERE DATE(creation_date)>='".$start_dt."' ORDER BY id DESC");
                            $count = mysqli_num_rows($sqlQuery1);
                            //echo $count;
                        }
                        if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']!='')
                        {
                            $end_dt=date("Y-m-d", strtotime($end_date));
                            // echo $end_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_shortage_transaction WHERE DATE(creation_date)<='".$end_dt."' ORDER BY id DESC");
                            $count = mysqli_num_rows($sqlQuery1);
                            //echo $count;
                        }
                        if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']!='')
                        {
                            $end_dt=date("Y-m-d", strtotime($end_date));
                            $start_dt=date("Y-m-d", strtotime($strt_date));
                            // echo $start_dt."<br>".$end_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_shortage_transaction WHERE (DATE(creation_date) BETWEEN '".$start_dt."' AND '".$end_dt."') ORDER BY id DESC");
                            $count = mysqli_num_rows($sqlQuery1);
                            //echo $count;
                        }
                
                    //$sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_stock_transfer_wholeseller");
	    	    if($count>0)
	    	    {
	    	        $sl=1;
	    	        while($record=mysqli_fetch_object($sqlQuery1))
	    	        {
	    	           $order_id=$record->id;
	    	           $rec1=mysqli_query($db_handle,"SELECT sku,quantity FROM tbl_order_details WHERE order_id='".$order_id."'");
	    	          // $count1=mysqli_num_rows($rec1);
                     ?>   
    	    	        <tr>
    	    	        <td><?=$sl; ?></td>
    	                <td><?php 
    	                $sku_id=$record->sku; 
    	                $sqlSKU=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_sku WHERE id='".$sku_id."'"));
    	                echo $sqlSKU->name; ?></td>
    	                <td><?php 
    	                $from_wh_id=$record->from_warehouse; 
    	                $sqlWH=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_warehouse WHERE id='".$from_wh_id."'"));
    	                echo $sqlWH->name; ?></td>
    	                <td><?php 
    	                $from_rack_id=$record->from_rack; 
    	                $sqlRCK=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_rack WHERE id='".$from_rack_id."'"));
    	                echo $sqlRCK->name; ?></td>
    	                <td><?=$record->reason?></td>
    	    	        <td><?php 
    	                $from_rack_id=$record->to_rack; 
    	                $sqlRCK=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_rack WHERE id='".$from_rack_id."'"));
    	                echo $sqlRCK->name; ?></td>
    	                <?php if((in_array("21",$permission))) { ?><td><i class="fa fa-rupee" style="font-size:15px"></i>&nbsp;<?=$record->unit_price?></td><?php } ?>
    	    	        <td><?=$record->quantity?></td>
    	    	        </tr>      
    	   	          
    	    		    <?php $sl++; } } ?>  
	    	    </tbody>
	    	    </table>
        
    
    <?php } if($_POST['type']==2) { ?>
        
            <table id="datatable-brand" class="table table-striped table-bordered datatable">
                    <thead>
                      <tr class="headings">
                        <th>Sl no</th>
                        <th>SKU</th>
                        <th>Initial Quantity </th>
                        <?php if((in_array("21",$permission))) { ?><th>Total Price</th><?php } ?>
                        <th>Created on</th>
                      </tr>
                    </thead>
                    <tbody>
                        
                <?php
                        if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']==''){
						    $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_goods_inward");
                            $count = mysqli_num_rows($sqlQuery1);
                        }
                        if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']=='')
                        {
                            $start_dt=date("Y-m-d", strtotime($strt_date) );
                            // echo $start_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_goods_inward WHERE DATE(creation_date)>='".$start_dt."' ORDER BY id DESC");
                            $count = mysqli_num_rows($sqlQuery1);
                            //echo $count;
                        }
                        if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']!='')
                        {
                            $end_dt=date("Y-m-d", strtotime($end_date));
                            // echo $end_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_goods_inward WHERE DATE(creation_date)<='".$end_dt."' ORDER BY id DESC");
                            $count = mysqli_num_rows($sqlQuery1);
                            //echo $count;
                        }
                        if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']!='')
                        {
                            $end_dt=date("Y-m-d", strtotime($end_date));
                            $start_dt=date("Y-m-d", strtotime($strt_date));
                            // echo $start_dt."<br>".$end_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_goods_inward WHERE (DATE(creation_date) BETWEEN '".$start_dt."' AND '".$end_dt."') ORDER BY id DESC");
                            $count = mysqli_num_rows($sqlQuery1);
                            //echo $count;
                        }
                
                    //$sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_stock_transfer_wholeseller");
	    	    if($count>0)
	    	    {
	    	        $sl=1;
	    	        while($record=mysqli_fetch_object($sqlQuery1))
	    	        {
	    	           
                      ?>  
    	    	        <tr>
    	    	        <td><?=$sl; ?></td>
    	                <td><?=$record->sku_name?></td>
    	                <td><?=$record->quantity?></td>
    	    	        <?php if((in_array("21",$permission))) { ?><td><i class="fa fa-rupee" style="font-size:15px"></i>&nbsp;<?=$record->total_price?></td><?php } ?>
    	    	        <td><?=date("d F Y",strtotime($record->creation_date)); ?></td>
    	    	        </tr>      
    	   	          
    	    		    <?php $sl++; } } ?>  
	    	    </tbody>
	    	    </table>
        
    <?php } if($_POST['type']==12) { ?>
        
            <table id="datatable-brand" class="table table-striped table-bordered datatable">
                    <thead>
                      <tr class="headings">
                        <th>Sl no</th>
                        <th>SKU</th>
                        <th>Warehouse</th>
                        <th>Rack</th>
                        <th>Quantity</th>
                        <?php if((in_array("21",$permission))) { ?><th>Unit Price</th><?php } ?>
                        <?php if((in_array("21",$permission))) { ?><th>Total Price</th><?php } ?>
                        <th>Reason</th>
                        <th>Created on</th>
                      </tr>
                    </thead>
                    <tbody>
                        
                <?php
                        if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']==''){
						    $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_inward_adjustment");
                            $count = mysqli_num_rows($sqlQuery1);
                        }
                        if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']=='')
                        {
                            $start_dt=date("Y-m-d", strtotime($strt_date) );
                            // echo $start_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_inward_adjustment WHERE DATE(creation_date)>='".$start_dt."' ORDER BY id DESC");
                            $count = mysqli_num_rows($sqlQuery1);
                            //echo $count;
                        }
                        if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']!='')
                        {
                            $end_dt=date("Y-m-d", strtotime($end_date));
                            // echo $end_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_inward_adjustment WHERE DATE(creation_date)<='".$end_dt."' ORDER BY id DESC");
                            $count = mysqli_num_rows($sqlQuery1);
                            //echo $count;
                        }
                        if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']!='')
                        {
                            $end_dt=date("Y-m-d", strtotime($end_date));
                            $start_dt=date("Y-m-d", strtotime($strt_date));
                            // echo $start_dt."<br>".$end_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_inward_adjustment WHERE (DATE(creation_date) BETWEEN '".$start_dt."' AND '".$end_dt."') ORDER BY id DESC");
                            $count = mysqli_num_rows($sqlQuery1);
                            //echo $count;
                        }
                
                    //$sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_stock_transfer_wholeseller");
	    	    if($count>0)
	    	    {
	    	        $sl=1;
	    	        while($record=mysqli_fetch_object($sqlQuery1))
	    	        {
	    	           
                      ?>  
    	    	        <tr>
    	    	        <td><?=$sl; ?></td>
    	                <td><?=$record->sku_name?></td>
    	                <td><?php $sqlss=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_warehouse WHERE id='".$record->warehouse."'")); echo $sqlss->name;?></td>
    	                <td><?php $sqlss1=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_rack WHERE id='".$record->rack."'")); echo $sqlss1->name;?></td>
    	                <td><?=$record->quantity?></td>
    	                <?php if((in_array("21",$permission))) { ?><td><i class="fa fa-rupee" style="font-size:15px"></i>&nbsp;<?=$record->unit_price?></td><?php } ?>
    	    	        <?php if((in_array("21",$permission))) { ?><td><i class="fa fa-rupee" style="font-size:15px"></i>&nbsp;<?=$record->total_price?></td><?php } ?>
    	    	        <td><?=$record->reason?></td>
    	    	        <td><?=date("d F Y",strtotime($record->creation_date)); ?></td>
    	    	        </tr>      
    	   	          
    	    		    <?php $sl++; } } ?>  
	    	    </tbody>
	    	    </table>
        
    <?php } if($_POST['type']==13) { ?>
        
            <table id="datatable-brand" class="table table-striped table-bordered datatable">
                    <thead>
                      <tr class="headings">
                        <!--<th>Sl no:</th>-->
                        <th>SKU</th>
                        <th>Warehouse</th>
                        <th>Rack</th>
                        <th>Quantity</th>
                        <?php if((in_array("21",$permission))) { ?><th>Unit Price</th><?php } ?>
                        <th>Reason</th>
                        <th>Created on</th>
                      </tr>
                    </thead>
                    <tbody>
                        
                <?php
                        if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']==''){
						    $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_outward_adjustment");
                            $count = mysqli_num_rows($sqlQuery1);
                        }
                        if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']=='')
                        {
                            $start_dt=date("Y-m-d", strtotime($strt_date) );
                            // echo $start_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_outward_adjustment WHERE DATE(creation_date)>='".$start_dt."' ORDER BY id DESC");
                            $count = mysqli_num_rows($sqlQuery1);
                            //echo $count;
                        }
                        if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']!='')
                        {
                            $end_dt=date("Y-m-d", strtotime($end_date));
                            // echo $end_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_outward_adjustment WHERE DATE(creation_date)<='".$end_dt."' ORDER BY id DESC");
                            $count = mysqli_num_rows($sqlQuery1);
                            //echo $count;
                        }
                        if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']!='')
                        {
                            $end_dt=date("Y-m-d", strtotime($end_date));
                            $start_dt=date("Y-m-d", strtotime($strt_date));
                            // echo $start_dt."<br>".$end_dt."<br>";
                            $sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_outward_adjustment WHERE (DATE(creation_date) BETWEEN '".$start_dt."' AND '".$end_dt."') ORDER BY id DESC");
                            $count = mysqli_num_rows($sqlQuery1);
                            //echo $count;
                        }
                
                    //$sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_stock_transfer_wholeseller");
	    	    if($count>0)
	    	    {
	    	        $sl=1;
	    	        while($record=mysqli_fetch_object($sqlQuery1))
	    	        {
	    	           
                      ?>  
    	    	        <tr>
    	    	        <!--<td><?=$sl; ?></td>-->
    	                <td><?php $sqlss=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_sku WHERE id='".$record->sku."'")); echo $sqlss->name;?></td>
    	                <td><?php $sqlss1=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_warehouse WHERE id='".$record->warehouse_id."'")); echo $sqlss1->name;?></td>
    	                <td><?php $sqlss2=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_rack WHERE id='".$record->rack_id."'")); echo $sqlss2->name;?></td>
    	                <td><?=$record->quantity?></td>
    	                <?php if((in_array("21",$permission))) { ?><td><i class="fa fa-rupee" style="font-size:15px"></i>&nbsp;<?=$record->unit_price?></td><?php } ?>
    	                <td><?=$record->reason?></td>
    	    	        <td><?=date("d F Y",strtotime($record->creation_date)); ?></td>
    	    	        </tr>      
    	   	          
    	    		    <?php $sl++; } } ?>  
	    	    </tbody>
	    	    </table>
        
    <?php } ?>
<?php } ?>

        <script>  
            $(document).ready(function(){
              $(document).on("click", ".combo-details", function() {
                //   alert('test');
               var id= $(this).prop('id');
                // alert(id);
            	$.fancybox({
                     href : 'view_combo_product.php?id='+id+''
            
                  }, {
                      type: 'iframe'
                  });
              });
            });
        </script>