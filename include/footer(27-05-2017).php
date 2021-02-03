<footer>

      <div class="copyright-info">

        <p class="pull-right">Software Developed By <a href="http://fingertip.co.in/" target="_blank">Fingertip Consultants Pvt. Ltd</a>  

        </p>

      </div>

      <div class="clearfix"></div>

    </footer>

    <!-- /footer content -->

  </div>

  <!-- /page content -->

</div>

</div>

<div id="custom_notifications" class="custom-notifications dsp_none">

<ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">

</ul>

<div class="clearfix"></div>

<div id="notif-group" class="tabbed_notifications"></div>

</div>

<script src="./js/bootstrap.min.js"></script>

<!-- gauge js -->

<script type="text/javascript" src="./js/gauge/gauge.min.js"></script>

<script type="text/javascript" src="./js/gauge/gauge_demo.js"></script>

<!-- bootstrap progress js -->

<script src="./js/progressbar/bootstrap-progressbar.min.js"></script>

<script src="./js/nicescroll/jquery.nicescroll.min.js"></script>

<!-- icheck -->

<script src="./js/icheck/icheck.min.js"></script>

<!-- form validation -->

<script type="text/javascript" src="./js/parsley/parsley.min.js"></script>

<!-- daterangepicker -->

<script type="text/javascript" src="./js/moment/moment.min.js"></script>

<script type="text/javascript" src="./js/datepicker/daterangepicker.js"></script>

<!-- chart js -->

<script src="./js/chart./js/chart.min.js"></script>

<script src="./js/custom.js"></script>

<!-- Datatables -->

<!-- <script src="js/datatables/js/jquery.dataTables.js"></script>

