<?php

namespace GildedRose\Items\Item;

use GildedRose\Items\ItemInterface;

class QualityDecorator extends BaseProduct
{

    public function __construct(ItemInterface $item,
                                private int   $qualityChange = 0,
                                private int   $qualityLimit = 50,
                                private bool  $permanentSellIn = false)
    {
        parent::__construct($item->name, $item->sellIn, $item->quality);
    }

    public function updateQuality(): void
    {
        if (!$this->permanentSellIn) {
            $this->sellIn--;
        }
        if ($this->sellIn >= 0) {
            $this->quality += $this->qualityChange;
        }

        if ($this->sellIn < 0) {
            $this->quality += (2 * $this->qualityChange);
        }

        if ($this->quality > $this->qualityLimit) {
            $this->quality = $this->qualityLimit;
        }

        if ($this->quality < 0) {
            $this->quality = 0;
        }
    }
}