<?php

class GardenGenerator
{

    /**
     * @var array[$type => $quantity]
     */
    private array $treesDefinition;

    /**
     * @var \AbstractTree[]
     */
    private array $trees = [];

    /**
     * @param array $treesDefinition - правило для каждого типа дерева, массив вида - [$treetype => $quantity]
     *
     * @throws \Exception
     */
    public function __construct(array $treesDefinition)
    {
        if (! $this->validateTrees(array_keys($treesDefinition))) {
            throw new \Exception("Invalid tree types. Allowed types: " . implode(",", $this->allowedTrees()));
        }

        $this->treesDefinition = $treesDefinition;
    }

    /**
     * Проверяем, что заданы допустимые типы деревьев
     *
     * @param array $types
     *
     * @return bool
     */
    private function validateTrees(array $types): bool
    {
        $intersect = array_intersect($this->allowedTrees(), $types);
        $typeCount = count($types);
        $allowedCount = count($this->allowedTrees());

        if ($typeCount > $allowedCount || count($intersect) !== count($types)) {
            return false;
        }

        return true;
    }

    private function allowedTrees(): array
    {
        return ['apple', 'pear'];
    }

    /**
     * Создаем деревья
     *
     * @return void
     */
    public function seedTrees(): void
    {
        $aliases = $this->aliases();
        foreach ($this->treesDefinition as $type => $quantity) {
            for($counter = 0; $counter < $quantity; $counter++) {
                $treeClass = $aliases[$type];
                $this->trees[] = new $treeClass($counter);
            }
        }
    }

    public function getTrees(): array
    {
        return $this->trees;
    }

    private function aliases(): array
    {
        return [
          'apple' => AppleTree::class,
          'pear' => PearTree::class,
        ];
    }
}