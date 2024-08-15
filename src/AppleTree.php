<?php

class AppleTree extends AbstractTree
{
    protected function specifyFruitQuantity(): int
    {
        return rand(40, 50);
    }

    public function getFruitWeight(): int
    {
        return rand(150, 180);
    }

}