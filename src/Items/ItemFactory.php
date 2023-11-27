<?php

namespace GildedRose\Items;

use GildedRose\Items\Item\AgedBrie;
use GildedRose\Items\Item\BackstagePasses;
use GildedRose\Items\Item\BaseProduct;
use GildedRose\Items\Item\Sulfuras;

/**
 * Отвечает за создание конкретных продуктов
 */
class ItemFactory
{
    const AGED_BRIE = "Aged Brie";
    const SULFURAS = "Sulfuras, Hand of Ragnaros";
    const BACKSTAGE_PASSES = "Backstage passes to a TAFKAL80ETC concert";
    const CONJURED = "Conjured Mana Cake";

    public static function create(string $name, int $sellIn, int $quality): ItemInterface
    {
        return match ($name) {
            self::AGED_BRIE => new AgedBrie($name, $sellIn, $quality),
            self::SULFURAS => new Sulfuras($name, $sellIn, $quality),
            self::BACKSTAGE_PASSES => new BackstagePasses($name, $sellIn, $quality),
            self::CONJURED => new Conjured($name, $sellIn, $quality),
            default => new BaseProduct($name, $sellIn, $quality)
        };
    }
}