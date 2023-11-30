<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use GildedRose\Items\ItemFactory;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testGildedRose(): void
    {
        var_dump(__DIR__);
        $itemsData = [
            ['name' => '+5 Dexterity Vest', 'sellIn' => 10, 'quality' => 20],
            ['name' => 'Aged Brie', 'sellIn' => 2, 'quality' => 0],
            ['name' => 'Elixir of the Mongoose', 'sellIn' => 5, 'quality' => 7],
            ['name' => 'Sulfuras, Hand of Ragnaros', 'sellIn' => 0, 'quality' => 80],
            ['name' => 'Sulfuras, Hand of Ragnaros', 'sellIn' => -1, 'quality' => 80],
            ['name' => 'Backstage passes to a TAFKAL80ETC concert', 'sellIn' => 15, 'quality' => 20],
            ['name' => 'Backstage passes to a TAFKAL80ETC concert', 'sellIn' => 10, 'quality' => 49],
            ['name' => 'Backstage passes to a TAFKAL80ETC concert', 'sellIn' => 5, 'quality' => 49],
            ['name' => 'Conjured Mana Cake', 'sellIn' => 3, 'quality' => 6],
        ];
        $items = [];
        foreach ($itemsData as $data) {
            $items[] = ItemFactory::create($data['name'], $data['sellIn'], $data['quality']);
        }
        $app = new GildedRose($items);

        $actual = '';

        for ($i = 0; $i < 1; $i++) {
            $actual .= "-------- day ${i} --------" . PHP_EOL;
            $actual .= 'name, sellIn, quality' . PHP_EOL;
            foreach ($items as $item) {
                $actual .= (string)$item . PHP_EOL;
            }
            $actual .= PHP_EOL;
            $app->updateQuality();
        }
$expected = <<<TEXT
-------- day 0 --------
name, sellIn, quality
+5 Dexterity Vest, 10, 20
Aged Brie, 2, 0
Elixir of the Mongoose, 5, 7
Sulfuras, Hand of Ragnaros, 0, 80
Sulfuras, Hand of Ragnaros, -1, 80
Backstage passes to a TAFKAL80ETC concert, 15, 20
Backstage passes to a TAFKAL80ETC concert, 10, 49
Backstage passes to a TAFKAL80ETC concert, 5, 49
Conjured Mana Cake, 3, 6


TEXT;
        $this->assertEquals($expected, $actual);
    }
}
