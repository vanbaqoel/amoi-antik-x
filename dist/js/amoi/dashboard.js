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
  $.ajax({
    url: "dashboard/get_kondisi_chart/" + perangkat,
    dataType: 'json',
    success: function(result){
      var data = result.data
      var pieChartCanvas = $('#pieKondisi').get(0).getContext('2d')
      var pieChart       = new Chart(pieChartCanvas)
      var PieData        = [
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

      pieChart.Doughnut(PieData, pieOptions);
    }
  });
}

function spek_chart(perangkat) {
  $.ajax({
    url: "dashboard/get_spek_chart/" + perangkat,
    dataType: 'json',
    success: function(result){
      var data = result.data
      var pieChartCanvas = $('#pieSpek').get(0).getContext('2d')
      var pieChart       = new Chart(pieChartCanvas)
      var PieData        = [
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

      pieChart.Doughnut(PieData, pieOptions);
    }
  });
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

      pieChart.Doughnut(PieData, pieOptions);
    }
  });
}

function os_chart(perangkat) {
   $.ajax({
    url: "dashboard/get_os_chart/" + perangkat,
    dataType: 'json',
    success: function(result){
      var data = result.data
      var pieChartCanvas = $('#pieOS').get(0).getContext('2d')
      var pieChart       = new Chart(pieChartCanvas)
      var PieData        = [
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

      pieChart.Doughnut(PieData, pieOptions);
    }
  });
}

$(document).ready(function () {

  var jondo = new Array();
  var jumlah = new Array();

  //Initialize Select2 Elements
  $('.select2').select2();

  $('.box-header > .box-tools').css('top','3px');

  jondo_chart(0);
  kondisi_chart(0);
  spek_chart(0);
  os_chart(0);

  $('#cboKondisi').on('change', function (){
    kondisi_chart($('#cboKondisi').val());
  });

  $('#cboSpek').on('change', function (){
    spek_chart($('#cboSpek').val());
  });

  $('#cboJondo').on('change', function (){
    jondo_chart($('#cboJondo').val());
  });

  $('#cboOS').on('change', function (){
    os_chart($('#cboOS').val());
  });
})
