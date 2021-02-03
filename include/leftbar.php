<div class="col-md-3 left_col">



        <div class="left_col scroll-view">



          <div class="navbar nav_title" style="border: 0;">

            <a href="dashboard.php" class="site_title"><span><img src="images/logo2.png" style="height:95px; width:225px"></span></a>

          </div>



          <div class="clearfix"></div>



          <!-- menu prile quick info -->



          <!--<div class="profile">



            <div class="profile_pic">            



            <?php



            	if($sqladmindata->profile_image == ""){



            	 ?>



            	   <img src="images/admin/no-user-image.png" class="img-circle profile_img">    



            	 <?php }else{ ?>



              		<img src="images/admin/<?php echo $sqladmindata->profile_image; ?>" class="img-circle profile_img">



              <?php } ?>



            </div>



            <div class="profile_info">



              <span>Welcome,</span>



              <h2><?php echo $sqladmindata->fname; ?></h2>



            </div>



          </div>-->



          <!-- /menu prile quick info -->



          <br />



          <!-- sidebar menu -->



          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">



            <div class="menu_section">



             <!-- <h3><?php echo $sqladmindata->proffetion; ?></h3>-->
<h3>Admin</h3>
			<?php 
			session_start();
			$role=$_SESSION['role'];
			$sqlrole=mysqli_fetch_object(mysqli_query($db_handle,"SELECT access_permission,modify_permission FROM tbl_usergroup WHERE id='".$role."'"));
			$access_permission=$sqlrole->access_permission;
			$modify_permission=$sqlrole->modify_permission;
			$permission=explode(",",$access_permission);
			$permission1=explode(",",$modify_permission);
			
			$sqlcount=mysqli_query($db_handle,"SELECT * FROM tbl_order WHERE status='0'");
			$count=mysqli_num_rows($sqlcount);
			
