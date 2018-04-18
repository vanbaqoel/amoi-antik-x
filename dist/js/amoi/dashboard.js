$(document).ready(function () {

  var jondo = new Array();
  var jumlah = new Array();

  $.ajax({
    url: "join_domain/get_jondo_chart",
    dataType: 'json',
    success: function(result){
      $.each(result, function(i, field){
        jondo = field;
        $('#jondo-server').html(Math.round((parseInt(field[0][4]) / parseInt(field[0][2])) * 100) + '%');
        $('#jondo-pc').html(Math.round((parseInt(field[1][4]) / parseInt(field[1][2])) * 100) + '%');
        $('#jondo-laptop').html(Math.round((parseInt(field[2][4]) / parseInt(field[2][2])) * 100) + '%');
      });


      var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
      var pieChart       = new Chart(pieChartCanvas)
      var PieData        = [
        {
          value    : parseInt(jondo[0][4]) + parseInt(jondo[1][4]) + parseInt(jondo[2][4]),
          color    : '#00a65a',
          highlight: '#00a65a',
          label    : 'Sudah'
        },
        {
          value    : parseInt(jondo[0][5]) + parseInt(jondo[1][5]) + parseInt(jondo[2][5]),
          color    : '#f56954',
          highlight: '#f56954',
          label    : 'Belum'
        }
      ]

      pieChart.Doughnut(PieData, pieOptions);
    }
  });

  $.ajax({
    url: "standar/get_all_chart",
    dataType: 'json',
    success: function(result){
      $.each(result, function(i, field){
        jumlah = field;
        $('#jumlah-server').html(Math.round((parseInt(field[0][1]) / parseInt(field[0][3])) * 100) + '%');
        $('#jumlah-pc').html(Math.round((parseInt(field[1][1]) / parseInt(field[1][3])) * 100) + '%');
        $('#jumlah-laptop').html(Math.round((parseInt(field[2][1]) / parseInt(field[2][3])) * 100) + '%');

        $('#spek-server').html(Math.round((parseInt(field[0][2]) / parseInt(field[0][3])) * 100) + '%');
        $('#spek-pc').html(Math.round((parseInt(field[1][2]) / parseInt(field[1][3])) * 100) + '%');
        $('#spek-laptop').html(Math.round((parseInt(field[2][2]) / parseInt(field[2][3])) * 100) + '%');
      });


      var barChartOptions = {
        //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
        scaleBeginAtZero        : true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines      : true,
        //String - Colour of the grid lines
        scaleGridLineColor      : 'rgba(0,0,0,.05)',
        //Number - Width of the grid lines
        scaleGridLineWidth      : 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines  : true,
        //Boolean - If there is a stroke on each bar
        barShowStroke           : true,
        //Number - Pixel width of the bar stroke
        barStrokeWidth          : 2,
        //Number - Spacing between each of the X value sets
        barValueSpacing         : 5,
        //Number - Spacing between data sets within X values
        barDatasetSpacing       : 1,
        //String - A legend template
        legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
        //Boolean - whether to make the chart responsive
        responsive              : true,
        maintainAspectRatio     : true
      }
      var barChartData = {
          // labels: ["TOTAL"],
          labels: ["Total Perangkat", "Memenuhi Standar", "Standar Jumlah"],
          datasets: [
            {
              label: "Jumlah",
              fillColor: "#3e95cd",
              data: [
                parseInt(jumlah[0][1]) + parseInt(jumlah[1][1]) + parseInt(jumlah[2][1]),
                parseInt(jumlah[0][2]) + parseInt(jumlah[1][2]) + parseInt(jumlah[2][2]),
                parseInt(jumlah[0][3]) + parseInt(jumlah[1][3]) + parseInt(jumlah[2][3])
              ]
            }
          ]
      };

      var ctx = $('#barChart').get(0).getContext('2d');
      var myBar = new Chart(ctx);

      myBar.Bar(barChartData, barChartOptions);


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
  });


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
})
