<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use GildedRose\GildedRose;
use GildedRose\Items\ItemFactory;

echo 'OMGHAI!' . PHP_EOL;

$periodData = [
    ["period" => ['min' => 10, 'max' => INF], "qualityModificator" => 1],
    ["period" => ['min' => 5, 'max' => 10], "qualityModificator" => 2],
    ["period" => ['min' => -INF, 'max' => 5], "qualityModificator" => 3]
];

$itemsData = [
    ['name' => '+5 Dexterity Vest', 'sellIn' => 10, 'quality' => 20, 'settings'=>[]],
    ['name' => 'Aged Brie', 'sellIn' => 2, 'quality' => 0, 'settings'=>[]],
    ['name' => 'Elixir of the Mongoose', 'sellIn' => 5, 'quality' => 7, 'settings'=>[]],
    ['name' => 'Sulfuras, Hand of Ragnaros', 'sellIn' => 0, 'quality' => 80, 'settings'=>[]],
    ['name' => 'Sulfuras, Hand of Ragnaros', 'sellIn' => -1, 'quality' => 80, 'settings'=>[]],
    ['name' => 'Backstage passes to a TAFKAL80ETC concert', 'sellIn' => 15, 'quality' => 20, 'settings'=>$periodData],
    ['name' => 'Backstage passes to a TAFKAL80ETC concert', 'sellIn' => 10, 'quality' => 49, 'settings'=>$periodData],
    ['name' => 'Backstage passes to a TAFKAL80ETC concert', 'sellIn' => 5, 'quality' => 49, 'settings'=>$periodData],
    // this conjured item does not work properly yet
    ['name' => 'Conjured Mana Cake', 'sellIn' => 3, 'quality' => 6, 'settings'=>[]],
];
$items = [];
foreach ($itemsData as $data) {
    $items[] = ItemFactory::create($data['name'], $data['sellIn'], $data['quality'], $data['settings']);
}
$app = new GildedRose($items);

$days = 2;
if ((is_countable($argv) ? count($argv) : 0) > 1) {
    $days = (int)$argv[1];
}

for ($i = 0; $i < $days; $i++) {
    echo "-------- day ${i} --------" . PHP_EOL;
    echo 'name, sellIn, quality' . PHP_EOL;
    foreach ($items as $item) {
        echo $item . PHP_EOL;
    }
    echo PHP_EOL;
    $app->updateQuality();
}