<script src="js/datatables/tools/js/dataTables.tableTools.js"></script> -->

    <!-- Datatables-->

    <script src="./js/datatables/jquery.dataTables.min.js"></script>
    
    <!--<script src="./js/datatables/daterangefilter.js"></script>-->

    <script src="./js/datatables/dataTables.bootstrap.js"></script>

    <script src="./js/datatables/dataTables.buttons.min.js"></script>

    <script src="./js/datatables/buttons.bootstrap.min.js"></script>

    <script src="./js/datatables/jszip.min.js"></script>

    <script src="./js/datatables/pdfmake.min.js"></script>

    <script src="./js/datatables/vfs_fonts.js"></script>

    <script src="./js/datatables/buttons.html5.min.js"></script>

    <script src="./js/datatables/buttons.print.min.js"></script>

    <script src="./js/datatables/dataTables.fixedHeader.min.js"></script>

    <script src="./js/datatables/dataTables.keyTable.min.js"></script>

    <script src="./js/datatables/dataTables.responsive.min.js"></script>

    <script src="./js/datatables/responsive.bootstrap.min.js"></script>

    <script src="./js/datatables/dataTables.scroller.min.js"></script>
    
     

    <script src="./js/numbercheck.js"></script>

    <!-- pace -->

    <script>

      var handleDataTableButtons = function() {

          "use strict";

          0 !== $("#datatable-buttons").length && $("#datatable-buttons").DataTable({

            dom: "Bfrtip",

            buttons: [{

              extend: "copy",

              className: "btn-sm"

            }, {

              extend: "csv",

              className: "btn-sm"

            }, {

              extend: "excel",

              className: "btn-sm"

            }, {

              extend: "pdf",

              className: "btn-sm"

            }, {

              extend: "print",

              className: "btn-sm"

            }],

            responsive: !0

          })

        },

        TableManageButtons = function() {

          "use strict";

          return {

            init: function() {

              handleDataTableButtons()

            }

          }

        }();

    </script>

    <script type="text/javascript">

      $(document).ready(function() {

        $('#datatable').dataTable();

        $('#datatable-keytable').DataTable({
          keys: true
		  
        });
         
    
   


        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({

          ajax: "./js/datatables/json/scroller-demo.json",

          deferRender: true,

          scrollY: 380,

          scrollCollapse: true,

          scroller: true

        });

        var table = $('#datatable-fixed-header').DataTable({

          fixedHeader: true

        });
        
        $('#date_from').daterangepicker({
	        singleDatePicker: true,
	        calender_style: "picker_1"
	      }, function(start, end, label) {
	        console.log(start.toISOString(), end.toISOString(), label);
        });
        
         $('#date_to').daterangepicker({
	        singleDatePicker: true,
	        calender_style: "picker_1"
	      }, function(start, end, label) {
	        console.log(start.toISOString(), end.toISOString(), label);
        });
      	
        
        var table = $('#datatable-keytable').DataTable();
		$("#filter_size").each( function (i) {
        var select = $('<select><option value="">Select Size</option></select>')
            .appendTo( $(this).empty() )
            .on( 'change', function () {
                var val = $(this).val();
                table.column(5)
                    .search( val ? '^'+$(this).val()+'$' : val, true, false )
                    .draw();
            });
        	table.column(5).data().unique().sort().each( function ( d, j ) {
            select.append( '<option value="'+d+'">'+d+'</option>' )
        	});
    	});
		
		$("#filter_brand").each( function (i) {
        var select = $('<select><option value="">Select Brand</option></select>')
            .appendTo( $(this).empty() )
            .on( 'change', function () {
                var val = $(this).val();
                table.column(3)
                    .search( val ? '^'+$(this).val()+'$' : val, true, false )
                    .draw();
            });
        	table.column(3).data().unique().sort().each( function ( d, j ) {
            select.append( '<option value="'+d+'">'+d+'</option>' )
        	});
    	});
		
		$("#filter_item").each( function (i) {
        var select = $('<select><option value="">Select Item</option></select>')
            .appendTo( $(this).empty() )
            .on( 'change', function () {
                var val = $(this).val();
                table.column(3)
                    .search( val ? '^'+$(this).val()+'$' : val, true, false )
                    .draw();
            });
        	table.column(3).data().unique().sort().each( function ( d, j ) {
            select.append( '<option value="'+d+'">'+d+'</option>' )
        	});
    	});
		
		$("#filter_branch_from").each( function (i) {
        var select = $('<select><option value="">Select Branch From</option></select>')
            .appendTo( $(this).empty() )
            .on( 'change', function () {
                var val = $(this).val();
                table.column(3)
                    .search( val ? '^'+$(this).val()+'$' : val, true, false )
                    .draw();
            });
        	table.column(3).data().unique().sort().each( function ( d, j ) {
            select.append( '<option value="'+d+'">'+d+'</option>' )
        	});
    	});
    	$("#filter_branch_to").each( function (i) {
        var select = $('<select><option value="">Select Branch To</option></select>')
            .appendTo( $(this).empty() )
            .on( 'change', function () {
                var val = $(this).val();
                table.column(4)
                    .search( val ? '^'+$(this).val()+'$' : val, true, false )
                    .draw();
            });
        	table.column(4).data().unique().sort().each( function ( d, j ) {
            select.append( '<option value="'+d+'">'+d+'</option>' )
        	});
    	});
		
		
    	/*$.fn.dataTable.moment('MM/DD/YYYY');
  		$('select#positions').change( function() { table.fnFilter( $(this).val() ); } );
  		$('#date_from').keyup( function() { table.draw(); } );
  		$('#date_to').keyup( function() { table.draw(); } );*/
  		$('#date_from').change( function() { table.draw(); } );
    	$('#date_to').change( function() { table.draw(); } );
  		
        

      });
      
      TableManageButtons.init();

    </script>
    
    <script>
    /* Custom filtering function which will search data in column four between two values */
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min =parseFloat( $('#min').val(), 100 );
        var max = parseFloat( $('#max').val(), 100 );
        var amount = parseFloat( data[6] ) || 0; // use data for the age column
 
        if ( ( isNaN( min ) && isNaN( max ) ) ||
             ( isNaN( min ) && amount <= max ) ||
             ( min <= amount   && isNaN( max ) ) ||
             ( min <= amount   && amount <= max ) )
        {
            return true;
        }
        return false;
    }
);
 
