<?php

namespace GildedRose\Items\Decorators;

use GildedRose\Items\Item\BaseProduct;
use GildedRose\Items\ItemInterface;

class LimitDecorator extends BaseProduct implements ItemInterface
{
    public function __construct(
        private ItemInterface $item,
        private int           $limitQuality = 50
    )
    {
        parent::__construct($item->name, $item->sellIn, $item->quality);
    }

    public function updateQuality(): ItemInterface
    {
        $item = $this->item->updateQuality();

        if ($item->quality > $this->limitQuality) {
            $item->quality = $this->limitQuality;
        }

        if ($item->quality < 0) {
            $item->quality = 0;
        }

        $this->sellIn = $item->sellIn;
        $this->quality = $item->quality;

        return $item;
    }
}