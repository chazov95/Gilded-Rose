<?php

namespace GildedRose\Items;

use GildedRose\Items\Item\BackstagePassesDecorator;
use GildedRose\Items\Item\BaseProduct;
use GildedRose\Items\Item\QualityDecorator;

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
            self::AGED_BRIE => new QualityDecorator((new BaseProduct($name, $sellIn, $quality)), qualityChange: 1),
            self::SULFURAS => new QualityDecorator(new BaseProduct($name, $sellIn, $quality), qualityLimit: 80, permanentSellIn: true),
            self::BACKSTAGE_PASSES => new BackstagePassesDecorator(new BaseProduct($name, $sellIn, $quality)),
            self::CONJURED => new QualityDecorator(new BaseProduct($name, $sellIn, $quality), qualityChange: -2),
            default => new QualityDecorator(new BaseProduct($name, $sellIn, $quality), qualityChange: -1)
        };
    }
}