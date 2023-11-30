<?php

namespace GildedRose\Items\Item;

use GildedRose\Item;
use GildedRose\Items\ItemInterface;

class BaseProduct extends Item implements ItemInterface
{
    public function updateQuality(): ItemInterface
    {
        return $this;
    }

   /* public function getSellIn(): int
    {
        return self::$sellIn;
    }

    public function getQuality(): int
    {
        return self::$quality;
    }

    public function setSellIn($sellIn): int
    {
        return self::$sellIn = $sellIn;
    }

    public function setQuality($quality): int
    {
        return self::$sellIn = $quality;
    }*/
}
