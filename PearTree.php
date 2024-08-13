<?php

class PearTree extends AbstractTree
{

    public function getFruitQuantity(): int
    {
        return rand(0, 20);
    }

    public function getFruitWeight(): int
    {
        return rand(130, 170);
    }

}