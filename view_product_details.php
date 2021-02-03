<?php include('include/header_top.php'); ?>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      
    
      <div class="right_col" role="main">

        <div class=""> 

          <!--<div class="page-title">-->

          <!--  <div class="title_left">-->

              <!--<h3>View Product Details</h3>-->

          <!--  </div>-->

          <!--  <div class="title_right">-->

          <!--    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">-->

          <!--    </div>-->
          <!--  </div>-->
          <!--</div>-->
          <div class="clearfix"></div>

          <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">

              <div class="x_panel">

                <div class="x_title">

                  <h2>View <small>Product Details</small></h2>

                  <ul class="nav navbar-right panel_toolbox">

                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>

                    </li>

                    <li><a class="close-link" id="close"><i class="fa fa-close"></i></a>

                    </li>

                  </ul>

                  <div class="clearfix"></div>

                </div>
                <div class="x_content">
                  <br />
                  <table id="datatable-keytable" class="table table-striped table-bordered">

                    <thead>
                      <tr>
                        <th>Sr No.</th>
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

        $warehouse_id = $_GET['warehouse'];
        $product_id     =   $_GET['product'];
        // echo $warehouse_id."<br>".$product_id;
        
        // $sql = mysqli_query($db_handle,"SELECT r.barcode_no,r.name,ptw.quantity,ptw.unit_price,ptw.total_price,ptw_status FROM tbl_rack r LEFT JOIN tbl_product_to_warehouse ptw ON r.id=ptw.rack_id WHERE ptw.warehouse_id='".$warehouse_id."' AND ptw.product_id='".$product_id."'");
        $sql = mysqli_query($db_handle,"SELECT * FROM tbl_product_to_warehouse WHERE product_id='".$product_id."' AND warehouse_id='".$warehouse_id."'");
        
        if(mysqli_num_rows($sql)>0)
        {
            
        while($result=mysqli_fetch_assoc($sql))
        {
             $rack_id=$result['rack_id'];
             $sql2 = mysqli_query($db_handle,"SELECT barcode_no,name FROM tbl_rack WHERE id='".$rack_id."'");
             if(mysqli_num_rows($sql2)>0)
             {
                 $rack_res=mysqli_fetch_object($sql2);
                 $rack_name=$rack_res->name;
                 $rack_barcode=$rack_res->barcode_no;
             }
             else
             {
                 $rack_name="No Data Found";
                 $rack_barcode="No Data Found";
             }
					?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $rack_name; ?></td>
                        <td><?php echo $result['unit_price']; ?></td>
                        <td><?php echo $result['quantity'];?></td>
						<td><?php echo $result['total_price'];?></td>
                        <td><?php if($result['status']==0) { echo "<button class='btn btn-danger btn-xs'>Damaged</button>"; } else { echo "<button class='btn btn-success btn-xs'>Working</button>"; }?></td>
                      </tr>
                      
                      <?php $total_price=$total_price+$result['total_price']; 
        }
        }
        else
        { ?>
                <tr><td colspan="7"><center>No Data Found</center></td></tr>   
        <?php }?>                      
                    </tbody>
                    <tfoot>
                      <tr>
                        <td></td>
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