<?php include('include/header_top.php'); ?>

<body class="nav-md">

  <div class="container body">

    <div class="main_container">

      <?php include('include/leftbar.php'); ?>

      <!-- top navigation -->

      <?php include('include/top_navigation.php'); ?>

      <!-- /top navigation -->

      <!-- page content -->

      <div class="right_col" role="main">

        <!-- top tiles -->

        

        <!-- /top tiles -->


        <div class="row"></div>
        <h1>Welcome to Store Warehouse Management</h1>
        
           <div class="row top_tiles">
	           <?php 
	            $sqlcount1=mysqli_query($db_handle,"SELECT * FROM tbl_warehouse WHERE status='1'");
	            $count1=mysqli_num_rows($sqlcount1);    
	        ?>
	        <a href="warehouse_list.php">
            <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="glyphicon glyphicon-shopping-cart"></i>
                </div>
                <div class="count"><?=$count1?></div>

                <h3>Total Warehouses</h3>
                <!--<p>Lorem ipsum psdea itgum rixt.</p>-->
              </div>
            </div></a>
            
            <?php 
            $sqlcount2=mysqli_query($db_handle,"SELECT * FROM tbl_rack WHERE warehouse_id!=0");
            $count2=mysqli_num_rows($sqlcount2);    
        	?>
        	 <a href="rack_list.php">
            <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="glyphicon glyphicon-shopping-cart"></i>
                </div>
                <div class="count"><?=$count2?></div>

                <h3>Total Racks</h3>
                <!--<p>Lorem ipsum psdea itgum rixt.</p>-->
              </div>
            </div></a>
            
            <?php
                $sqlcount3=mysqli_query($db_handle,"SELECT * FROM tbl_products");
                $count3=mysqli_num_rows($sqlcount3);
            
            ?>
             <a href="inward_transaction_list.php">
            <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-sort-amount-desc"></i>
                </div>
                <div class="count"><?=$count3?></div>

                <h3>Assigned SKU(s)</h3>
                <!--<p>Lorem ipsum psdea itgum rixt.</p>-->
              </div>
            </div></a>
            <!--<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-check-square-o"></i>
                </div>
                <div class="count">179</div>

                <h3>New Sign ups</h3>
                <p>Lorem ipsum psdea itgum rixt.</p>
              </div>
            </div>
          </div>-->
        
        
       </div>
       </div>
       </div>
        <!-- footer content -->

        <?php include('include/footer.php'); ?>

        </body>

</html>