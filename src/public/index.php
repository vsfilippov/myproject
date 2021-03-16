<?php

use App\Task1\RandomStringGenerator;
use App\Task2\CapitalsWeather;
use App\Task2\MetaWeatherApiClient;

require_once '../vendor/autoload.php';
//
//$task1 = new RandomStringGenerator();
//var_dump($task1->generate(2, "qghrt"));
$task2 = new CapitalsWeather();
$task2->show();