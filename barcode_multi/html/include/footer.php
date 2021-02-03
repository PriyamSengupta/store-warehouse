<?php

	$server = "localhost";
	$user_name = "panwor6_store_wh";
	$password = "Z7wFy;lN4~S,";
	$database = "panwor6_store_warehouse";
	$db_handle = mysqli_connect($server, $user_name, $password, $database) or die("CONNECTION FAILED");	

	

if (!defined('IN_CB')) { die('You are not allowed to access to this page.'); }

?>
        <?php if($_REQUEST['type']=='1') { ?>
            <div class="output">
                <section class="output">
                    <h3>Output:&nbsp;&nbsp;&nbsp;<a href="javascript:Clickheretoprint()" style="color: #000000; text-decoration: none;">Print</a></h3>
                    <?php
                        $finalRequest = '';
                        foreach (getImageKeys() as $key => $value) {
                            $finalRequest .= '&' . $key . '=' . urlencode($value);
                        }
                        if (strlen($finalRequest) > 0) {
                            $finalRequest[0] = '?';
                        }
                    ?>
                    <div id="imageOutput">
						<?php
						$N=$ncode;
						for($i=0; $i < $N; $i++)
						{
						?>
						
						
						<div style="height: 50px;width: 165px;float: left;font-size: 10px" >           

                      

                        <?php

                        	

                        $sql_p=mysqli_fetch_array(mysqli_query($db_handle,"SELECT r.name AS rack,w.name AS warehouse FROM tbl_rack r LEFT JOIN tbl_warehouse w ON r.warehouse_id=w.id WHERE r.barcode_no='".$_REQUEST['text']."'"));

                        $_SESSION['final']=$finalRequest;

                      

                       $er=array_unique(explode('&', $finalRequest));

                       $str = implode('&',array_unique(explode('&', $finalRequest)));

                       

                       ?>
                         
                         
                         <div style="float: left; width: 30% padding-right:5px" align="left">

                         <div><b><?php echo $sql_p['rack']; ?></b></div>

                         </div>

                         

                          <div style="float: left; width: 62%">

                           <img style="margin: 0 7px 5px 0;" src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" width="85"/>

                           <!--<div style="transform: rotate(90deg);transform-origin: right top 66px;float: right; font-size: 11px;"><strong><?php echo $sql_p['barcode_text'];?></strong></div>-->

                        </div>

           

                         </div> 
						
						
                        <?php /*if ($imageKeys['text'] !== '') { ?><img style="margin: 0 20px 20px 0;" src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" /><?php }
                        else { ?>Fill the form to generate a barcode.<?php }*/ }?>
                    </div>
                </section>
            </div>
            <?php } 
            if($_REQUEST['type']=='2') { 
            ?>
                <div class="output">
                <section class="output">
                    <h3>Output:&nbsp;&nbsp;&nbsp;<a href="javascript:Clickheretoprint()" style="color: #000000; text-decoration: none;">Print</a></h3>
                    <?php
                        $finalRequest = '';
                        foreach (getImageKeys() as $key => $value) {
                            $finalRequest .= '&' . $key . '=' . urlencode($value);
                        }
                        if (strlen($finalRequest) > 0) {
                            $finalRequest[0] = '?';
                        }
                    ?>
                    <div id="imageOutput">
						<?php
						$N=$ncode;
						for($i=0; $i < $N; $i++)
						{
						?>
						
						
						<div style="height: 50px;width: 165px;float: left;font-size: 10px" >           

                      

                        <?php

                        	

                        $sql_p=mysqli_fetch_array(mysqli_query($db_handle,"SELECT s.name AS sku,p.quantity FROM tbl_products p LEFT JOIN tbl_sku s ON p.sku=s.id WHERE p.barcode_no='".$_REQUEST['text']."'"));

                        $_SESSION['final']=$finalRequest;

                      

                       $er=array_unique(explode('&', $finalRequest));

                       $str = implode('&',array_unique(explode('&', $finalRequest)));

                       

                       ?>
                         
                         
                         <div style="float: left; width: 30% padding-right:5px" align="left">

                         <div><b><?php echo $sql_p['sku']; ?></b></div>

                         </div>

                         

                          <div style="float: left; width: 62%">

                           <img style="margin: 0 7px 5px 0;" src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" width="100"/>
                           
                           <div style="margin:0px 7px;"><strong>Qty: <?php echo $sql_p['quantity'];?></strong></div>

                           <!--<div style="transform: rotate(90deg);transform-origin: right top 66px;float: right; font-size: 11px;"><strong><?php echo $sql_p['barcode_text'];?></strong></div>-->

                        </div>

           

                         </div> 
						
						
                        <?php /*if ($imageKeys['text'] !== '') { ?><img style="margin: 0 20px 20px 0;" src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" /><?php }
                        else { ?>Fill the form to generate a barcode.<?php }*/ }?>
                    </div>
                    </section>
                </div>
                
                <?php } 
                if($_REQUEST['type']=='3') { ?>
                <div class="output">
                <section class="output">
                    <h3>Output:&nbsp;&nbsp;&nbsp;<a href="javascript:Clickheretoprint()" style="color: #000000; text-decoration: none;">Print</a></h3>
                    <?php
                        $finalRequest = '';
                        foreach (getImageKeys() as $key => $value) {
                            $finalRequest .= '&' . $key . '=' . urlencode($value);
                        }
                        if (strlen($finalRequest) > 0) {
                            $finalRequest[0] = '?';
                        }
                    ?>
                    <div id="imageOutput">
						<?php
						$N=$ncode;
						for($i=0; $i < $N; $i++)
						{
						?>
						
						
						<div style="height: 50px;width: 165px;float: left;font-size: 10px" >           

                      

                        <?php

                        	

                        $sql_p=mysqli_fetch_array(mysqli_query($db_handle,"SELECT s.name AS sku,cp.quantity FROM tbl_combo_product cp LEFT JOIN tbl_sku s ON cp.sku=s.id WHERE cp.barcode_no='".$_REQUEST['text']."'"));

                        $_SESSION['final']=$finalRequest;

                      

                       $er=array_unique(explode('&', $finalRequest));

                       $str = implode('&',array_unique(explode('&', $finalRequest)));

                       

                       ?>
                         
                         
                         <div style="float: left; width: 30%; padding-right:5px" align="left">

                         <div><b><?php echo $sql_p['sku']; ?></b></div>

                         </div>
                            
                         

                          <div style="float: left; width: 62%">

                           <img style="margin: 0 7px 5px 0;" src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" width="100"/>
                           
                           <div style="margin:0px 7px;"><strong>Qty: <?php echo $sql_p['quantity'];?></strong></div>

                           <!--<div style="transform: rotate(90deg);transform-origin: right top 66px;float: right; font-size: 11px;"><strong><?php echo $sql_p['barcode_text'];?></strong></div>-->

                        </div>

           

                         </div> 
						
						
                        <?php /*if ($imageKeys['text'] !== '') { ?><img style="margin: 0 20px 20px 0;" src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" /><?php }
                        else { ?>Fill the form to generate a barcode.<?php }*/ }?>
                    </div>
                    </section>
                </div>
                
                <?php } ?>
            
        </form>

        <div class="footer">
            <footer>
            All Rights Reserved &copy; <?php date_default_timezone_set('UTC'); echo date('Y'); ?> <a href="http://www.barcodephp.com" target="_blank">Barcode Generator</a>
            <br /><?php echo $code; ?> PHP5-v<?php echo $codeVersion; ?>
            </footer>
        </div>
    </body>
</html>