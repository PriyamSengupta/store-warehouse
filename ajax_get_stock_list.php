<?php
	session_start();

	if(@$_SESSION['valid_admin'] == "" )
	{
		@header("Location:login.php");
	}

	include_once("include/inc.php");

// 	$sku_id=$_REQUEST['sku'];
	$type=$_REQUEST['type'];
	
			session_start();
			$role=$_SESSION['role'];
			$sqlrole=mysqli_fetch_object(mysqli_query($db_handle,"SELECT access_permission,modify_permission FROM tbl_usergroup WHERE id='".$role."'"));
// 			$access_permission=$sqlrole->access_permission;
			$modify_permission=$sqlrole->modify_permission;
// 			$permission=explode(",",$access_permission);
			$permission1=explode(",",$modify_permission);
	
	?>
	
	<table id="datatable-brand" class="table table-striped table-bordered">
                    <thead>
                      <tr class="headings">
                        <th>Sl no:</th>
                        <th>Sku</th>
                        <th>From Warehouse</th>
                        <th>From Rack</th>
                        <th><?php if($_REQUEST['type']=='1') { ?>To Warehouse <?php } if($_REQUEST['type']=='2') { ?> Wholesaler <?php } ?></th>
                        <th><?php if($_REQUEST['type']=='1') { ?>To Rack <?php } if($_REQUEST['type']=='2') { ?> Comment <?php } ?></th>
                        <th>Stock Quantity</th>
                        <!--<th>Status</th>-->
                        <?php if((in_array("7",$permission1))) { ?><th>Action</th><?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                        	
<?php
    //echo $sku_id;
    if($type=='1'){
	$sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_stock_transfer_warehouse");
	    if(mysqli_num_rows($sqlQuery1)>0)
	    {
	        $sl=1;
	        while($record=mysqli_fetch_object($sqlQuery1))
	        { ?>
	            <tr>
                      
                        <td><?=$sl; ?></td>
                        <td><?php $sqlsku=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_sku WHERE id='".$record->sku."'")); echo $sqlsku->name;?></td>
                        <td><?php $sqlsku=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_warehouse WHERE id='".$record->from_warehouse."'")); echo $sqlsku->name; ?></td>
                        <td><?php $sqlsku=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_rack WHERE id='".$record->from_rack."'")); echo $sqlsku->name; ?></td>
                        <td><?php $sqlsku=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_warehouse WHERE id='".$record->to_warehouse."'")); echo $sqlsku->name; ?></td>
                        <td><?php $sqlsku=mysqli_fetch_object(mysqli_query($db_handle,"SELECT name FROM tbl_rack WHERE id='".$record->to_rack."'")); echo $sqlsku->name; ?></td>
                        <td><?=$record->stock_quant?></td>
                        <!--<td><?php if($record->status==0) { echo "Unapproved"; } else { echo "Approved"; }?></td>-->
                        <td><?php if((in_array("11",$permission1))) { ?>
                            <?php 
                            
                                if($record->status==0) { ?> 
                                    <a class="btn btn-info btn-xs" href="approve_stock_transfer.php?new_stock_id=<?=$record->id?>&id=<?=$record->product_to_warehouse_id?>&status=1"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>Approve</a> 
                                    <?php 
                                } 
                                else 
                                { ?> 
                                    <a class="btn btn-info btn-xs"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>Approved</a> 
                                    <?php 
                                } ?>
                            <?php } if((in_array("6",$permission)) || (in_array("6",$permission1))) { ?>
                                <a class="btn btn-info btn-xs" href="print_challan.php?new_stock_id=<?=$record->id?>&id=<?=$record->product_to_warehouse_id?>&status=1"><span class="glyphicon glyphicon-save-file" aria-hidden="true"></span>View Challan</a>
                            <?php } ?>
                        </td>
	        <?php
	        $sl++;
	        }?>
	        </tbody></table>
	    <?php
	        
	   }
    }
    if($type=='2')
    {
    	$sqlQuery1=mysqli_query($db_handle,"SELECT * FROM tbl_stock_transfer_wholeseller");
    	    if(mysqli_num_rows($sqlQuery1)>0)
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
                            <td><?=$record->comment?></td>
                            <td><?=$record->stock_quant?></td>
                            <!--<td><?php if($record->status==0) { echo "Unapproved"; } else { echo "Approved"; }?></td>-->
                            <?php if((in_array("7",$permission1))) { ?><td>
                                <?php 
                                    if($record->status==0) 
                                    { ?>
                                        <a class="btn btn-link btn-xs" href="approve_stock_transfer.php?new_stock_id=<?=$record->id?>&id=<?=$record->product_to_warehouse_id?>&status=2"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>Approve</a> 
                                        <?php 
                                        }
                                        else 
                                        { ?> 
                                            <a class="btn btn-link btn-xs"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>Approved</a> 
                                        <?php 
                                        } ?>
                            </td><?php } ?>
    	        <?php
    	        $sl++;
    	        }?>
    	        </tbody></table>
    	    <?php
    	        
    	   }
    }
?>