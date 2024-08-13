<?php

require_once(__DIR__ . "/autoload.php");

try {
    $garden = new GardenGenerator(['apple' => 10, 'pear' => 15]);
} catch (\Exception $exception) {
    echo htmlspecialchars("Заданые неверные значения для создания сада; Подробнее - {$exception->getMessage()}");
    die;
}

$garden->seedTrees();

$collector = new Collector($garden);
$collector->calculate();

$quantity = $collector->getFruitsQuantity();
$weight = $collector->getFruitsWeight();
$biggestFruit = $collector->getMaxFruitWeight();


echo "Количество фруктов каждого вида:" . PHP_EOL;
echo "Яблоки -> " . $quantity['types']['apple'] . PHP_EOL;
echo "Груши -> " . $quantity['types']['pear'] . PHP_EOL;
echo "Общий вес собранных фруктов:" . PHP_EOL;
echo "Яблоки -> " . $weight['types']['apple'] . PHP_EOL;
echo "Груши -> " . $weight['types']['pear'] . PHP_EOL;
echo "Вес самого большого фрукта:" . PHP_EOL;
echo "Вес -> " . $biggestFruit['weight'] . "; Идентификатор дерева: " . $biggestFruit['tree_id'];
