<?php include('include/header_top.php'); ?>

<style>
    .search{
        margin: 22px 0 0 0px;
        background: #fff;
        position: absolute;
        z-index: 999;
        width: 93%;
        border: solid 1px #ddd;
    }
   .search ul li a {
    padding: 8px 10px;
    display: block;
    color: #999;
   }
   .search a{
       text-decoration: none;
       color: #44444a;
   }
   .search ul {
    list-style: none;
    padding: 0;
    background: #fff;
    margin: 0;
    border: solid 1px #ddd;
   }
</style>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <?php include('include/leftbar.php'); ?>
      <!-- top navigation -->
      <?php include('include/top_navigation.php'); ?>
      <link rel="stylesheet" href="css/fancybox.css">
       <script src="js/fancybox.js"></script>
      <!-- /top navigation -->
       <!-- page content -->
        <div class="right_col" role="main">
        <div class="">
          <div class="page-title">
              <div class="col-sm-6">
            <div class="title_left">
              <h3>
                 Stock Report
               </h3>
           </div>
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

                  <!--<h2>Add <small>Combo Product</small></h2>-->

                  <ul class="nav navbar-right panel_toolbox">

                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>

                    </li>

                    <li><a class="close-link"><i class="fa fa-close"></i></a>

                    </li>

                  </ul>

                  <div class="clearfix"></div>

                </div>


                <div class="x_content">

                  <br />

                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="#" method="post">
                      
                    <div class="form-group">
                        
                      <div class="col-md-6 col-sm-6 col-xs-8">
                            <input type="text" name="sku_name" id="s1" class="form-control col-md-7 col-xs-12" placeholder="Select SKU" style="float: left;" autocomplete="off" onkeyup="search_sku()"/>
                                  <input type="hidden" name="sku_id" id="sku1" value="">
                                  <div class="search" id="div1" style="display:none"></div>
                                  <!--<button type="button" onclick="get_list();" class="btn btn-success btn-s" style="margin-top: 9px;float: right;">proceed</button>-->
                        <!--<select class="form-control" name="sku_id" id="sku_id" onchange="get_list()" required>
                               <option value="">Select SKU</option>
                                          <?php 
                                          $sqlselect=mysqli_query($db_handle,"SELECT * FROM tbl_sku WHERE status=1 AND ( product_id!=0 OR combo_product_id!=0 ) ORDER BY id ASC"); while($record=mysqli_fetch_object($sqlselect)) { ?><option value="<?php echo $record->id; ?>" ><?php echo $record->name; ?>  
                                </option>
                                <?php }  ?>
                            </select>-->
                        </div>
                         
                        <div class="col-md-6 col-sm-6 col-xs-8">
                                  <select class="form-control" name="type" id="type" required>
                                   <option value="">Select Type</option>
                                   <option value="1">Opening Stock</option>
                                   <option value="2">Stock In</option>
                                   <option value="4">Stock Out</option>
                                   <option value="3">Closing Stock</option>
                                </select>
                        </div>      
                        
                        <!--<div class='col-md-3 col-sm-3 col-xs-8 xdisplay_inputx form-group has-feedback' >-->
                        <!--	    <input type="text" name="min" class="form-control has-feedback-left" id="date_from" placeholder="From date" aria-describedby="inputSuccess2Status" >-->
                        <!-- 	    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>-->
                        <!--</div>-->
                              
                        <!--<div class='col-md-3 col-sm-3 col-xs-8 xdisplay_inputx form-group has-feedback' >-->
                        <!--            <input type="text" name="max" class="form-control has-feedback-left" id="date_to" placeholder="To date" aria-describedby="inputSuccess2Status">-->
         	              <!--          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>-->
                        <!--</div>-->

                    </div>
                              <div class="col-md-12 col-sm-12">
                             
                                 <button type='submit' id='remove' class='btn btn-primary' style="float:right"><span class='glyphicon glyphicon-filter' aria-hidden='true'></span>Stock report</button>
                            
                            </div>
                             </div>
                             
                              <!--<button type="submit" class="btn btn-success" id="add" name="add" style="float:left;">Submit</button>-->
                    <div id="dyn_div"  class="col-sm-12 col-xs-12" style="padding: 0;">
                       
                    </div>  
                    
                    </div>
                   
                   
                    <div class="clearfix"></div>
                    <br>
                      
                  </form>
                  </div>
                </div>
              </div>
            <!--</div>-->
        <!-- /page content -->
        <!-- footer content -->
        <?php include('include/footer.php'); ?>
        <!--<script src="https://cdn.rawgit.com/ashl1/datatables-rowsgroup/fbd569b8768155c7a9a62568e66a64115887d7d0/dataTables.rowsGroup.js"></script>-->
    <script>
      $(function () {
        $('#demo-form2').on('submit', function(e) {
          e.preventDefault();
            var sku_name=document.getElementById('s1').value;
            var sku=document.getElementById('sku1').value;
            var type=document.getElementById('type').value;
            // var start_dt=document.getElementById('date_from').value;
            // var end_dt=document.getElementById('date_to').value;
            // alert(type);            
            if(sku=='' || sku_name=='')
            {
                alert('Select an SKU');
            }
            else
            {
                if(type=='1')
                {
                  $.ajax({
                    type: 'post',
                    url: 'ajax_get_stock_report.php',
                    data: {sku : sku , type : type},   /*start_dt : start_dt , end_dt : end_dt*/
                    success: function(response) {
                      $('#dyn_div').html(response);
                                    $('.abc').DataTable({
                                        dom: 'Bfrtip',
                                        rowsGroup: [0],
                                        buttons: [{
                                        extend: 'excelHtml5',
                                        text: '<i class="fa fa-download" aria-hidden="true"></i> Download Excel'
                                        
                                    }]
                                    
                                    });
                                    
                    }
                  });  
                }
                else if(type=='3')
                {
                    $.ajax({
                        type: 'post',
                        url: 'ajax_get_stock_report.php',
                        data: {sku : sku , type : type}, /*start_dt : start_dt , end_dt : end_dt*/
                        success: function(response) {
                          $('#dyn_div').html(response);
                                        $('.abc').DataTable({
                                            dom: 'Bfrtip',
                                            rowsGroup: [0],
                                            buttons: [{
                                            extend: 'excelHtml5',
                                            text: '<i class="fa fa-download" aria-hidden="true"></i> Download Excel'
                                            
                                        }]
                                        
                                        });
                                        
                        }
                      });
                }
                else
                {
                  $.ajax({
                    type: 'post',
                    url: 'ajax_get_stock_report.php',
                    data: {sku : sku , type : type}, /*start_dt : start_dt , end_dt : end_dt*/
                    success: function(response) {
                      $('#dyn_div').html(response);
                                    $('.abc').DataTable({
                                        dom: 'Bfrtip',
                                        rowsGroup: [0,1,2],
                                        buttons: [{
                                        extend: 'excelHtml5',
                                        text: '<i class="fa fa-download" aria-hidden="true"></i> Download Excel'
                                        
                                    }]
                                    
                                    });
                                    
                                    
                                    
                    }
                  });
                }
            }  

        });

      });
    </script>
           
    
          <script>
            $('select[name="warehouse_id"]').on('change', function() {
              var warehouseId = $(this).val();
              //alert (warehouseId);
              $.ajax({
                  type: "POST",
                  url: "ajax_get_rack.php",
                  data: {warehouse : warehouseId },

                  beforeSend: function() {
                    $('#loadgif').html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');
                  },
                  complete: function() {
                    $('#loadgif').html('<i style="display:none" class="fa fa-refresh"></i>');
                  },
                                      
                  success: function (response) {
                              //remove disabled from province and change the options
                              $('select[name="rack_id"]').prop("disabled", false);
                              $('select[name="rack_id"]').html(response);                          
                  }
              });
          });
          </script>
          
          <script>
          //$( '#dyn_div' ).on( 'change', '#product_id', function () {
            //$('select[name="product_id[]"]').on('change', function() {
            function get_price(productId,id){
              $.ajax({
                  type: "POST",
                  url: "ajax_get_price.php",
                  data: {product : productId },
                                      
                  success: function (data) {

                            $('#unit_price'+id).val(data);
                            
                  }
              });
            }
          //});
          </script>
          <script>  
            $(document).ready(function(){
              $(document).on("click", ".window", function() {
                var id=$(this).attr("id");
                var sku=$('#sku_id').val();
                var type=$('#type').val();
                // alert(sku);
                // alert(id);
            	$.fancybox({
                     href : 'transaction_window.php?id='+id+'&sku='+sku+'&type='+type
            
                  }, {
                      type: 'iframe'
                  });
              });
            });
        </script>
    
           

          <script>
            
            function get_total(id)
            {
              var quantity=document.getElementById('quantity'+id).value;
              var unit_price=document.getElementById('unit_price'+id).value;
              //var total_price=document.getElementById('total_price').value;
              if(quantity!='')
              {
                var total_price=parseFloat(quantity*unit_price).toFixed(2);
                document.getElementById('total_price'+id).value=total_price;
              }
              else
              {
                document.getElementById('total_price'+id).value=0; 
              }
            }
            
            function search_sku()
            {
                  var type=5;
                    var sku=document.getElementById('s1').value;
                //   alert(id);
                    if(sku!='')
                    {
                        $.ajax({
                           
                            type: 'POST',
                            url: 'ajax_sku_search.php',
                            data: {'sku':sku,'type':type},
                            success: function(data)
                            {
                                $('#div1').show();
                                $('#div1').prop("disabled",false);
                                $('#div1').html(data);  
                            }    
                            
                        });
                    }
                    else
                    {
                        $('#div1').prop("disabled",true);
                    }
            }
          </script>
</body>
</html>          