<?php

namespace GildedRose\Items\Decorators;

use GildedRose\Items\Item\BaseProduct;
use GildedRose\Items\ItemInterface;

class PeriodicChangeQualityDecorator extends BaseProduct
{
    public function __construct(private ItemInterface $item,
                                private array $periodData)
    {
        parent::__construct($item->name, $item->sellIn, $item->quality);
    }

    public function updateQuality(): ItemInterface
    {
        $item = $this->item->updateQuality();

        $item->sellIn--;

        foreach ($this->periodData as $periodDatum) {
            if ($item->sellIn > $periodDatum['period']['min'] && $item->sellIn < $periodDatum['period']['max']) {
                $item->quality += $periodDatum['qualityModificator'];
            }

            if ($item->sellIn < 0) {
                $item->quality = 0;
            }
        }

        $this->quality = $item->quality;
        $this->sellIn = $item->sellIn;

        return $item;
    }
}