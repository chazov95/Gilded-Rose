<?php

namespace GildedRose\Items;

interface ItemInterface
{
    public function updateQuality(): ItemInterface;
    
    public function __toString(): string;

/*    public function getSellIn(): int;

    public function getQuality(): int;

    public function setSellIn(int $sellIn): int;

    public function setQuality(int $quality): int;*/
}