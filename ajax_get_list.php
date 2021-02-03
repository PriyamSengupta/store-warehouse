<?php
	session_start();

	if(@$_SESSION['valid_admin'] == "" )
	{
		@header("Location:login.php");
	}

	include_once("include/inc.php");

	$sku_id=$_REQUEST['sku'];
	$type=$_REQUEST['type'];
	?>
	
	<table id="datatable" class="table table-striped table-bordered">
                    <thead>
                      <tr class="headings">
                        <th>Sl no:</th>  
                        <th>Warehouse</th>
                        <th>Rack</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        	
<?php
    //echo $sku_id;
	$sqlQuery1=mysqli_query($db_handle,"SELECT product_id,name,combo_product_id FROM tbl_sku WHERE id='".$sku_id."'");
	$count=mysqli_num_rows($sqlQuery1);
	//echo $count;
	$sqlQuery=mysqli_fetch_object($sqlQuery1);
	//echo $sqlQuery->product_id;
	if($sqlQuery->product_id!=0)
	{
	    $pro_id=$sqlQuery->product_id;
	   //echo $pro_id;
	    $sqlpro=mysqli_query($db_handle,"SELECT ptw.quantity,w.name AS warehouse_name,r.name AS rack_name,ptw.unit_price,ptw.id,ptw.product_id FROM tbl_product_to_warehouse ptw LEFT JOIN tbl_warehouse w ON ptw.warehouse_id=w.id LEFT JOIN tbl_rack r ON ptw.rack_id=r.id WHERE ptw.product_id='".$pro_id."'");
	    if(mysqli_num_rows($sqlpro)>0)
	    {
	        $sl=1;
	        while($record=mysqli_fetch_object($sqlpro))
	        { ?>
	            <tr>
                      
                        <td><?=$sl; ?></td>
                        <td><?=$record->warehouse_name; ?></td>
                        <td><?=$record->rack_name?></td>
                        <td><?=$record->unit_price?></td>
                        <td><?=$record->quantity?></td>
                        <td><button type="button" class="btn btn-info btn-xs window" id="<?=$record->id?>" <?php if($record->quantity==0) { echo "disabled"; } ?>><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>Move to window</button></td>
	        <?php
	        $sl++;
	        }?>
	        </tbody></table>
	    <?php
	        
	        }
	    }
	    if($sqlQuery->combo_product_id!=0)
    	{
    	    $combo_pro_id=$sqlQuery->combo_product_id;
    	   //echo $pro_id;
    	    $sqlpro=mysqli_query($db_handle,"SELECT ptw.quantity,w.name AS warehouse_name,r.name AS rack_name,ptw.unit_price,ptw.id,ptw.combo_product_id FROM tbl_product_to_warehouse ptw LEFT JOIN tbl_warehouse w ON ptw.warehouse_id=w.id LEFT JOIN tbl_rack r ON ptw.rack_id=r.id WHERE ptw.combo_product_id='".$combo_pro_id."'");
    	    if(mysqli_num_rows($sqlpro)>0)
    	    {
    	        $sl=1;
    	        while($record=mysqli_fetch_object($sqlpro))
    	        { ?>
    	            <tr>
                          
                            <td><?=$sl; ?></td>
                            <td><?=$record->warehouse_name; ?></td>
                            <td><?=$record->rack_name?></td>
                            <td><?=$record->unit_price?></td>
                            <td><?=$record->quantity?></td>
                            <td><button type="button" class="btn btn-info btn-xs window" id="<?=$record->id?>" <?php if($record->quantity==0) { echo "disabled"; } ?>><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>Move to window</button></td>
    	        <?php
    	        $sl++;
    	        }?>
    	        </tbody></table>
    	    <?php
    	        
    	        }
    	    }
    
?>