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

var kondisiChart;
var spekChart;
var jondoChart;
var osChart;

function kondisi_chart(perangkat, mode) {
  var pieChartCanvas = $('#pieKondisi').get(0).getContext('2d');
  var pieChart       = new Chart(pieChartCanvas);

  $.ajax({
    url: "dashboard/get_kondisi_chart/" + perangkat,
    dataType: 'json',
    success: function(result){
      var data = result.data
      var pieData        = [
        {
          value    : data[0][0],
          color    : 'LightSeaGreen',
          highlight: 'LightSeaGreen',
          label    : 'Baik'
        },
        {
          value    : data[0][1],
          color    : 'LightSkyBlue',
          highlight: 'LightSkyBlue',
          label    : 'Kurang Baik'
        },
        {
          value    : data[0][2],
          color    : 'Khaki',
          highlight: 'Khaki',
          label    : 'Rusak Ringan'
        },
        {
          value    : data[0][3],
          color    : 'LightCoral',
          highlight: 'LightCoral',
          label    : 'Rusak Berat'
        }
      ]

      if (mode == 0) {
        kondisiChart = pieChart.Doughnut(pieData, pieOptions);
      } else {
        kondisiChart.destroy();
        kondisiChart = pieChart.Doughnut(pieData, pieOptions);
      }
    }
  });
}

function spek_chart(perangkat, mode) {
  var pieChartCanvas = $('#pieSpek').get(0).getContext('2d');
  var pieChart       = new Chart(pieChartCanvas);

  $.ajax({
    url: "dashboard/get_spek_chart/" + perangkat,
    dataType: 'json',
    success: function(result){
      var data = result.data
      var pieData        = [
        {
          value    : data[0][0],
          color    : 'LightSeaGreen',
          highlight: 'LightSeaGreen',
          label    : 'Sudah Standar'
        },
        {
          value    : data[0][1],
          color    : 'LightCoral',
          highlight: 'LightCoral',
          label    : 'Belum Standar'
        }
      ]

      if (mode == 0) {
        spekChart = pieChart.Doughnut(pieData, pieOptions);
      } else {
        spekChart.destroy();
        spekChart = pieChart.Doughnut(pieData, pieOptions);
      }
    }
  });
}

function jondo_chart(perangkat, mode) {
  var pieChartCanvas = $('#pieJondo').get(0).getContext('2d');
  var pieChart       = new Chart(pieChartCanvas);

  $.ajax({
    url: "dashboard/get_jondo_chart/" + perangkat,
    dataType: 'json',
    success: function(result){
      var data = result.data
      var pieData        = [
        {
          value    : data[0][0],
          color    : 'LightSeaGreen',
          highlight: 'LightSeaGreen',
          label    : 'Sudah Join'
        },
        {
          value    : data[0][1],
          color    : 'LightCoral',
          highlight: 'LightCoral',
          label    : 'Belum Join'
        }
      ]

      if (mode == 0) {
        jondoChart = pieChart.Doughnut(pieData, pieOptions);
      } else {
        jondoChart.destroy();
        jondoChart = pieChart.Doughnut(pieData, pieOptions);
      }
    }
  });
}

function os_chart(perangkat, mode) {
  var pieChartCanvas = $('#pieOS').get(0).getContext('2d');
  var pieChart       = new Chart(pieChartCanvas);

   $.ajax({
    url: "dashboard/get_os_chart/" + perangkat,
    dataType: 'json',
    success: function(result){
      var data = result.data
      var pieData        = [
        {
          value    : data[0][0],
          color    : 'LightSeaGreen',
          highlight: 'LightSeaGreen',
          label    : 'Genuine'
        },
        {
          value    : data[0][1],
          color    : 'LightCoral',
          highlight: 'LightCoral',
          label    : 'Tidak Genuine'
        }
      ]

      if (mode == 0) {
        osChart = pieChart.Doughnut(pieData, pieOptions);
      } else {
        osChart.destroy();
        osChart = pieChart.Doughnut(pieData, pieOptions);
      }
    }
  });
}

$(document).ready(function () {

  var jondo = new Array();
  var jumlah = new Array();

  //Initialize Select2 Elements
  $('.select2').select2();

  $('.box-header > .box-tools').css('top','3px');

  kondisi_chart(0, 0);

  jondo_chart(0, 0);

  spek_chart(0, 0);


  os_chart(0, 0);

  $('#cboKondisi').on('change', function (){
    kondisi_chart($('#cboKondisi').val(), 1);
  });

  $('#cboSpek').on('change', function (){
    spek_chart($('#cboSpek').val(), 1);
  });

  $('#cboJondo').on('change', function (){
    jondo_chart($('#cboJondo').val(), 1);
  });

  $('#cboOS').on('change', function (){
    os_chart($('#cboOS').val(), 1);
  });
})
