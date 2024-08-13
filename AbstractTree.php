<?php

abstract class AbstractTree
{
    private readonly int $id;
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

    final public function getId(): int
    {
        return $this->id;
    }

    final public function getFruits(): array
    {
        return $this->fruits;
    }

    protected abstract function specifyFruitQuantity(): int;
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

    public function buildFruits(): void
    {
        for ($counter = 0; $counter < $this->specifyFruitQuantity(); $counter++) {
            $this->fruits[] = $this->getFruitWeight();
        }
    }

    public function getMaxFruitWeight(): int
    {
        return max($this->fruits);
    }
}