<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use GildedRose\GildedRose;
use GildedRose\Item;
use GildedRose\Items\Item\AgedBrie;
use GildedRose\Items\Item\BackstagePasses;
use GildedRose\Items\Item\BaseProduct;
use GildedRose\Items\Item\Sulfuras;
use GildedRose\Items\ItemFactory;

echo 'OMGHAI!' . PHP_EOL;

$itemsData = [
    ['name' => '+5 Dexterity Vest', 'sellIn' => 10, 'quality' => 20],
    ['name' => 'Aged Brie', 'sellIn' => 2, 'quality' => 0],
    ['name' => 'Elixir of the Mongoose', 'sellIn' => 5, 'quality' => 7],
    ['name' => 'Sulfuras, Hand of Ragnaros', 'sellIn' => 0, 'quality' => 80],
    ['name' => 'Sulfuras, Hand of Ragnaros', 'sellIn' => 1, 'quality' => 80],
    ['name' => 'Backstage passes to a TAFKAL80ETC concert', 'sellIn' => 15, 'quality' => 20],
    ['name' => 'Backstage passes to a TAFKAL80ETC concert', 'sellIn' => 10, 'quality' => 49],
    ['name' => 'Backstage passes to a TAFKAL80ETC concert', 'sellIn' => 5, 'quality' => 49],
    // this conjured item does not work properly yet
    ['name' => 'Conjured Mana Cake', 'sellIn' => 3, 'quality' => 6],
];
$items = [];
foreach ($itemsData as $data) {
    $items[] = ItemFactory::create($data['name'], $data['sellIn'], $data['quality']);
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
