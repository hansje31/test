google.charts.load('current', {'packages':['corechart']}); // dit is mandatory voor het grafiek, van google

var hum_table = null;
var temp_table = null;

$(window).on('load', function () { // ajax code om php code uit te voeren zonder de pagina te reloaden
    $.ajax({
        method: "GET",
        url: "get_table_data.php?view=hour"
    })
        .done(function (response) { // als de code boven in get_table_data succesvol is uitgevoerd, voer onderstaande code uit

            let weather_data = JSON.parse(response); // 'parse' alle data gekregen van de php file
            let recent_hum = weather_data[0]; // alle waarden/data van humidity
            let recent_temp = weather_data[1]; // alle waarden/data van temperatuur

            recent_hum.unshift(['Time', 'Humidity']) // time en humidity worden omgezet als 'key' aan het begin van array/object
            recent_temp.unshift(['Time', 'Temperature']) // time en temperatuur worden omgezet als 'key' aan het begin van de array/object

            console.log(recent_hum)

            hum_table = google.visualization.arrayToDataTable(recent_hum); // recent_hum word zo gezet zodat de .draw in functions.js kan worden gebruikt
            temp_table = google.visualization.arrayToDataTable(recent_temp); // recent_temp word zo gezet zodat de .draw in functions.js kan worden gebruikt

            drawChart(); // styling grafiek, executeer function in andere file
        })

    $('#hum_day').on('click' , function () { // klikken op #humday zorgt ervoor dat je deze en andere code (in een andere php file) uitvoert.

        clear_hum(); // leegt de grafiek humidity zeg maar, zodat de grafiek geen values meer heeft (grafiek heeft geen values meer om te late showen)

        $.ajax({ // laat php 'hour' GET request code uitvoeren
            method: "GET",
            url: "get_table_data.php?view=hour"
        })
            .done(function (response) { // als code geen errors hebt enzo en het lukt, dan beneden code uitvoeren
                let weather_data = JSON.parse(response); // 'parse' alle data gekregen van de php file
                let recent_hum = weather_data[0]; // alle waarden/data van humidity

                hum_table.addRows(recent_hum); // zet alle waarden/data van humidity in het grafiek
                drawChart(); // executeer code in function
            })
    })


    // hierna gaat het allemaal hetzelfde door


    $('#hum_week').on('click' , function () {
        clear_hum();

        $.ajax({
            method: "GET",
            url: "get_table_data.php?timespan=168&view=day"
        })
            .done(function (response) {
                console.log(response);
                let weather_data = JSON.parse(response);
                let recent_hum = weather_data[0];

                hum_table.addRows(recent_hum);
                drawChart();
            })
    })
    $('#hum_month').on('click' , function () {
        clear_hum();

        $.ajax({
            method: "GET",
            url: "get_table_data.php?timespan=720&view=day"
        })
            .done(function (response) {
                console.log(response);
                let weather_data = JSON.parse(response);
                let recent_hum = weather_data[0];

                hum_table.addRows(recent_hum);
                drawChart();
            })
    })
    $('#hum_year').on('click' , function () {
        clear_hum();

        $.ajax({
            method: "GET",
            url: "get_table_data.php?timespan=8544&view=week"
        })
            .done(function (response) {
                console.log(response);
                let weather_data = JSON.parse(response);
                let recent_hum = weather_data[0];

                hum_table.addRows(recent_hum);
                drawChart();
            })
    })
    $('#temp_day').on('click' , function () {
        clear_temp();

        $.ajax({
            method: "GET",
            url: "get_table_data.php?view=hour"
        })
            .done(function (response) {
                let weather_data = JSON.parse(response);
                let recent_temp = weather_data[1];

                temp_table.addRows(recent_temp);
                drawChart();
            })
    })

    $('#temp_week').on('click' , function () {
        clear_temp();

        $.ajax({
            method: "GET",
            url: "get_table_data.php?timespan=168&view=day"
        })
            .done(function (response) {
                console.log(response);
                let weather_data = JSON.parse(response);
                let recent_temp = weather_data[1];

                temp_table.addRows(recent_temp);
                drawChart();
            })
    })
    $('#temp_month').on('click' , function () {
        clear_temp();

        $.ajax({
            method: "GET",
            url: "get_table_data.php?timespan=720&view=day"
        })
            .done(function (response) {
                console.log(response);
                let weather_data = JSON.parse(response);
                let recent_temp = weather_data[1];

                temp_table.addRows(recent_temp);
                drawChart();
            })
    })
    $('#temp_year').on('click' , function () {
        clear_temp();

        $.ajax({
            method: "GET",
            url: "get_table_data.php?timespan=8544&view=week"
        })
            .done(function (response) {
                console.log(response);
                let weather_data = JSON.parse(response);
                let recent_temp = weather_data[1];

                temp_table.addRows(recent_temp);
                drawChart();
            })
    })
})