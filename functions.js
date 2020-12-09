function drawChart() {

    // hoe de grafiek eruitziet zeg maar, standaard gegenereerde styling met opties
    let hum_options = {
        hAxis: {
            title: 'Time',
            textStyle: {
                fontSize: 10
            }
        },
        vAxis: {
            title: 'Humidity %'
        },
        title: 'Humidity',
        curveType: 'function',
        legend: {position: 'none'}
    };
    let temp_options = {
        hAxis: {
            title: 'Time',
            textStyle: {
                fontSize: 10
            }
        },
        vAxis: {
            title: '°C'
        },
        title: 'Temperature',
        curveType: 'function',
        legend: {position: 'none'}
    };

    let hum_chart = new google.visualization.LineChart($('#hum_chart')[0]); 
    let temp_chart = new google.visualization.LineChart($('#temp_chart')[0]);

    hum_chart.draw(hum_table, hum_options); // zet data om in een lijn en 'teken' deze in het grafiek
    temp_chart.draw(temp_table, temp_options); // hetzelfde als bovenste
}

function clear_hum() { // leegt de grafiek humidity zeg maar, zodat de grafiek geen values meer heeft (grafiek heeft geen values meer om te laten showen/zien)
    hum_table.removeRows(0, hum_table.getNumberOfRows())
}

function clear_temp() { // leegt de grafiek humidity zeg maar, zodat de grafiek geen values meer heeft (grafiek heeft geen values meer om te laten showen/zien)
    temp_table.removeRows(0, temp_table.getNumberOfRows())
}
