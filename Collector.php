<?php

class Collector
{
    private array $fruitsQuantity;
    private array $fruitsWeight;
    private array $biggestFruit;
    public function __construct(private GardenGenerator $garden)
    {

    }

    public function getFruitsQuantity(): array
    {
        $quantity = [];
        $quantity['all'] = 0;
        $quantity['types'] = [];

        foreach ($this->garden->getTrees() as $tree) {
            $this->updateFruitsQuantity($tree);
            $this->updateFruitsWeight($tree);
            $this->updateMaxFruitWeight($tree);
        }

        return $quantity;
    }

    private function updateFruitsQuantity(AbstractTree $tree): void
    {
        $type = $tree->getTreeType();
        if (empty($this->fruitsQuantity)) {
            $this->fruitsQuantity['all'] = 0;
        }

        if (empty($this->fruitsQuantity['types'][$type])) {
            $this->fruitsQuantity['types'][$type] = 0;
        }

        $quantity = $tree->getFruitQuantity();
        $this->fruitsQuantity['all'] += $quantity;
        $this->fruitsQuantity['types'][$type] += $quantity;
    }

    private function updateFruitsWeight(AbstractTree $tree): void
    {
        $type = $tree->getTreeType();

        if (empty($this->fruitsWeight['full'])) {
            $this->fruitsWeight['full'] = 0;
        }

        if (empty($this->fruitsWeight['types'][$type])) {
            $this->fruitsWeight['types'][$type] = 0;
        }

        $fruitsWeight = (int) array_sum($tree->getFruits());
        $this->fruitsWeight['full'] += $fruitsWeight;
        $this->fruitsWeight['types'][$type] += $fruitsWeight;
    }

    private function updateMaxFruitWeight(AbstractTree $tree): void {
        if (empty($this->biggestFruit)) {
            $this->biggestFruit['tree_id'] = '';
            $this->biggestFruit['weight'] = 0;
        }

        if (($treeBiggestWeight = $tree->getMaxFruitWeight()) > $this->biggestFruit['weight']) {
            $this->biggestFruit['tree_id'] = $tree->getId();
            $this->biggestFruit['weight'] = $treeBiggestWeight;
        }
    }

}
