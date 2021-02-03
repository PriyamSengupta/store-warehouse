<?php include_once("include/inc.php");
if($_REQUEST['type']==1){
?>
<ul id="search" style="overflow: auto; height:100px">
<?php
$sku=$_REQUEST['sku'];
$sqlsearch=mysqli_query($db_handle,"SELECT * FROM tbl_sku WHERE (product_id!=0 OR combo_product_id!=0) AND name LIKE '%".$sku."%' AND flag='1'");
$count=mysqli_num_rows($sqlsearch);
if($count==0){ ?>
<ul>Sorry! No SKU Found</ul>
<?php
}
else
{
    $i=0;
    while($sqls=mysqli_fetch_object($sqlsearch)) {?>
    <a href="javascript:void(0)" class='window2' onclick="getval5(<?=$sqls->id?>,'<?=$sqls->name?>')" id="<?=$sqls->name?>"><ul><?=$sqls->name?></ul></a>
    <?php 
    $i++;
    }} ?>
</ul>
<?php }
if($_REQUEST['type']==2) { 
$count1= $_REQUEST['count'];
?>
  <ul id="search<?=$count1?>" style="overflow: auto; height:120px">
        <?php
        
        $sku=$_REQUEST['sku'];
        $sqlsearch=mysqli_query($db_handle,"SELECT s.id,s.name FROM tbl_products p LEFT JOIN tbl_sku s ON p.sku=s.id WHERE p.quantity!=0 AND s.product_id!=0 AND s.name LIKE '%".$sku."%' AND s.flag='1' ORDER BY id ASC"); 
        $count=mysqli_num_rows($sqlsearch);
        if($count==0){ ?>
        <ul>Sorry! No SKU Found</ul>
        <?php
        }
        else
        {?>
        
            <input type="hidden" id="count" value="<?=$count1?>">
            
            <?php
            // $i=0;
            while($sqls=mysqli_fetch_object($sqlsearch)) {?>
            <a href="javascript:void(0)" onclick="getval4(<?=$sqls->id?>,<?=$count1?>,'<?=$sqls->name?>')" class="window" id="<?=$sqls->name?>"><ul><?=$sqls->name?></ul></a>
            <?php 
            $i++;
            }} ?>
        </ul>
<!--</div>-->
<?php    
} if($_REQUEST['type']==3) { ?>
    <ul id="search" style="overflow: auto; height:120px">
<?php
// $count1= $_REQUEST['count'];
$sku=$_REQUEST['sku'];
$sqlsearch=mysqli_query($db_handle,"SELECT id,name FROM tbl_sku WHERE (product_id=0 AND combo_product_id=0) AND name LIKE '%".$sku."%' AND flag='1' ORDER BY id ASC"); 
$count=mysqli_num_rows($sqlsearch);
if($count==0){ ?>
<ul>Sorry! No SKU Found</ul>
<?php
}
else
{?>

    <!--<input type="hidden" id="count" value="<?=$count1?>">-->
    
    <?php
    // $i=0;
    while($sqls=mysqli_fetch_object($sqlsearch)) {?>
    <a href="javascript:void(0)" class="window1" onclick="getval1(<?=$sqls->id?>,'<?=$sqls->name?>')" id="<?=$sqls->name?>"><ul><?=$sqls->name?></ul></a>
    <!--<input type="hidden" value="<?=$sqls->id?>" id="sku_1" name="sku">-->
    <?php 
    $i++;
    }} ?>
</ul>

<?php } if($_REQUEST['type']==4) { ?>

    <ul id="search" style="overflow: auto; height:120px">
    <?php
    // $count1= $_REQUEST['count'];
    $sku=$_REQUEST['sku'];
    $sqlsearch=mysqli_query($db_handle,"SELECT id,name FROM tbl_sku WHERE (product_id=0 AND combo_product_id=0) AND name LIKE '%".$sku."%' AND flag='1' ORDER BY id ASC"); 
    $count=mysqli_num_rows($sqlsearch);
    if($count==0){ ?>
    <ul>Sorry! No SKU Found</ul>
    <?php
    }
    else
    {?>
    
        <!--<input type="hidden" id="count" value="<?=$count1?>">-->
        
        <?php
        // $i=0;
        while($sqls=mysqli_fetch_object($sqlsearch)) {?>
        <a href="javascript:void(0)" class="window1" onclick="getval(<?=$sqls->id?>,'<?=$sqls->name?>')" id="<?=$sqls->name?>"><ul><?=$sqls->name?></ul></a>
        <!--<input type="hidden" value="<?=$sqls->id?>" id="sku" name="sku">-->
        <?php 
        $i++;
        }} ?>
    </ul>


<?php } if($_REQUEST['type']==5) { ?>

    <ul id="search" style="overflow: auto; height:120px">
    <?php
    // $count1= $_REQUEST['count'];
    $sku=$_REQUEST['sku'];
    $sqlsearch=mysqli_query($db_handle,"SELECT * FROM tbl_sku WHERE status=1 AND ( product_id!=0 OR combo_product_id!=0 ) AND name LIKE '%".$sku."%' AND flag='1' ORDER BY id ASC"); 
    $count=mysqli_num_rows($sqlsearch);
    if($count==0){ ?>
    <ul>Sorry! No SKU Found</ul>
    <?php
    }
    else
    {?>
    
        <!--<input type="hidden" id="count" value="<?=$count1?>">-->
        
        <?php
        // $i=0;
        while($sqls=mysqli_fetch_object($sqlsearch)) {?>
        <a href="javascript:void(0)" class="window3" onclick="getval(<?=$sqls->id?>,'<?=$sqls->name?>')" id="<?=$sqls->name?>"><ul><?=$sqls->name?></ul></a>
        <!--<input type="hidden" value="<?=$sqls->id?>" id="sku" name="sku">-->
        <?php 
        $i++;
        }} ?>
    </ul>
<?php } if($_REQUEST['type']==6) { ?>
    
                <ul id="search" style="overflow: auto; height:120px">
                <?php
                $count1= $_REQUEST['count'];
                $sku=$_REQUEST['sku'];
                $sqlsearch=mysqli_query($db_handle,"SELECT * FROM tbl_sku WHERE status=1 AND ( product_id!=0 OR combo_product_id!=0 ) AND name LIKE '%".$sku."%' AND flag='1' ORDER BY id ASC"); 
                $count=mysqli_num_rows($sqlsearch);
                if($count==0){ ?>
                <ul>Sorry! No SKU Found</ul>
                <?php
                }
                else
                {?>
                
                    <!--<input type="hidden" id="count" value="<?=$count1?>">-->
                    
                    <?php
                    // $i=0;
                    while($sqls=mysqli_fetch_object($sqlsearch)) {?>
                    <a href="javascript:void(0)" class="window3" onclick="getval2('<?=$sqls->id?>',<?=$count1?>,'<?=$sqls->name?>')" id="<?=$sqls->name?>"><ul><?=$sqls->name?></ul></a>
                    <!--<input type="hidden" value="<?=$sqls->id?>" id="sku" name="sku">-->
                    <?php 
                    $i++;
                    }} ?>
                </ul>    

<?php } if($_REQUEST['type']==7) { ?>

                <ul id="search" style="overflow: auto; height:120px">
                <?php
                // $count1= $_REQUEST['count'];
                $sku=$_REQUEST['sku'];
                // $sqlsearch=mysqli_query($db_handle,"SELECT * FROM tbl_sku WHERE status=1 AND ( product_id!=0 OR combo_product_id!=0 ) AND name LIKE '%".$sku."%' ORDER BY id ASC"); 
            $sqlsearch=mysqli_query($db_handle,"SELECT s.name AS sku,s.id FROM tbl_processed_order po LEFT JOIN tbl_sku s ON po.sku=s.id WHERE s.name LIKE '%".$sku."%' GROUP BY po.sku");    
                $count=mysqli_num_rows($sqlsearch);
                if($count==0){ ?>
                <ul>Sorry! No SKU Found</ul>
                <?php
                }
                else
                {?>
                
                    <!--<input type="hidden" id="count" value="<?=$count1?>">-->
                    
                    <?php
                    // $i=0;
                    while($sqls=mysqli_fetch_object($sqlsearch)) {?>
                    <a href="javascript:void(0)" class="window3" onclick="getval3('<?=$sqls->sku?>')"><ul><?=$sqls->sku?></ul></a>
                    <!--<input type="hidden" value="<?=$sqls->id?>" id="sku" name="sku">-->
                    <?php 
                    $i++;
                    }} ?>
                </ul>    

<?php } if($_REQUEST['type']==8) { ?>
    
            <ul id="search" style="overflow: auto; height:120px">
                <?php
                // $count1= $_REQUEST['count'];
                $sku=$_REQUEST['sku'];
                $sqlsearch=mysqli_query($db_handle,"SELECT * FROM tbl_sku WHERE status=1 AND ( product_id!=0 OR combo_product_id!=0 ) AND name LIKE '%".$sku."%' AND flag='1' ORDER BY id ASC"); 
                $count=mysqli_num_rows($sqlsearch);
                if($count==0){ ?>
                <ul>Sorry! No SKU Found</ul>
                <?php
                }
                else
                {?>
                
                    <!--<input type="hidden" id="count" value="<?=$count1?>">-->
                    
                    <?php
                    // $i=0;
                    while($sqls=mysqli_fetch_object($sqlsearch)) {?>
                    <a href="javascript:void(0)" class="window3" onclick="getval1(<?=$sqls->id?>,'<?=$sqls->name?>')" id="<?=$sqls->name?>"><ul><?=$sqls->name?></ul></a>
                    <!--<input type="hidden" value="<?=$sqls->id?>" id="sku" name="sku">-->
                    <?php 
                    $i++;
                    }} ?>
                </ul>

<?php } if($_REQUEST['type']==9) { ?>
                
                <ul id="search" style="overflow: auto; height:120px">
                <?php
                // $count1= $_REQUEST['count'];
                $sku=$_REQUEST['sku'];
                // $sqlsearch=mysqli_query($db_handle,"SELECT ia.ptw_id,ia.sku_name,ia.id,w.name AS warehouse,r.name AS rack,ia.unit_price,ia.quantity FROM tbl_inward_adjustment ia LEFT JOIN tbl_warehouse w ON ia.warehouse=w.id LEFT JOIN tbl_rack r ON ia.rack=r.id WHERE ia.sku_name LIKE '%".$sku."%'"); 
                // $count=mysqli_num_rows($sqlsearch);
                
                $sqlsearch=mysqli_query($db_handle,"SELECT * FROM tbl_sku WHERE status=1 AND ( product_id!=0 OR combo_product_id!=0 ) AND name LIKE '%".$sku."%' AND flag='1' ORDER BY id ASC"); 
                $count=mysqli_num_rows($sqlsearch);
        
                if($count==0){ ?>
                <ul>Sorry! No SKU Found</ul>
                <?php
                }
                else
                {?>
                
                    <!--<input type="hidden" id="count" value="<?=$count1?>">-->
                    
                    <?php
                    // $i=0;
                    while($sqls=mysqli_fetch_object($sqlsearch)) {?>
                    <a href="javascript:void(0)" class="window3" onclick="getval6(<?=$sqls->id?>,'<?=$sqls->name?>')"><ul><?=$sqls->name?></ul></a>
                    <!--<input type="hidden" value="<?=$sqls->id?>" id="sku" name="sku">-->
                    <?php 
                    $i++;
                    }} ?>
                </ul>

<?php } ?>
<script>
        	$('#search').click(function(e) {
                //e.stopPropagation();
            });
        
            $(document).click(function() {
                $('#search').fadeOut(300);
            });

