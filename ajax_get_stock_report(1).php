<?php
	session_start();

	if(@$_SESSION['valid_admin'] == "" )
	{

		@header("Location:login.php");
	}

	include_once("include/inc.php");
	
    
        $date = date('Y-m-d');
        $sku=$_REQUEST['sku']; 
        $role=$_SESSION['role'];
		$sqlrole=mysqli_fetch_object(mysqli_query($db_handle,"SELECT access_permission,modify_permission FROM tbl_usergroup WHERE id='".$role."'"));
		$access_permission=$sqlrole->access_permission;
		$permission=explode(",",$access_permission);
		
		$strt_date=$_REQUEST['start_dt'];
        $end_date=$_REQUEST['end_dt'];
        
    ?>
      <h4><u>Stock Report</u></h4>

    
            <table id="datatable-brand" class="table table-striped table-bordered abc" style="width:100%">
               
                    <thead>
                         <tr>
                            <th colspan="2"></th>
                            <th colspan="2" class="text-center">Opening Stock</th>
                            <th colspan="2" class="text-center">Stock In</th>
                            <th colspan="2" class="text-center">Stock out</th>
                            <th colspan="2" class="text-center">Closing Stock</th>
                        </tr>
                      <tr>
                       <!--<th>Sl No.</th>-->
                        <!--<th>SKU</th>-->
                        <th>Wh</th>
                        <th>Rack</th>
                        <th>Qty</th>
                        <th>Unit</th>
                        <!--<th>Wh</th>-->
                        <!--<th>Rack</th>-->
                        <th>Qty</th>
                        <th>Unit</th>
                        <!--<th>Status</th>-->
                        <!--<th>Wh</th>-->
                        <!--<th>Rack</th>-->
                        <th>Qty</th>
                        <th>Unit</th>
                        <!--<th>Status</th>-->
                        <!--<th>Wh</th>-->
                        <!--<th>Rack</th>-->
                        <th>Qty</th>
                        <th>Unit</th>
                        <!--<?php if((in_array("21",$permission))) { ?><th>Unit Price</th><?php } ?>-->
                        <!--<th>Quantity</th>-->
                        <!--<?php if((in_array("21",$permission))) { ?><th>Total Price</th><?php } ?>-->
                        <!--<th>Status</th>-->
                      </tr>

                    </thead>

                    <tbody>
                        <?php
                        if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']==''){
						    $sqlview = mysqli_fetch_object(mysqli_query($db_handle,"SELECT sku,SUM(quantity),SUM(total_price) FROM tbl_opening_stock WHERE sku='".$sku."'"));
						    $sqlview1 = mysqli_fetch_object(mysqli_query($db_handle,"SELECT sku,SUM(quantity),SUM(total_price) FROM tbl_opening_stock WHERE sku='".$sku."'"));
                            $count = mysqli_num_rows($sqlview);
                        }
                        if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']=='')
                        {
                            $start_dt=date("Y-m-d", strtotime($strt_date) );
                            // echo $start_dt."<br>";
                            $sqlview = mysqli_fetch_object(mysqli_query($db_handle,"SELECT sku,ptw_id,SUM(quantity),SUM(total_price) FROM tbl_opening_stock WHERE sku='".$sku."' AND (DATE(date)>='".$start_dt."')"));
                            // $count = mysqli_num_rows($sqlview);
                            //echo $count;
                        }
                        if($_REQUEST['start_dt']=='' && $_REQUEST['end_dt']!='')
                        {
                            $end_dt=date("Y-m-d", strtotime($end_date));
                            // echo $end_dt."<br>";
                            $sqlview = mysqli_fetch_object(mysqli_query($db_handle,"SELECT sku,ptw_id,SUM(quantity),SUM(total_price) FROM tbl_opening_stock WHERE sku='".$sku."' AND (DATE(date)<='".$end_dt."')"));
                            // $count = mysqli_num_rows($sqlview);
                            //echo $count;
                        }
                        if($_REQUEST['start_dt']!='' && $_REQUEST['end_dt']!='')
                        {
                            $end_dt=date("Y-m-d", strtotime($end_date));
                            $start_dt=date("Y-m-d", strtotime($strt_date));
                            // echo $start_dt."<br>".$end_dt."<br>";
                            $sqlview = mysqli_fetch_object(mysqli_query($db_handle,"SELECT sku,SUM(quantity),SUM(total_price) FROM tbl_opening_stock WHERE sku='".$sku."' AND (DATE(date) BETWEEN '".$start_dt."' AND '".$end_dt."')"));
                            // $count = mysqli_num_rows($sqlview);
                            //echo $count;
                        }
                        
                        $data=array(
                            'open_qty'=>$sqlview->quantity,
                            'open_total'=>$sqlview->total_price,
                            'open_sku'=>$sqlview->sku
                            );
						
						?>
						
                    </tbody>
                    </table>
   