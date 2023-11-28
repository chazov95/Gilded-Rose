<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Items\ItemInterface;

final class GildedRose
{
    /**
     * @param ItemInterface[] $items
     */
    public function __construct(
        private array $items
    )
    {
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            $item->updateQuality();
        }
    }
}
