<?php

$server = "localhost";



	$user_name = "jfingert_stocksa";



	$password = "PKaemsu=cTzM";



	$database = "jfingert_saakshistock";



	$db_handle = mysql_connect($server, $user_name, $password) or die("CONNECTION FAILED");	



	$db_found = mysql_select_db($database, $db_handle) or die("DATABASE NOT FOUND");

	

if (!defined('IN_CB')) { die('You are not allowed to access to this page.'); }

?>



            <div class="output">

                <section class="output">

                    <h3>Output&nbsp;&nbsp;&nbsp;<a href="javascript:Clickheretoprint()" style="color: #000000; text-decoration: none;">Print</a></h3>

                    

                    <?php

                    

                        $array_length='';

                        $finalRequest = '';

                        $key='';

                        $value='';

                      

                    

                        foreach (getImageKeys() as $key => $value) {

                        	

                        $new_array=$imageKeys['text'];	

                    

                        	$arr=explode('@',$new_array);

                        

                         $array_length=sizeof($arr);

                        

                        	 foreach ($arr as $val) {

                      

                    

                         $ns= '&' . $key . '=';

                       		

                        		if($key=='text')

                    			 {

								 

                        		 	 $vl= urlencode($val);

                        		 	  $finalRequest .= $ns . urlencode($vl);

                        		 	 

                        		}

                        		else

                        		{

									$finalRequest .= $ns . urlencode($value);

								} 	 

                        

                        }

                        

                       }

                      

                        

                        if (strlen($finalRequest) > 0) {

                            $finalRequest[0] = '?';

                        }

                    ?>

                    <div id="imageOutput">

						<?php

					

						 foreach ($arr as $val) {

						 	

                 

                       $new_array=$imageKeys['text'];	

                    

                        	$arr=explode('@',$new_array);

                        

                         $array_length=sizeof($arr);

                     

                 

                    foreach (getImageKeys() as $key => $value) {

                    

                    

                         $ns= '&' . $key . '=';

                       			

                        	if($key=='text')

                    		 {

							 	 $vl= urlencode($val);

                        		 	  $finalRequest .= $ns . urlencode($vl);

                        		 	 

                        		}

                        		else

                        		{

									$finalRequest .= $ns . urlencode($value);

								} 	

								

							}

								

								

								$_SESSION['final']=$finalRequest;

                                   ?>

                           

                        <div style="height: 50px;width: 165px;float: left;font-size: 10px; margin-top:20px;" >           

                      

                        <?php

                        	

                         $sql_p=mysql_fetch_array(mysql_query("select * from tbl_product where barcode_no='".$vl."'"));

                        

                    	$brand=$sql_p['product_brand'];

                         

                         $category=$sql_p['product_category'];

                         

                       

                         

                         $sqlb = mysql_fetch_assoc(mysql_query("SELECT * FROM tbl_productbrand where status='0' and id='".$brand."' ORDER BY id ASC"));

                         

                         $sqlc = mysql_fetch_assoc(mysql_query("SELECT * FROM tbl_productcategory where status='0' and id='".$category."' ORDER BY id ASC"));

                         

                         $sqlu = mysql_fetch_assoc(mysql_query("SELECT * FROM tbl_product_unit where status='0' and id='".$sql_p['unit']."' ORDER BY id ASC"));

                         

                         $sqls = mysql_fetch_assoc(mysql_query("SELECT * FROM tbl_product_size where status='0' and id='".$sql_p['size']."' ORDER BY id ASC"));

                         

                         

                         

                         $_SESSION['final']=$finalRequest;

                      

                       $er=array_unique(explode('&', $finalRequest));

                       

                      

                       

                       $str = implode('&',array_unique(explode('&', $finalRequest)));

                       

                       ?>

                         <div style="float: left; width: 30%; align:left; font-size:9px;">

                         <div><b><?php echo $sqlb['brand_name']; ?></b></div>

                         <div><b><?php echo $sqlc['category_name'];?></b></div>

                         <div><b><strong><?php echo $sqls['size'];?></strong>&nbsp;<?php echo $sqlu['unit'];?></b></div>

                        

                        

                        

                        

                         </div>

                         

                          <div style="float: left; width: 62%">
                               <div style="text-transform:uppercase; font-size:9px;"><b><strong><?php echo $sql_p['barcode_text'];?></strong></b></div>
                           <img style="margin: 1px 7px 5px 0;" src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" width="85"/>

                          

                           <div style="margin:0px 7px;"><strong>Rs. <?php echo $sql_p['product_price']/$sql_p['product_quantity'];?></strong>/-</div>

                           

                        </div>
                         </div> 
                        <?php

                        }

                         

                      /*}*/

						

                        

						/*}*/

						?>

						

						

                        <?php /*if ($imageKeys['text'] !== '') {  $finalRequest;?><img style="margin: 0 20px 20px 0;" src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" /><?php }

                        else { ?>Fill the form to generate a barcode.<?php } }*/?>

                    </div>

                    

                    

                </section>

            </div>

        



        <div class="footer">

            <footer>

            All Rights Reserved &copy; <?php date_default_timezone_set('UTC'); echo date('Y'); ?> <a href="http://www.barcodephp.com" target="_blank">Barcode Generator</a>

            <br /><?php echo $code; ?> PHP5-v<?php echo $codeVersion; ?>

            </footer>

        </div>

    </body>

</html>