<?php

/**
 * Базовый класс дерева
 */
abstract class AbstractTree
{
    private readonly string $id;
    private array $fruits = [];
    final public function __construct(int $id)
    {
        $this->id = $this->getTreeType() . "_{$id}";
        $this->buildFruits();
    }

    public function getFruitQuantity(): int
    {
        return count($this->fruits);
    }

    final public function getId(): string
    {
        return $this->id;
    }

    final public function getFruits(): array
    {
        return $this->fruits;
    }

    /**
     * Задать количество фруктов на дереве
     *
     * @return int
     */
    protected abstract function specifyFruitQuantity(): int;

    /**
     * Задать вес фрукта
     *
     * @return int
     */
    protected abstract function getFruitWeight(): int;

    /**
     * Получить тип дерева
     *
     * @return string
     */
    final public function getTreeType(): string
    {
        $reflection = new ReflectionClass($this);
        $shortName = strtolower($reflection->getShortName());
        return substr($shortName, 0, strlen($shortName) - strlen('tree'));

    }

    /**
     * Создаем фрукты для дерева и сохраняем
     *
     * @return void
     */
    public function buildFruits(): void
    {
        for ($counter = 0; $counter < $this->specifyFruitQuantity(); $counter++) {
            $this->fruits[] = $this->getFruitWeight();
        }
    }

    /**
     * Получить максимальный вес фрукта
     *
     * @return int
     */
    public function getMaxFruitWeight(): int
    {
        if (count($this->fruits) === 1) {
            return $this->fruits[0];
        }

        if (count($this->fruits) === 0) {
            return 0;
        }

        return max($this->fruits);
    }
}