$(document).ready(function() {
    var table = $('#datatable-keytable').DataTable();
     
    // Event listener to the two range filtering inputs to redraw on input
    $('#min, #max').keyup( function() {
        table.draw();
    } );
} );
    
    </script>
    
    <script>
    /* Custom filtering function which will search data in column four between two values */
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min =parseFloat( $('#min_price').val(), 0);
        var max = parseFloat( $('#max_price').val(), 0);
        var amount = parseFloat( data[6] ) || 0; // use data for the age column
 
        if ( ( isNaN( min ) && isNaN( max ) ) ||
             ( isNaN( min ) && amount <= max ) ||
             ( min <= amount   && isNaN( max ) ) ||
             ( min <= amount   && amount <= max ) )
        {
            return true;
        }
        return false;
    }
);
 
$(document).ready(function() {
    var table = $('#datatable-keytable').DataTable();
     
    // Event listener to the two range filtering inputs to redraw on input
    $('#min_price, #max_price').keyup( function() {
        table.draw();
    } );
} );
    
    </script>
    
    <script>
   
       
		 
		
	
    
    </script>
    
    
    
<!-- flot js -->

<!--[if lte IE 8]><script type="text/javascript" src="./js/excanvas.min.js"></script><![endif]-->

<script type="text/javascript" src="./js/flot/jquery.flot.js"></script>

<script type="text/javascript" src="./js/flot/jquery.flot.pie.js"></script>

<script type="text/javascript" src="./js/flot/jquery.flot.orderBars.js"></script>

<script type="text/javascript" src="./js/flot/jquery.flot.time.min.js"></script>

<script type="text/javascript" src="./js/flot/date.js"></script>

<script type="text/javascript" src="./js/flot/jquery.flot.spline.js"></script>

<script type="text/javascript" src="./js/flot/jquery.flot.stack.js"></script>

<script type="text/javascript" src="./js/flot/curvedLines.js"></script>

<script type="text/javascript" src="./js/flot/jquery.flot.resize.js"></script>

<script>

$(document).ready(function() {

  // [17, 74, 6, 39, 20, 85, 7]

  //[82, 23, 66, 9, 99, 6, 2]

  var data1 = [

    [gd(2012, 1, 1), 17],

    [gd(2012, 1, 2), 74],

    [gd(2012, 1, 3), 6],

    [gd(2012, 1, 4), 39],

    [gd(2012, 1, 5), 20],

    [gd(2012, 1, 6), 85],

    [gd(2012, 1, 7), 7]

  ];

  var data2 = [

    [gd(2012, 1, 1), 82],

    [gd(2012, 1, 2), 23],

    [gd(2012, 1, 3), 66],

    [gd(2012, 1, 4), 9],

    [gd(2012, 1, 5), 119],

    [gd(2012, 1, 6), 6],

    [gd(2012, 1, 7), 9]

  ];

  $("#canvas_dahs").length && $.plot($("#canvas_dahs"), [

    data1, data2

  ], {

    series: {

      lines: {

        show: false,

        fill: true

      },

      splines: {

        show: true,

        tension: 0.4,

        lineWidth: 1,

        fill: 0.4

      },

      points: {

        radius: 0,

        show: true

      },

      shadowSize: 2

    },

    grid: {

      verticalLines: true,

      hoverable: true,

      clickable: true,

      tickColor: "#d5d5d5",

      borderWidth: 1,

      color: '#fff'

    },

    colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],

    xaxis: {

      tickColor: "rgba(51, 51, 51, 0.06)",

      mode: "time",

      tickSize: [1, "day"],

      //tickLength: 10,

      axisLabel: "Date",

      axisLabelUseCanvas: true,

      axisLabelFontSizePixels: 12,

      axisLabelFontFamily: 'Verdana, Arial',

      axisLabelPadding: 10

        //mode: "time", timeformat: "%m/%d/%y", minTickSize: [1, "day"]

    },

    yaxis: {

      ticks: 8,

      tickColor: "rgba(51, 51, 51, 0.06)",

    },

    tooltip: false

  });

  function gd(year, month, day) {

    return new Date(year, month - 1, day).getTime();

  }

});

</script>

<!-- worldmap -->

<script type="text/javascript" src="./js/maps/jquery-jvectormap-2.0.3.min.js"></script>

