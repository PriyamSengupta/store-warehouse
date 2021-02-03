<?php include('include/header_top.php'); ?>
<style>
.focused{
  border: solid 1px red;
  }
/*.search{
        margin: 24px 0 0 0px;
        background: #fff;
        position: absolute;
        z-index: 999;
        width: 89%;
        border: solid 1px #ddd;
}*/
.search {
    margin: 33px 0 0 0px;
    background: #fff;
    position: absolute;
    z-index: 999;
    width: 94%;
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
      <!-- /top navigation -->
       <!-- page content -->
    
      <div class="right_col" role="main">
          
    <?php
       if (!(in_array("14",$permission1))) { 
            echo "<script>alert('You donot have access to open this page')</script>";
      ?>
    </div>
    </div>
    </div>
    
    <?php include('include/footer.php'); 
    } else { ?>

<div class="">
          <div class="page-title">
              <div class="col-sm-6">
            <div class="title_left">
              <h3>
                  Orders
               </h3>
           </div>
</div>
            <div class="title_right">
              <div class="col-md-2 col-sm-2 col-xs-12 form-group pull-right top_search">
                  
                  <a href="order_list.php" class="btn btn-info btn-s" style="float:right;"><i class="fa fa-list"></i> Order List</a>
                  
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
        
          <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">

              <div class="x_panel">

                <div class="x_title">

                  <h2>Create <small>Order</small></h2>

                  <ul class="nav navbar-right panel_toolbox">

                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>

                    </li>

                    <li><a class="close-link"><i class="fa fa-close"></i></a>

                    </li>

                  </ul>

                  <div class="clearfix"></div>

                </div>

                <div class="x_content" style="margin-top: 0px;">

                  <br />

                   
                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="createorder.php">
                        <div class="form-group">
                            
                            <div class="col-md-6 col-sm-6 col-xs-12">
                             <input type='text' id="ws_name" name='ws_name' required='required' style="width:60%" placeholder='Buyer Name'  class='form-control col-md-2 col-sm-2 col-xs-8'>
                            </div>
                              
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                    
                                  <textarea id="comment" name='comment' required='required' style="width:60%" placeholder='Comment' class='form-control col-md-2 col-sm-2 col-xs-8'></textarea>
                              </div>
                        </div>    
                        <div class="ln_solid"></div>
                    
                        <div id="show_form">
                        <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px 20px;">
                        <h3><small>Create List</small></h3>
                        <button type="button" class="btn btn-link" id="add_row" name="add_row"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>Add row</button>
                        <!--</div>-->
                        <!--<a href="javascript:void(0);" id="link" style="float:left">Add Warehouse Info</a>-->
                        <div  id="dyn_div" style="padding: 0;">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                          </div>
                        </div>  
                    </div>
                    <input type="hidden" id="count" value="">
                    <!--<div class="ln_solid"></div>-->
                    <div class="form-group" style="float:right; padding-left:10px">

                      <div class="col-md-6 col-sm-6 col-xs-6 col-md-offset-3" id="add_pro" style="display:none; margin-right: 20px;">

                      	<button type="submit" class="btn btn-primary" name="add" id="add_in" disabled=""><span class='glyphicon glyphicon-plus-sign' aria-hidden='true'></span>Place Order</button>
                       
                      </div>
                    </div> 
                    </div>
                    </form>
                    </div>
                    
                    <div class="position_loader" id="loadgif"></div>
                  
                </div>
              </div>
            </div>
           <!--</form>-->
          </div>
        <!-- /page content -->
        <!-- footer content -->
        <?php include('include/footer.php'); } ?>
        
        
        
            <script type="text/javascript">
            $(function()
            {
              $('[name="status_check"]').change(function()
              {
                if ($(this).is(':checked')) {
                   document.getElementById('status').value=1;
                  
                }
                else
                {
                    document.getElementById('status').value=0;
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
                                      
                  success: function (data) {
                              //remove disabled from province and change the options
                              $('select[name="rack_id"]').prop("disabled", false);
                              $('select[name="rack_id"]').html(data);                          
                  }
              });
          });
          </script>
        <script>  
            $(document).ready(function(){  
                var id=1;
                $("#add_row").on("click", function(){
                    $("#count").val(id);
                    id=id+1;
                    $("#add_pro").show();
                    //alert(id);
                    $("#dyn_div").append("<div class='col-md-12 col-sm-12 col-xs-12' id='d1"+id+"'><div class='col-md-4 col-sm-4 col-xs-8' ><input type='text' id='sku"+id+"' name='sku[]' placeholder='SKU' autocomplete='off' onkeyup='search_sku("+id+")' required='required' class='form-control col-md-2 col-sm-2 col-xs-8'><div class='search' id='div"+id+"' style='display:none'></div><input type='hidden' id='sku_id"+id+"'></div><div class='col-md-4 col-sm-4 col-xs-8' ><input type='number' min='0' id='quantity"+id+"' placeholder='Quantity' name='quantity[]' required='required' class='form-control col-md-4 col-sm-4 col-xs-8' onkeyup='check_quant("+id+")'></div><div class='col-md-4 col-sm-4 col-xs-8' ><button type='button' id='remove' onclick='delete_row("+id+")' class='btn btn-danger'><span class='glyphicon glyphicon-minus-sign' aria-hidden='true'></span>Remove</button></div></div>");
                    
                });
            });  
        </script>
        
        <script>
            var sku_array=[];
            function search_sku(id)
                {
                    var type=6;
                    var sku=document.getElementById('sku'+id).value;
                //   alert(id);
                    if(sku!='')
                    {
                        $.ajax({
                           
                            type: 'POST',
                            url: 'ajax_sku_search.php',
                            data: {'sku':sku,'type':type,'count':id},
                            success: function(data)
                            {
                                $('#div'+id).show();
                                $('#div'+id).prop("disabled",false);
                                $('#div'+id).html(data);  
                            }    
                            
                        });
                    }
                    else
                    {
                        $('#div'+id).prop("disabled",true);
                    }
                }
            
            function check_quant(count)
            {
                var sku=document.getElementById('sku'+count).value;
                var quant=document.getElementById('quantity'+count).value;
                
                $.ajax({
                              type: "POST",
                              url: "ajax_count_product.php",
                              data: {sku : sku , quantity : quant},
               
                              success: function (data) {
                                          //remove disabled from province and change the options
                                        //   alert(data);
                                          if(data==1)
                                          {
                                              $('#add_in').prop("disabled", false);
                                            //   $('#sku'+count).attr('readonly', true);
                                          }
                                          else
                                          {
                                            if(sku!='')
                                            {
                                                 alert("Not enough quantity in stock");
                                                //  $('#sku'+count).attr('readonly', false);
                                                 $('#quantity'+count).addClass("focused");
                                                 document.getElementById('quantity'+count).value='';
                                            }
                                            else
                                            {
                                                alert("Enter a SKU");
                                                $('#sku'+count).addClass("focused");
                                                document.getElementById('quantity'+count).value='';
                                            }
                                          }
                              }
                          });
            }
 
        </script>
        
        <script>
            function delete_row(id)
            {
                var s1= document.getElementById('sku_id'+id).value;
                for( var i = 0; i <= sku_array.length-1; i++){ 
                   if ( sku_array[i] === s1) {
                     sku_array.splice(i, 1); 
                   }
                }
                console.log(sku_array);
                
                if(id==2)
                {
                    $('#add_pro').hide();
                }
                $('#d1'+id).remove();
            }
        </script> 
         
          <script>
            // var sku_array=[];
            // function check_sku(count)
            // {
            //   var sku=document.getElementById('sku'+count).value;
            //   if(sku_array.indexOf(sku)!=-1)
            //     {
            //         alert("You've already choose this SKU");
            //         $('#add_in').prop("disabled", false);
            //         // sku_array.splice(index, 1);
            //         // console.log(sku_array);
            //         // document.getElementById('sku'+count).value='';
            //     }
            //     else
            //     {
            //         sku_array.push(sku);
            //           $.ajax({
            //                   type: "POST",
            //                   url: "ajax_check_sku.php",
            //                   data: {sku : sku },
            
            //                 //   beforeSend: function() {
            //                 //     $('#loadgif').html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');
            //                 //   },
            //                 //   complete: function() {
            //                 //     $('#loadgif').html('<i style="display:none" class="fa fa-refresh"></i>');
            //                 //   },
                                                  
            //                   success: function (data) {
                                  
            //                               //remove disabled from province and change the options
            //                               if(data==1)
            //                               {
            //                                   $('#add_in').prop("disabled", false);
            //                               }
            //                               else
            //                               {
            //                                  $('#add_in').prop("disabled", true);
            //                                 if(sku!='') 
            //                                  alert("Sku is not listed in any warehouse");
            //                         }
            //                   }
            //               });
            //     }      
            // }
          </script>
          
           <script>
                function get_rack(warehouse_id,count)
                {
                //   var warehouseId = $(this).val();
                //   alert (warehouse_id);
                  $.ajax({
                      type: "POST",
                      url: "ajax_get_rack.php",
                      data: {warehouse : warehouse_id },
    
                      beforeSend: function() {
                        $('#loadgif').html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');
                      },
                      complete: function() {
                        $('#loadgif').html('<i style="display:none" class="fa fa-refresh"></i>');
                      },
                                          
                      success: function (data) {
                                  //remove disabled from province and change the options
                                //   $('select[name="rack_id"]').prop("disabled", false);
                                  $('#rack_id'+count).html(data);                          
                      }
                  });
                }
            </script>
          
          
          <script>  
            $(document).ready(function(){
              $(document).on("click", "#back", function() {
                //var id=$(this).attr("id");
            	window.location.href='inward_transaction_list.php';
              });
            });
        </script>
          <script>
              $(document).ready(function(){
                $('#sku').on('change', function() {
                  if ( this.value == '')
                  {
                    $("#show_form").hide();
                    $(".unit").hide();
                  }
                  else
                  {
                    $("#show_form").show();
                    $(".unit").show();
                  }
                });
            });
          </script>

        </body>
</html>