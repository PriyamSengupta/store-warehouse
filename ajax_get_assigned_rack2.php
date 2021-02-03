<?php
	session_start();

	if(@$_SESSION['valid_admin'] == "" )
	{
		@header("Location:login.php");
	}

	include_once("include/inc.php");
	$sku=$_REQUEST['sku'];
    $warehouse_id=$_REQUEST['warehouse'];
    if($_REQUEST['flag']==1)
    {
        $sql_Q=mysqli_fetch_object(mysqli_query($db_handle,"SELECT combo_product_id,product_id FROM tbl_sku WHERE id='".$sku."'"));
        if($sql_Q->product_id!=0)
        { 
            
        	$sqlQuery=mysqli_query($db_handle,"SELECT r.name,ptw.rack_id,ptw.id FROM tbl_product_to_warehouse ptw LEFT JOIN tbl_rack r ON ptw.rack_id=r.id WHERE ptw.product_id='".$sql_Q->product_id."' AND ptw.warehouse_id='".$warehouse_id."' AND ptw.quantity!='0' ORDER BY ptw.id ASC");
        	if(mysqli_num_rows($sqlQuery)>0)
        	{ 	
                 ?>
        		<option value="">Select a Rack</option>
        	<?php
        	    while($sqlResult=mysqli_fetch_object($sqlQuery))
        		{ ?>
        			<option value="<?php echo $sqlResult->id; ?>"><?php echo $sqlResult->name; ?></option>
        		<?php
        		}
        	}
        	else 
        	{ ?>
        			<option value="">No Rack found</option>
        <?php
        	}

        }
        elseif($sql_Q->combo_product_id!=0)
        { 
            $sqlQuery=mysqli_query($db_handle,"SELECT r.name,ptw.rack_id,ptw.id FROM tbl_product_to_warehouse ptw LEFT JOIN tbl_rack r ON ptw.rack_id=r.id WHERE ptw.combo_product_id='".$sql_Q->combo_product_id."' AND ptw.warehouse_id='".$warehouse_id."' AND ptw.quantity!='0' ORDER BY ptw.id ASC");
        	if(mysqli_num_rows($sqlQuery)>0)
        	{ 	
                 ?>
                 
                                   
        		<option value="">Select a Rack</option>
        	<?php
        	    while($sqlResult=mysqli_fetch_object($sqlQuery))
        		{ ?>
        			<option value="<?php echo $sqlResult->id; ?>"><?php echo $sqlResult->name; ?></option>
        		<?php
        		}
        	}
        	else 
        	{ ?>
        			<option value="">No Rack found</option>
        <?php
        	}
        }
    }
    else
    {
    
        $count=$_REQUEST['count'];
        $sql_Q=mysqli_fetch_object(mysqli_query($db_handle,"SELECT product_id FROM tbl_sku WHERE name='".mysqli_real_escape_string($db_handle,$sku)."'")); ?>
        <select class='form-control col-md-2 col-sm-2 col-xs-8' name='ptw_id[]' id='ptw_id<?php echo $count;?>' onchange='get_id(this.value,<?php echo $count;?>)'  required>
        <?php
    	$sqlQuery=mysqli_query($db_handle,"SELECT r.name,ptw.rack_id,ptw.id FROM tbl_product_to_warehouse ptw LEFT JOIN tbl_rack r ON ptw.rack_id=r.id WHERE ptw.product_id='".$sql_Q->product_id."' AND ptw.warehouse_id='".$warehouse_id."' ORDER BY ptw.id ASC");
    	if(mysqli_num_rows($sqlQuery)>0)
    	{ 	
             ?>
             
                               
    		<option value="">Select a Rack</option>
    	<?php
    	    while($sqlResult=mysqli_fetch_object($sqlQuery))
    		{ ?>
    			<option value="<?php echo $sqlResult->id; ?>"><?php echo $sqlResult->name; ?></option>
    		<?php
    		}
    	}
    	else 
    	{ ?>
    			<option value="">No Rack found</option>
    <?php
    	}
    	
    ?>
    </select>
    <input type="hidden" id="product_id<?=$count?>" name="product_id[]" value="<?=$sql_Q->product_id?>">
<?php } ?>    