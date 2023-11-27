<?php

namespace GildedRose\Items\Item;

use GildedRose\Item;
use GildedRose\Items\ItemInterface;

class AgedBrie extends Item implements ItemInterface
{
    public function updateQuality() :void
    {
        $this->quality++;

        if ($this->quality > 50) {
            $this->quality = 50;
        }
    }
}