// 			print_r($permission);
			?>

              <ul class="nav side-menu">
               <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                 <ul class="nav child_menu" style="display: none">
                   <li><a href="dashboard.php">Dashboard</a></li>
                 </ul>
               </li>
               
               <?php 
               if((in_array("1",$permission)) || (in_array("2",$permission)) || (in_array("3",$permission)) || (in_array("1",$permission1)) || (in_array("2",$permission1)) || (in_array("3",$permission1))) { ?>
               <li><a><i class="fa fa-shopping-cart"></i>Master<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <!--<li><a href="add_new_warehouse.php">Add warehouse</a></li>-->
                    <li <?php if((in_array("1",$permission)) || (in_array("1",$permission1))) { ?> style="display:block" <?php } else {?> style="display:none" <?php } ?>><a href="warehouse_list.php">Warehouse Management</a></li>
                    <li <?php if((in_array("2",$permission)) || (in_array("2",$permission1))) { ?> style="display:block" <?php } else {?> style="display:none" <?php } ?>><a href="rack_list.php">Rack Management</a></li>
                    <li <?php if((in_array("3",$permission)) || (in_array("3",$permission1))) { ?> style="display:block" <?php } else {?> style="display:none" <?php } ?>><a href="sku_list.php">SKU Management</a></li>
                  </ul>
                </li>
                <?php } ?>
                
                <?php 
                if((in_array("14",$permission)) || (in_array("15",$permission)) || (in_array("14",$permission1)) || (in_array("15",$permission1))) { ?>
                
                <li><a><i class="fa fa-shopping-cart"></i></i>Orders<span class="fa fa-chevron-down"></span></a>
                 <ul class="nav child_menu" style="display: none">

                    <li <?php if((in_array("14",$permission)) || (in_array("14",$permission1))) { ?> style="display:block" <?php } else {?> style="display:none" <?php } ?>><a href="create_order.php">Create Order / Order List</a></li>
                    <li <?php if((in_array("15",$permission)) || (in_array("15",$permission1))) { ?> style="display:block" <?php } else {?> style="display:none" <?php } ?>><a href="order_list.php?id=1">Today's Order<span class="badge bg-blue"><?=$count?></span></a></li>
                  </ul>
                </li>
                <?php } ?>
                <!--<li><a><i class="fa fa-edit"></i>Rack Management<span class="fa fa-chevron-down"></span></a>-->
                <!-- <ul class="nav child_menu" style="display: none">-->
                    <!--<li><a href="add_racks.php">Add Racks</a></li>-->
                <!--    <li><a href="rack_list.php">Rack List</a></li>-->
                <!--  </ul>-->
                <!--</li>-->

               <!--<li><a><i class="fa fa-edit"></i>Product Management<span class="fa fa-chevron-down"></span></a>-->
               <!--  <ul class="nav child_menu" style="display: none">-->

                    <!--<li><a href="add_product.php">Add Product</a></li>-->
               <!--     <li><a href="product_list.php">Product List</a></li>-->
               <!--   </ul>-->
               <!-- </li>-->
                
                <!--<li><a><i class="fa fa-edit"></i>SKU Management<span class="fa fa-chevron-down"></span></a>-->
                <!-- <ul class="nav child_menu" style="display: none">-->

                    <!--<li><a href="add_sku.php">Add SKU</a></li>-->
                <!--    <li><a href="sku_list.php">SKU List</a></li>-->
                    
                <!--  </ul>-->
                <!--</li>-->
               <?php 
               if((in_array("4",$permission)) || (in_array("5",$permission)) || (in_array("6",$permission)) || (in_array("7",$permission)) || (in_array("8",$permission)) || (in_array("13",$permission)) || (in_array("16",$permission)) || (in_array("4",$permission1)) || (in_array("5",$permission1)) || (in_array("6",$permission1)) || (in_array("7",$permission1)) || (in_array("8",$permission1)) || (in_array("13",$permission1)) || (in_array("16",$permission1))) { ?>
                <li><a><i class="fa fa-shopping-cart"></i></i>Transaction<span class="fa fa-chevron-down"></span></a>
                 <ul class="nav child_menu" style="display: none">

                    <li <?php if((in_array("4",$permission)) || (in_array("4",$permission1))) { ?> style="display:block" <?php } else {?> style="display:none" <?php } ?>><a href="pre_packing_list.php">Pre-packing</a></li>
                    <li <?php if((in_array("5",$permission)) || (in_array("5",$permission1))) { ?> style="display:block" <?php } else {?> style="display:none" <?php } ?>><a href="inward_transaction_list.php">Goods Inward</a></li>
                    <!--<li <?php if((in_array("6",$permission)) || (in_array("6",$permission1))) { ?> style="display:block" <?php } else {?> style="display:none" <?php } ?>><a href="goods_outward.php">Goods Outward</a></li>-->
                    <li <?php if((in_array("13",$permission)) || (in_array("13",$permission1))) { ?> style="display:block" <?php } else {?> style="display:none" <?php } ?>><a href="warehouse_transaction.php">Inter-warehouse Transfer</a></li>
                    <li <?php if((in_array("16",$permission)) || (in_array("16",$permission1))) { ?> style="display:block" <?php } else {?> style="display:none" <?php } ?>><a href="shortage_transaction.php">Shortage Transaction</a></li>
                    <li <?php if((in_array("7",$permission)) || (in_array("7",$permission1))) { ?> style="display:block" <?php } else {?> style="display:none" <?php } ?>><a href="returned_stock_list.php">Returned Stock</a></li>
                    <li <?php if((in_array("8",$permission)) || (in_array("8",$permission1))) { ?> style="display:block" <?php } else {?> style="display:none" <?php } ?>><a href="damaged_area.php">Damaged Stock</a></li>
                    
                  </ul>
                </li>
                <?php } ?>
                
                <?php 
                if((in_array("9",$permission)) || (in_array("10",$permission)) || (in_array("9",$permission1)) || (in_array("10",$permission1))) { ?>
                
                <li><a><i class="fa fa-shopping-cart"></i></i>User Management<span class="fa fa-chevron-down"></span></a>
                 <ul class="nav child_menu" style="display: none">

                    <li <?php if((in_array("9",$permission)) || (in_array("9",$permission1))) { ?> style="display:block" <?php } else {?> style="display:none" <?php } ?>><a href="usergroup_list.php">Usergroup</a></li>
                    <li <?php if((in_array("10",$permission)) || (in_array("10",$permission1))) { ?> style="display:block" <?php } else {?> style="display:none" <?php } ?>><a href="user_list.php">User list</a></li>
                  </ul>
                </li>
                <?php } ?>
                
                <?php 
                if((in_array("12",$permission)) || (in_array("12",$permission1)) || (in_array("17",$permission)) || (in_array("17",$permission1)) ) { ?>
                
                <li><a><i class="fa fa-shopping-cart"></i></i>Reports<span class="fa fa-chevron-down"></span></a>
                 <ul class="nav child_menu" style="display: none">

                    <li <?php if((in_array("12",$permission)) || (in_array("12",$permission1))) { ?> style="display:block" <?php } else {?> style="display:none" <?php } ?>><a href="reports.php">Reports</a></li>
                    <li <?php if((in_array("17",$permission)) || (in_array("17",$permission1))) { ?> style="display:block" <?php } else {?> style="display:none" <?php } ?>><a href="stock_report.php">Stock Report</a></li>
                  </ul>
                </li>
                <?php } ?>
                
                <?php 
                if((in_array("18",$permission)) || (in_array("18",$permission1)) || (in_array("19",$permission)) || (in_array("19",$permission1)) ) { ?>
                
                <li><a><i class="fa fa-shopping-cart"></i></i>Stock Adjustment<span class="fa fa-chevron-down"></span></a>
                 <ul class="nav child_menu" style="display: none">

                    <li <?php if((in_array("18",$permission)) || (in_array("18",$permission1))) { ?> style="display:block" <?php } else {?> style="display:none" <?php } ?>><a href="stock_adjustment.php">Inward Adjustment</a></li>
                    <li <?php if((in_array("19",$permission)) || (in_array("19",$permission1))) { ?> style="display:block" <?php } else {?> style="display:none" <?php } ?>><a href="outward_adjustment.php">Outward Adjustment</a></li>
                  </ul>
                </li>
                <?php } ?>
                
                <!--<li><a><i class="fa fa-edit"></i>Colour Management<span class="fa fa-chevron-down"></span></a>-->
                <!-- <ul class="nav child_menu" style="display: none">-->

                    <!--<li><a href="add_colour.php">Add colour</a></li>-->
                <!--    <li><a href="colour_list.php">Colour List</a></li>-->
                <!--  </ul>-->
                <!--</li>-->
                
                <!--<li><a><i class="fa fa-edit"></i>Pre-packing Area<span class="fa fa-chevron-down"></span></a>-->
                <!-- <ul class="nav child_menu" style="display: none">-->

                    <!--<li><a href="add_colour.php">Add colour</a></li>-->
                <!--    <li><a href="pre_packing_list.php">Product List</a></li>-->
                <!--  </ul>-->
                <!--</li>-->
                
                <!--<li><a><i class="fa fa-edit"></i>Returned Stock<span class="fa fa-chevron-down"></span></a>-->
                <!-- <ul class="nav child_menu" style="display: none">-->

                    <!--<li><a href="add_colour.php">Add colour</a></li>-->
                <!--    <li><a href="returned_stock_list.php">Product List</a></li>-->
                <!--  </ul>-->
                <!--</li>-->
                
                

<!--                 <li><a><i class="fa fa-shopping-cart"></i>Reports<span class="fa fa-chevron-down"></span></a>



                  <ul class="nav child_menu" style="display: none">



                    <li><a href="stock_in_report.php">Stock In Report</a></li>



                    <li><a href="stock_out_report.php">Stock Out Report</a></li>



                    



                  </ul>



                </li> -->



              </ul>



            </div>



          </div>



          <!-- /sidebar menu -->



          <!-- /menu footer buttons -->



         <!-- <div class="sidebar-footer hidden-small">



            <a data-toggle="tooltip" data-placement="top" title="Settings">



              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>



            </a>



            <a data-toggle="tooltip" data-placement="top" title="FullScreen">



              <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>



            </a>



            <a data-toggle="tooltip" data-placement="top" title="Lock">



              <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>



            </a>



            <a data-toggle="tooltip" data-placement="top" title="Logout">



              <span class="glyphicon glyphicon-off" aria-hidden="true"></span>



            </a>



          </div>-->
          <!-- /menu footer buttons -->
        </div>
      </div>