<?php

/**
 * Класс, который выполняем подсчеты по всем деревьям сада
 */
class Collector
{

    /**
     * @var array{all, array{types}}
     */
    private array $fruitsQuantity;
    /**
     * @var array{all, array{types}}
     */
    private array $fruitsWeight;
    /**
     * @var array{weight, tree_id}
     */
    private array $biggestFruit;
    public function __construct(private GardenGenerator $garden)
    {

    }

    /**
     * Произвести необходимые вычисления с деревьями
     * @return void
     */
    public function calculate(): void
    {
        foreach ($this->garden->getTrees() as $tree) {
            $this->updateFruitsQuantity($tree);
            $this->updateFruitsWeight($tree);
            $this->updateMaxFruitWeight($tree);
        }
    }

    public function getFruitsQuantity(): array
    {
        $this->fruitsQuantity;
        return $this->fruitsQuantity;
    }

    public function getFruitsWeight(): array
    {
        return $this->fruitsWeight;
    }

    public function getMaxFruitWeight(): array
    {
        return $this->biggestFruit;
    }

    /**
     * Обновить общее количество фруктов, получив дерево
     * @param \AbstractTree $tree
     *
     * @return void
     */
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

    /**
     * Обновить общий вес фруктов, получим дерево
     * @param \AbstractTree $tree
     *
     * @return void
     */
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

    /**
     * Обновить максимальный вес фрукта
     * @param \AbstractTree $tree
     *
     * @return void
     */
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
