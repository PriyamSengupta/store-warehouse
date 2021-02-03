<?php include('include/header_top.php'); ?>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      
    
      <div class="right_col" role="main">

        <div class=""> 

          <div class="page-title">

            <div class="title_left">

              <h3>View Combo Product</h3>

            </div>

            <div class="title_right">

              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

               
              </div>
            </div>
          </div>
          <div class="clearfix"></div>

          <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">

              <div class="x_panel">

                <div class="x_title">

                  <h2>View <small>Combo Product</small></h2>

                  <ul class="nav navbar-right panel_toolbox">

                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>

                    </li>

                    <li><a class="close-link" id="close"><i class="fa fa-close"></i></a>

                    </li>

                  </ul>

                  <div class="clearfix"></div>

                </div>
                <!--<a href="product_excel_report.php?id=<?php echo $_REQUEST['id']; ?>" class="btn btn-primary btn-s" >Download</a>-->
                <div class="x_content">
                  <br />
                  <table id="datatable-keytable" class="table table-striped table-bordered">

                    <thead>
                      <tr>
                        <th>Sr No.</th>
                        <th>Barcode No(SKU)</th>
                        <th>Sku</th>
                        <th>Unit Price(Rs)</th>
                        <th>Quantity</th>
                        <th>Total Price(Rs)</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
    					$i=1;
    					$total_price=0;
					//$today=date("Y-m-d");

        $id = $_REQUEST['id'];
        $sql = mysqli_query($db_handle,"SELECT p.barcode_no,s.name AS sku,c.unit_price,c.quantity,c.total_price FROM tbl_combo_product_details c LEFT JOIN tbl_products p ON p.id=c.product_id LEFT JOIN tbl_sku s ON c.product_id=s.product_id WHERE c.combo_product_id = '".$id."'");	 
        
        while($result=mysqli_fetch_assoc($sql))
        {
        
					?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $result['barcode_no']; ?></td>
                        
                        <td><?php echo $result['sku']; ?></td>
                        <td><?php echo $result['unit_price']; ?></td>
                        <td><?php echo $result['quantity'];?></td>
						<td><?php echo $result['total_price'];?></td>

                      </tr>
                      
                      <?php $total_price=$total_price+$result['total_price']; }  ?>                      
                    </tbody>
                    <tfoot>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2"><b>Total Price:&nbsp&nbspRs.<?=number_format($total_price,2)?></b></td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
          
          </div>
        </div>
    </div>
    </body>
            <script>
                $('#close').click(function() {
                        parent.$.fancybox.close();
                    })
            </script>
    </html>