<?php include('include/header_top.php'); ?>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      
    
      <div class="right_col" role="main">

        <div class=""> 

          <div class="page-title">

            <div class="title_left">

              <h3>View Warehouse detail</h3>

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

                  <!--<h2>View <small>Combo Product</small></h2>-->

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
                        <!--<th>SL No.</th>-->
                        <th>Warehouse</th>
                        <th>Rack</th>
                        <th>Unit Price(Rs)</th>
                        <th>Quantity</th>
                        <th>Total Price(Rs)</th>
                        <th>Condition</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
    					$i=1;
    					$total_price=0;
					//$today=date("Y-m-d");

        $id = $_REQUEST['id'];
        // $sql = mysqli_query($db_handle,"SELECT GROUP_CONCAT(w.name separator '<br>') warehouse,GROUP_CONCAT(r.name separator '<br>') rack,GROUP_CONCAT(ptw.unit_price separator '<br>') unit,GROUP_CONCAT(ptw.quantity separator '<br>') quant,GROUP_CONCAT(ptw.total_price separator '<br>') total FROM tbl_product_to_warehouse ptw LEFT JOIN tbl_warehouse w ON w.id=ptw.warehouse_id LEFT JOIN tbl_rack r ON ptw.rack_id=r.id WHERE ptw.combo_product_id = '".$id."' AND ptw.quantity!='0'");	 
        $sql = mysqli_query($db_handle,"SELECT w.name AS warehouse,r.name AS rack,ptw.unit_price,ptw.quantity,ptw.total_price,ptw.status FROM tbl_product_to_warehouse ptw LEFT JOIN tbl_warehouse w ON w.id=ptw.warehouse_id LEFT JOIN tbl_rack r ON ptw.rack_id=r.id WHERE ptw.combo_product_id = '".$id."' AND ptw.quantity!='0'");	 
        
        // echo $id;
        while($result=mysqli_fetch_assoc($sql))
        {
        
					?>
                      <tr>
                        <!--<td><?php echo $i++; ?></td>-->
                        <td><?php echo $result['warehouse']; ?></td>
                        <td><?php echo $result['rack']; ?></td>
                        <td><?php echo $result['unit_price']; ?></td>
                        <td><?php echo $result['quantity'];?></td>
						<td><?php echo $result['total_price'];?></td>
                        <td><?php if($result['status']==0) { echo "<button class='btn btn-danger btn-xs'>Damaged</button>"; } else { echo "<button class='btn btn-success btn-xs'>Working</button>"; }?></td>
                      </tr>
                      
                      <?php $total_price=$total_price+$result['total_price']; 
                      }  ?>                      
                    </tbody>
                    <tfoot>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2"><b>Total Price:&nbsp&nbspRs.<?=number_format($total_price,'2','.','')?></b></td>
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