</script>
<script>
//         $(document).on('click', '.window2', function () {
//         // alert(this.id);
//         document.getElementById('sku').value=this.id;
// });
</script>

<script>
    function getval5(id,name)
    {
        document.getElementById('sku').value=name;
        document.getElementById('sku_id').value=id;
        
        $('#d1').hide();
        // alert(id);
        // alert(name);
        var flag=1;
        
                    $.ajax({
                        type: 'POST',
                            url: 'ajax_get_wh.php',
                            data: {'sku':id,'flag':flag},
                            success: function(data)
                            {
                                $('#warehouse_id').prop("disabled", false);
                                $('#warehouse_id').html(data);  
                                
                            }
            
                        });
    }
    /*function getval6(id,sku_name,warehouse,rack,quant,unit,ptw_id)
    {
        // alert(sku);
        document.getElementById('s1').value=sku_name;
        document.getElementById('id').value=id;
        // document.getElementById('sku').value=sku;
        document.getElementById('warehouse').value=warehouse;
        document.getElementById('rack').value=rack;
        document.getElementById('quant').value=quant;
        document.getElementById('unit_price').value=unit;
        document.getElementById('ptw_id').value=ptw_id;
        $('#div_search').hide();
        $('#add').prop('disabled',false);
        $('#warehouse').prop('disabled',true);
        $('#rack').prop('disabled',true);
    }*/
    
    function getval6(id,sku_name)
    {
        // alert(sku_name);
        document.getElementById('s1').value=sku_name;
        document.getElementById('id').value=id;
        // document.getElementById('sku').value=sku;
        var flag=1;
        $('#div_search').hide();
        $('#add').prop('disabled',false);
        
            $.ajax({
                        type: 'POST',
                            url: 'ajax_get_wh.php',
                            data: {'sku':id,'flag':flag},
                            success: function(data)
                            {
                                $('#warehouse').prop("disabled", false);
                                $('#warehouse').html(data);  
                                
                            }
            
                    });
    }
    
