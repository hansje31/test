<?php

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});
$crud  = new crud();

$degrees = $crud->current_read("SELECT `graden` FROM `temperatuur` ORDER BY `temperatuur`.`datum` DESC LIMIT 1");
$humidity = $crud->current_read("SELECT `luchtvochtigheid` FROM `temperatuur` ORDER BY `temperatuur`.`datum` DESC LIMIT 1");

$high_hum = $crud->custom_query("SELECT MAX(luchtvochtigheid) FROM `temperatuur`");
$high_temp = $crud->custom_query("SELECT MAX(graden) FROM `temperatuur`");

$low_hum = $crud->custom_query("SELECT MIN(luchtvochtigheid) FROM `temperatuur`");
$low_temp = $crud->custom_query("SELECT MIN(graden) FROM `temperatuur`");

?>
<div class="temperature">
	<!-- hier PHP code om alle eenheden laten zien, deze hele code word weer uitgevoerd om de 1 sec waardoor je realtime alles kan zien !-->
    <h2>Current Temperature: </h2>
    <span><?= $degrees ?>&nbsp;&#176;C</span>
    <h2>Current Humidity: </h2>
    <span><?= $humidity ?>&nbsp;%</span>

    <h2>Hoogste temperatuur: </h2>
    <span><?= $high_temp ?>&nbsp;&#176;C</span>
    <h2>Hoogste humidity: </h2>
    <span><?= $high_hum ?>&nbsp;&#176;C</span>

    <h2>laagste temperatuur: </h2>
    <span><?= $low_temp ?>&nbsp;&#176;C</span>
    <h2>laagste humidity: </h2>
    <span><?= $low_hum ?>&nbsp;&#176;C</span>    
</div>
<span class="note">Data is fetched realtime.</span>