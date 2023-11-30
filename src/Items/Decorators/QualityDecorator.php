<?php

namespace GildedRose\Items\Decorators;

use GildedRose\Items\Item\BaseProduct;
use GildedRose\Items\ItemInterface;

class QualityDecorator extends BaseProduct implements ItemInterface
{

    public function __construct(private ItemInterface $item, private int $qualityChange = -1, private int $sellInChange = 1)
    {
        parent::__construct($item->name, $item->sellIn, $item->quality);

    }

    public function updateQuality(): ItemInterface
    {
        $item = $this->item->updateQuality();

        $item->sellIn = $item->sellIn - $this->sellInChange;

        if ($item->sellIn >= 0) {
            $item->quality = $item->quality + $this->qualityChange;
        }

        if ($item->sellIn < 0) {
            $item->quality = $item->quality + (2 * $this->qualityChange);
        }

        $this->sellIn = $item->sellIn;
        $this->quality = $item->quality;

        return $item;
    }
}