</script>

<script>
    function getval1(id,name)
    {
        document.getElementById('s1').value=name;
        document.getElementById('sku').value=id;
        $('#add').prop("disabled", false);
        $('#div_search').hide();
        // $('#unit_price').show();
        // $('#show_form').show();
    }

    function getval4(id,count,name)
    {
        
        // alert(id);
        // alert(count);
        document.getElementById('sku_search'+count).value=name;
        var flag=1;
        $('#div'+count).hide();
        // count=0;
        
                    $.ajax({
                        type: 'POST',
                            url: 'ajax_get_wh.php',
                            data: {'sku':id,'flag':flag},
                            success: function(data)
                            {
                                $('#warehouse_id'+count).prop("disabled", false);
                                $('#warehouse_id'+count).html(data);  
                                
                            }
            
                        });
        
    }

    function getval(id,name)
    {
        document.getElementById('s1').value=name;
        document.getElementById('sku1').value=id;
        $('#div1').hide();
        $('#unit_price').show();
        $('#show_form').show();
    }
    
    
    
    function getval2(id,count,name)
    {
        // alert(count);
         var index=count-2;
         
        if(sku_array.indexOf(id)==-1 || sku_array.indexOf(id)==index)
        {
            sku_array[index]=id;
            // sku_array.push(id);
            console.log(sku_array);
            document.getElementById('sku'+count).value=name;
            document.getElementById('sku_id'+count).value=id;
        }
        else
        {
            if(sku_array[index]=='')
            {
                document.getElementById('sku'+count).value='';
                document.getElementById('sku_id'+count).value='';
            } 
            alert("You've already choose this SKU");
            sku_array[index]='';
            document.getElementById('sku'+count).value='';
            document.getElementById('sku_id'+count).value='';
            $('#add_in').prop("disabled", false);
            
        }
        
        // document.getElementById('sku1').value=id;
        $('#div'+count).hide();
    }
    
    function getval3(name)
    {
        document.getElementById('s1').value=name;
        $('#div_search').hide();
        $('#add').prop("disabled", false);
        $('#warehouse_id').prop("disabled",false);
    }
</script>
