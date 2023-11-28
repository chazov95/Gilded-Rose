<?php

namespace GildedRose\Items\Item;

use GildedRose\Item;
use GildedRose\Items\ItemInterface;

class BaseProduct extends Item implements ItemInterface
{
    public function updateQuality(): void
    {
    }
}
