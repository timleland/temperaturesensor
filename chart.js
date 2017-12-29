var chartData = [];
var chartLabels = [];

_temperatureReadings.reverse();
for (var i = 0, len = _temperatureReadings.length; i < len; i++) {
    chartLabels.push(moment.utc(_temperatureReadings[i]['CreatedOn']).local().format('MM-DD-YYYY h:mm:ss a'));
    chartData.push(Math.round(_temperatureReadings[i]['Celsius'] * 1.8 + 32));
}

var ctx = document.getElementById('tempChart');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: chartLabels,
        datasets: [{
            label: _temperatureReadings[0]['SensorId'],
            data: chartData,
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});