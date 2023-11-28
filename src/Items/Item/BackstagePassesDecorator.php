<?php

namespace GildedRose\Items\Item;

use GildedRose\Items\ItemInterface;

class BackstagePassesDecorator extends BaseProduct
{
    public function __construct(ItemInterface $item)
    {
        parent::__construct($item->name, $item->sellIn, $item->quality);
    }

    public function updateQuality(): void
    {
        $this->sellIn--;
        $this->quality++;
        if ($this->sellIn < 10 && $this->sellIn > 5) {
            $this->quality += 2;
        }
        if ($this->sellIn < 6 && $this->sellIn > 0) {
            $this->quality += 3;
        }
        if ($this->sellIn === 0) {
            $this->quality = 0;
        }
        if ($this->quality > 50) {
            $this->quality = 50;
        }
    }
}