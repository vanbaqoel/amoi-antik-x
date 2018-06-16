//-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieOptions     = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke    : true,
      //String - The colour of each segment stroke
      segmentStrokeColor   : '#fff',
      //Number - The width of each segment stroke
      segmentStrokeWidth   : 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps       : 100,
      //String - Animation easing effect
      animationEasing      : 'easeOutBounce',
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate        : true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale         : false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive           : true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio  : true,
      //String - A legend template
      legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.

function kondisi_chart(perangkat) {
  // body...
}

function spek_chart(perangkat) {
  // body...
}

function jondo_chart(perangkat) {
  $.ajax({
    url: "dashboard/get_jondo_chart/" + perangkat,
    dataType: 'json',
    success: function(result){
      var data = result.data
      var pieChartCanvas = $('#pieJondo').get(0).getContext('2d')
      var pieChart       = new Chart(pieChartCanvas)
      var PieData        = [
        {
          value    : data[0][0],
          color    : '#00a65a',
          highlight: '#00a65a',
          label    : 'Sudah'
        },
        {
          value    : data[0][1],
          color    : '#f56954',
          highlight: '#f56954',
          label    : 'Belum'
        }
      ]

      pieChart.Doughnut(PieData, pieOptions);
    }
  });
}

function os_chart(perangkat) {
  // body...
}

$(document).ready(function () {

  var jondo = new Array();
  var jumlah = new Array();

  //Initialize Select2 Elements
  $('.select2').select2();

  $('.box-header > .box-tools').css('top','3px');

  jondo_chart(0);

  $('#cboJondo').on('change', function (){
    jondo_chart($('#cboJondo').val());
  });

  /*$.ajax({
    url: "standar/get_all_chart",
    dataType: 'json',
    success: function(result){
      $.each(result, function(i, field){
        jumlah = field;
        $('#spek-server').html(Math.round((parseInt(field[0][2]) / parseInt(field[0][3])) * 100) + '%');
        $('#spek-pc').html(Math.round((parseInt(field[1][2]) / parseInt(field[1][3])) * 100) + '%');
        $('#spek-laptop').html(Math.round((parseInt(field[2][2]) / parseInt(field[2][3])) * 100) + '%');
      });

      var pieChartCanvas = $('#pieSpek').get(0).getContext('2d')
      var pieSpekChart   = new Chart(pieChartCanvas)
      var PieSpekData    = [
        {
          value    : (parseInt(jumlah[0][1]) + parseInt(jumlah[1][1]) + parseInt(jumlah[2][1])) - (parseInt(jumlah[0][2]) + parseInt(jumlah[1][2]) + parseInt(jumlah[2][2])),
          color    : '#f56954',
          highlight: '#f56954',
          label    : 'Belum Standar'
        },
        {
          value    : parseInt(jumlah[0][2]) + parseInt(jumlah[1][2]) + parseInt(jumlah[2][2]),
          color    : '#00a65a',
          highlight: '#00a65a',
          label    : 'Standar'
        }
      ]


      pieSpekChart.Doughnut(PieSpekData, pieOptions);
    }
  });*/



})
