const dashboardPage = { 
    init: () => {
        dashboardPage.setListener();
        dashboardPage.chart();
    },

    setListener: () => {

    },

    chart:()=>{
        var options = {
            series: [44, 55],
            chart: {
            width: 610,
            type: 'donut',
          },
          colors: ['#3fb0ac', '#173e43'],
          labels: ['Loja - Miller Mall', 'Estoque - Miller Mall'],
          dataLabels: {
            enabled: false
          },
          responsive: [{
            breakpoint: 480,
            options: {
              chart: {
                width: 200
              },
              legend: {
                show: false
              }
            }
          }],
          legend: {
            position: 'bottom',
            offsetY: 0,
            height: 60,
          }
          };
  
          var chart = new ApexCharts(document.querySelector("#chart"), options);
          chart.render();        
        
          function appendData() {
          var arr = chart.w.globals.series.slice()
          arr.push(Math.floor(Math.random() * (100 - 1 + 1)) + 1)
          return arr;
        }
        
        function removeData() {
          var arr = chart.w.globals.series.slice()
          arr.pop()
          return arr;
        }
        
        function randomize() {
          return chart.w.globals.series.map(function() {
              return Math.floor(Math.random() * (100 - 1 + 1)) + 1
          })
        }
        
        function reset() {
          return options.series
        }
    }    
}

$(document).ready(() => {
    dashboardPage.init()
});


