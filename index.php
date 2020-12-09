<?php

// classes van PHP 'includen' zeg maar dat je de code in een ander php file kan gebruiken
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});
$crud  = new crud();

?>

<html lang="en-us">
<head>
    <title></title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="functions.js"></script>
    <script type="text/javascript" src="core.js"></script>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="description" content="Temperature App - Python & PHP">
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
</head>
<body>
    <div id="today_info">

    <div id="show"></div>
    
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
        // laad/executeer system.php ZONDER de webpagina te herladen (dit is voor om de current temperatuur enzo te zien)
        $(document).ready(function() {
            setInterval(function() {
                $('#show').load('system.php')
            }, 1000);
        });
    </script>

    <script src="" async defer></script>

    <div class="chart_box">
        <div id="hum_chart" class="home_chart"></div>
        <div class="history" id="hum_hist">
            <button id="hum_day">Past Day</button>
            <button id="hum_week">Past Week</button>
            <button id="hum_month">Past Month</button>
            <button id="hum_year">Past Year</button>
        </div>
    </div>
    <div class="chart_box">
        <div id="temp_chart" class="home_chart"></div>
        <div class="history" id="temp_hist">
            <button id="temp_day">Past Day</button>
            <button id="temp_week">Past Week</button>
            <button id="temp_month">Past Month</button>
            <button id="temp_year">Past Year</button>
        </div>
    </div>
</body>
</html>