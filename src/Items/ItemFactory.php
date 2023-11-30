<?php

namespace GildedRose\Items;

use GildedRose\Items\Decorators\LimitDecorator;
use GildedRose\Items\Decorators\PeriodicChangeQualityDecorator;
use GildedRose\Items\Decorators\QualityDecorator;
use GildedRose\Items\Item\BaseProduct;

/**
 * Отвечает за создание конкретных продуктов
 */
class ItemFactory
{
    const AGED_BRIE = "Aged Brie";
    const SULFURAS = "Sulfuras, Hand of Ragnaros";
    const BACKSTAGE_PASSES = "Backstage passes to a TAFKAL80ETC concert";
    const CONJURED = "Conjured Mana Cake";

    /**
     * @param string $name
     * @param int $sellIn
     * @param int $quality
     * @param array $settings
     * @return ItemInterface
     */
    //TODO в реальном прокете настройки декораторов, и список необходимых декораторов будут приходить из базы
    public static function create(string $name, int $sellIn, int $quality, array $settings = []): ItemInterface
    {

        return match ($name) {
            self::AGED_BRIE =>
            new LimitDecorator(new QualityDecorator(new BaseProduct($name, $sellIn, $quality), qualityChange: 1)),

            self::SULFURAS => new LimitDecorator(new QualityDecorator(
                new BaseProduct($name, $sellIn, $quality), qualityChange: 0, sellInChange: 0),
                limitQuality: 80),

            self::BACKSTAGE_PASSES => new LimitDecorator(new PeriodicChangeQualityDecorator(new BaseProduct($name, $sellIn, $quality), periodData: $settings)),

            self::CONJURED => new LimitDecorator(new QualityDecorator(new BaseProduct($name, $sellIn, $quality), qualityChange: -2)),

            default => new LimitDecorator(new QualityDecorator(new BaseProduct($name, $sellIn, $quality), qualityChange: -1))
        };
    }
}