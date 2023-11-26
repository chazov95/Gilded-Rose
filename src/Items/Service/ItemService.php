<?php

namespace GildedRose\Items\Service;

use GildedRose\Items\Item\AgedBrie;
use GildedRose\Items\Item\BaseProduct;
use GildedRose\Items\Item\Sulfuras;
use GildedRose\Items\ItemInterface;

class ItemService
{
    const AGED_BRIE = "Aged Brie";
    const SULFURAS = "Sulfuras, Hand of Ragnaros";

    public function __construct()
    {
    }

    /**
     * @param $itemName string
     * @return ItemInterface
     */
    public function getProduct(string $itemName): ItemInterface
    {
        return match ($itemName) {
            self::AGED_BRIE => new AgedBrie(),
            self::SULFURAS => new Sulfuras(),
            default => new BaseProduct(),
        };
    }
}