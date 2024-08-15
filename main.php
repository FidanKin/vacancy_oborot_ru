<?php

require_once(__DIR__ . "/vendor/autoload.php");

try {
    $garden = new GardenGenerator(['apple' => 10, 'pear' => 15]);
} catch (\InvalidArgumentException $exception) {
    echo sprintf("Заданые неверные значения для создания сада; Подробнее - %s", $exception->getMessage());
    die;
}

$output = new Output(new Collector($garden));
$output->render();
