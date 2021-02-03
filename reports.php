<?php include('include/header_top.php'); ?>
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
                 Reports
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

                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="addcomboproduct.php" method="post">
                     
                    <div class="form-group">
                              <!--<label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand_name">Type <span class="required">*</span>-->
                              <!--</label>-->
                              <div class="col-md-12 col-sm-12 col-xs-12">
                              <div class="col-md-4 col-sm-4 col-xs-8">
                                  <select class="form-control" name="type" id="type" required>
                                   <option value="">Select Type</option>
                                   <option value="1">Warehouse List</option>
                                   <option value="2">Goods Inward</option>
                                   <option value="3">Available SKU</option>
                                   <option value="4">Total Stock</option>
                                   <option value="8">Combo Product</option>
                                   <!--<option value="5">Outward transaction(wholesale)</option>-->
                                   <option value="9">Order(Pending)</option>
                                   <option value="10">Order(Processed)</option>
                                   <option value="6">Inter-warehouse transaction</option>
                                   <option value="7">Returned Stock</option>
                                   <option value="11">Shortage Stock</option>
                                   <option value="12">Inward Adjustment</option>
                                   <option value="13">Outward Adjustment</option>
                                </select>
                              </div>
                              <!--<input type="hidden" name="permission[]" id="permission" value="<?=$permission;?>">-->
                              <div class='col-md-4 col-sm-4 col-xs-8 xdisplay_inputx form-group has-feedback' >
                        	    <input type="text" name="min" class="form-control has-feedback-left" id="date_from" placeholder="From date" aria-describedby="inputSuccess2Status" >
                         	    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                         	 </div>
                              
                              <div class='col-md-4 col-sm-4 col-xs-8 xdisplay_inputx form-group has-feedback' >
                                    <input type="text" name="max" class="form-control has-feedback-left" id="date_to" placeholder="To date" aria-describedby="inputSuccess2Status">
         	                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                              </div>
                              </div>
                              <div class="col-md-12 col-sm-12">
                             
                                 <button type='submit' id='remove' class='btn btn-primary' style="float:right"><span class='glyphicon glyphicon-filter' aria-hidden='true'></span>Filter</button>
                            
                            </div>
                             </div>
                             
                              <!--<button type="submit" class="btn btn-success" id="add" name="add" style="float:left;">Submit</button>-->
                    </div>
                   
                   
                    <div class="clearfix"></div>
                    <br>
                      <div id="dyn_div"  class="col-sm-12 col-xs-12" style="padding: 0;">
                       
                      </div>  
                  </form>
                  </div>
                </div>
              </div>
            </div>
        <!-- /page content -->
        <!-- footer content -->
        <?php include('include/footer.php'); ?>
    <script>
      $(function () {
        $('#demo-form2').on('submit', function(e) {
          e.preventDefault();
            var type=document.getElementById('type').value;
            var start_dt=document.getElementById('date_from').value;
            var end_dt=document.getElementById('date_to').value;
            // var permission=document.getElementById('permission').value;
            // alert(start_dt);            
            if(type=='4')
            {
                  $.ajax({
                    type: 'post',
                    url: 'ajax_get_report.php',
                    data: {type : type , start_dt : start_dt , end_dt : end_dt},
                    success: function(response) {
                      $('#dyn_div').html(response);
                      
                                $('.datatable').DataTable({
                                        dom: 'Bfrtip',
                                        rowsGroup: [0,1,2],
                                        buttons: [{
                                        extend: 'excelHtml5',
                                        text: '<i class="fa fa-download" aria-hidden="true"></i> Download Excel'
                                        
                                    }]
                                });
                      
                                  /*$('.datatable thead th').each( function () {
                                        var title = $(this).text();
                                        $(this).html( '<input class="form-control" type="text" placeholder="Search '+title+'" style="width:100%"/>' );
                                    });
                                    
                                        // DataTable
                                    var table = $('.datatable').DataTable();
                                 
                                    // Apply the search
                                    table.columns().every( function () {
                                        var that = this;
                                 
                                        $( 'input', this.header() ).on( 'keyup change', function () {
                                            if ( that.search() !== this.value )     {
                                                that
                                                    .search( this.value )
                                                    .draw();
                                            }
                                        });
                                    });*/
                                    
                                        // Setup - add a text input to each header cell
                                    $('#datatable-brand thead tr:eq(0) th').each( function () {
                                        var title = $('#datatable-brand thead tr:eq(1) th').eq( $(this).index() ).text();
                                        $(this).html( '<input type="text" placeholder="Search '+title+'" style="width:100%"/>' );
                                    } ); 
                                  
                                    var table = $('.datatable').DataTable({
                                        orderCellsTop: true
                                    });
                                  
                                    // Apply the search
                                    table.columns().every(function (index) {
                                        $('#datatable-brand thead tr:eq(0) th:eq(' + index + ') input').on('keyup change', function () {
                                            table.column($(this).parent().index() + ':visible')
                                                .search(this.value)
                                                .draw();
                                        });
                                    });
                    }
                  });
            }
            else{

                  $.ajax({
                    type: 'post',
                    url: 'ajax_get_report.php',
                    data: {type : type , start_dt : start_dt , end_dt : end_dt},
                    success: function(response) {
                      $('#dyn_div').html(response);
                                    $('.datatable').DataTable({
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

        });

      });
    </script>
           
    <script>
        function get_report(type)
        {
            // alert(sku_id);
            $.ajax({
                
                
                type: "POST",
                  url: "ajax_get_report.php",
                  data: {type : type },

                  beforeSend: function() {
                    $('#loadgif').html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');
                  },
                  complete: function() {
                    $('#loadgif').html('<i style="display:none" class="fa fa-refresh"></i>');
                  },
                                      
                  success: function (response) {

                            $('#dyn_div').html(response);
                            $('.abc').DataTable({
                                dom: 'Bfrtip',
                                       buttons: [{
                                                extend: 'csvHtml5',
                                                text: '<i class="fa fa-download" aria-hidden="true"></i> Export CSV'
                                            }]
                                    });
                  }
                    
            });
        }
        
        
    </script>
    
    
    
    <!--<script>-->
    <!--    function delete_row(id)-->
    <!--    {-->
    <!--alert(id);-->
    <!--        $('#d1'+id).remove();-->
    <!--    }-->
    <!--</script>-->
    
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
                // $(document).ready(function(){
                //     $('.date').daterangepicker({
                //                 // dateFormat: 'dd-mm-yyyy',
                //                 singleDatePicker: true,
                //                 calender_style: "picker_2"
                //               }, function(start, end, label) {
                //                 console.log(start.toISOString(), end.toISOString(), label);
                //               });
                // });
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

          </script>
</body>
</html>          