<script type="text/javascript" src="./js/maps/gdp-data.js"></script>

<script type="text/javascript" src="./js/maps/jquery-jvectormap-world-mill-en.js"></script>

<script type="text/javascript" src="./js/maps/jquery-jvectormap-us-aea-en.js"></script>

<!-- pace -->

<script src="./js/pace/pace.min.js"></script>

<script>

$(function() {

  $('#world-map-gdp').vectorMap({

    map: 'world_mill_en',

    backgroundColor: 'transparent',

    zoomOnScroll: false,

    series: {

      regions: [{

        values: gdpData,

        scale: ['#E6F2F0', '#149B7E'],

        normalizeFunction: 'polynomial'

      }]

    },

    onRegionTipShow: function(e, el, code) {

      el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');

    }

  });

});

</script>

<!-- skycons -->

<script src="./js/skycons/skycons.min.js"></script>

<script>

var icons = new Skycons({

    "color": "#73879C"

  }),

  list = [

    "clear-day", "clear-night", "partly-cloudy-day",

    "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",

    "fog"

  ],

  i;

for (i = list.length; i--;)

  icons.set(list[i], list[i]);

icons.play();

</script>

<!-- dashbord linegraph -->

<script>

Chart.defaults.global.legend = {

  enabled: false

};

var data = {

  labels: [

    "Symbian",

    "Blackberry",

    "Other",

    "Android",

    "IOS"

  ],

  datasets: [{

    data: [15, 20, 30, 10, 30],

    backgroundColor: [

      "#BDC3C7",

      "#9B59B6",

      "#455C73",

      "#26B99A",

      "#3498DB"

    ],

    hoverBackgroundColor: [

      "#CFD4D8",

      "#B370CF",

      "#34495E",

      "#36CAAB",

      "#49A9EA"

    ]

  }]

};

var canvasDoughnut = new Chart(document.getElementById("canvas1"), {

  type: 'doughnut',

  tooltipFillColor: "rgba(51, 51, 51, 0.55)",

  data: data

});

</script>

<!-- /dashbord linegraph -->

<!-- datepicker -->

<script type="text/javascript">

$(document).ready(function() {

  var cb = function(start, end, label) {

    console.log(start.toISOString(), end.toISOString(), label);

    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");

  }

  var optionSet1 = {

    startDate: moment().subtract(29, 'days'),

    endDate: moment(),

    minDate: '01/01/2012',

    maxDate: '12/31/2015',

    dateLimit: {

      days: 60

    },

    showDropdowns: true,

    showWeekNumbers: true,

    timePicker: false,

    timePickerIncrement: 1,

    timePicker12Hour: true,

    ranges: {

      'Today': [moment(), moment()],

      'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],

      'Last 7 Days': [moment().subtract(6, 'days'), moment()],

      'Last 30 Days': [moment().subtract(29, 'days'), moment()],

      'This Month': [moment().startOf('month'), moment().endOf('month')],

      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]

    },

    opens: 'left',

    buttonClasses: ['btn btn-default'],

    applyClass: 'btn-small btn-primary',

    cancelClass: 'btn-small',

    format: 'MM/DD/YYYY',

    separator: ' to ',

    locale: {

      applyLabel: 'Submit',

      cancelLabel: 'Clear',

      fromLabel: 'From',

      toLabel: 'To',

      customRangeLabel: 'Custom',

      daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],

      monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],

      firstDay: 1

    }

  };

  $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

  $('#reportrange').daterangepicker(optionSet1, cb);

  $('#reportrange').on('show.daterangepicker', function() {

    console.log("show event fired");

  });

  $('#reportrange').on('hide.daterangepicker', function() {

    console.log("hide event fired");

  });

  $('#reportrange').on('apply.daterangepicker', function(ev, picker) {

    console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));

  });

  $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {

    console.log("cancel event fired");

  });

  $('#options1').click(function() {

    $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);

  });

  $('#options2').click(function() {

    $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);

  });

  $('#destroy').click(function() {

    $('#reportrange').data('daterangepicker').remove();

  });

});

</script>

<script>

NProgress.done();

</script>

<!-- /datepicker -->

<!-- /footer content -->