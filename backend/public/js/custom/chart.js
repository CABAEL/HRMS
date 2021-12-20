
// -- Bar Chart 
var applicants_data = document.getElementById("applicants");

var active_employees_data = document.getElementById("active_employees");




var myLineChart = new Chart(active_employees_data, {
  type: 'bar',
  data: {
    labels: ["January"
    , "February"
    , "March"
    , "April"
    , "May"
    , "June"
    ,"July"
    ,"August"
    ,"September"
    ,"October"
    ,"November",
    ,"December"
  ],
    datasets: [
    {
      label: "Active",
      backgroundColor: "#ace",
      borderColor: "rgba(38, 38, 1,1)",
      data: [
        12, 
        1,
        3
      ],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: true
        },
        ticks: {
          maxTicksLimit: 12
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 100,
          maxTicksLimit: 10
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    }
  }
});

$(document).on('click','#ApplicantChart',function () {
  var year = $('#applicant_year').val();

  $.ajax({
    url: base_url("applicant_chart/"+year),
    type: 'get', 
    dataType: 'json',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
    success: function(response) {

      var myLineChart = new Chart(applicants_data, {
        type: 'bar',
        data: {
          labels: ["January"
          , "February"
          , "March"
          , "April"
          , "May"
          , "June"
          ,"July"
          ,"August"
          ,"September"
          ,"October"
          ,"November",
          ,"December"
        ],
          datasets: [{
            label: "Hired",
            backgroundColor: "rgba(2,117,216,1)",
            borderColor: "rgba(2,117,216,1)",
            data: [
              15
              , 100
      
            ],
          },
          {
            label: "Pending",
            backgroundColor: "rgba(87, 10, 19)",
            borderColor: "rgba(38, 38, 1,1)",
            data: response.pending,
          }],
        },
        options: {
          scales: {
            xAxes: [{
              time: {
                unit: 'month'
              },
              gridLines: {
                display: true
              },
              ticks: {
                maxTicksLimit: 12
              }
            }],
            yAxes: [{
              ticks: {
                min: 0,
                max: 100,
                maxTicksLimit: 10
              },
              gridLines: {
                display: true
              }
            }],
          },
          legend: {
            display: true
          }
        }
      });

    },
    error: function(e) {

    }
  });



})