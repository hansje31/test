<?php

// classes van PHP 'includen' zeg maar dat je de code in een ander php file kan gebruiken
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});
$crud  = new crud();


// timespan is het aantal uur dat je meegeeft in de code via een function(timespan AKA 168 uur als je voor een week kiest) - deze value word meegegeven in core.js AKA lijn 55
function t()
{
    if (isset($_GET['timespan'])) {
        return $_GET['timespan'];
    } else {
        return 24;
    }
}

$recent_data = $crud->read_all(t()); // deze value, 168 (voor een week) bijvoorbeeld word meegegeven in een andere function in een andere php file. In dat andere php file word alle data uit de database gehaald...


$out = [[], []]; // multidimensionaal array, deze komt vol te zitten met de waardes soon

// boven hebben we alle data uit de database gehaald, code beneden stopt alle data in een array.
switch ($_GET['view']) {
    case 'hour':
        foreach ($recent_data as $item) {
            array_push($out[0], [substr($item['datum'], 11, 5), $item['luchtvochtigheid']]);
            array_push($out[1], [substr($item['datum'], 11, 5), $item['graden']]);
        }
        break;
    case 'day':
        $bank = [];
        foreach ($recent_data as $key => $item) {
            $d = substr($item['datum'], 5, 5);
            if (substr(end($bank)['datum'], 5, 5) === $d && $key !== count($recent_data) - 1 || $key === 0) {
                array_push($bank, $item);
            } else {
                $avg_hum = (int) array_sum(array_column($bank, 'luchtvochtigheid')) / count($bank);
                $avg_temp = (int) array_sum(array_column($bank, 'graden')) / count($bank);

                array_push($out[0], [substr($bank[0]['datum'], 0, 10), $avg_hum]);
                array_push($out[1], [substr($bank[0]['datum'], 0, 10), $avg_temp]);

                $bank = [$item];
            }
        }
        break;
    case 'week':
        $bank = [];
        foreach ($recent_data as $key => $item) {
            $d = $item['datum'];
            $dd = strtotime($d);
            $week = date('W', $dd);
            $year = date('Y', $dd);
            $item['datum'] = $week;
            $item['y'] = $year;
            if ((int) $week === (int) reset($bank)['datum'] && $year === reset($bank)['y'] && $key !== count($recent_data) - 1 || $key === 0) {
                array_push($bank, $item);
            } else {
                $avg_hum = (int) array_sum(array_column($bank, 'luchtvochtigheid')) / count($bank);
                $avg_temp = (int) array_sum(array_column($bank, 'graden')) / count($bank);

                array_push($out[0], [$bank[0]['datum'], $avg_hum]);
                array_push($out[1], [$bank[0]['datum'], $avg_temp]);

                $bank = [$item];
            }
        }
        break;
}



echo json_encode($out);