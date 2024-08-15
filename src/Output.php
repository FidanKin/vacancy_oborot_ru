<?php

class Output implements Render
{
    public function __construct(
      private readonly Collector $collector,
      private readonly bool $calculateWeight = true,
      private readonly bool $calculateQuantity = true,
      private readonly bool $calculateMaxFruitWeight = true
    )
    {
        $this->collector->calculate();
    }

    public function render(): void
    {
        $output = '';

        if ($this->calculateWeight) {
            $output .= $this->getWeights();
        }

        if ($this->calculateQuantity) {
            $output .= $this->getQuantity();
        }

        if ($this->calculateMaxFruitWeight) {
            $output .= $this->getMaxWeights();
        }

        echo $output;
    }

    private function getWeights(): string
    {
        $start = $this->lineMessage("Общий вес собранных фруктов:");
        $result = '';
        $data = $this->collector->getFruitsWeight();

        if ($this->checkTreeTypeExist('apple', $data)) {
            $result .= $this->lineMessage("Яблоки -> " . $data['types']['apple']);
        }

        if ($this->checkTreeTypeExist('pear', $data)) {
            $result .= $this->lineMessage("Груши -> " . $data['types']['pear']);
        }

        if (empty($result)) {
            return "Не удалось найти вес фруктов";
        }

        return $start . $result;
    }

    private function getQuantity(): string
    {
        $start = $this->lineMessage("Количество фруктов каждого вида:");
        $result = '';
        $data = $this->collector->getFruitsQuantity();

        if ($this->checkTreeTypeExist('apple', $data)) {
            $result .= $this->lineMessage("Яблоки -> " . $data['types']['apple']);
        }

        if ($this->checkTreeTypeExist('pear', $data)) {
            $result .= $this->lineMessage("Груши -> " . $data['types']['pear']);
        }

        if (empty($result)) {
            return "Не удалось высчитать количество в фруктов";
        }

        return $start . $result;
    }

    private function getMaxWeights(): string
    {
        $start = $this->lineMessage("Вес самого большого фрукта:");
        $data = $this->collector->getMaxFruitWeight();

        if (empty($data['tree_id'])) {
            return 'Не удалось найти вес самого крупного фрукта';
        }

        $result = "Вес -> " . $data['weight'] . "; Идентификатор дерева: " . $data['tree_id'];

        return $start . $result;
    }

    private function checkTreeTypeExist(string $type, array $data): bool
    {
        return isset($data['types'][$type]);
    }

    private function lineMessage(string $text): string {
        return $text . PHP_EOL;
    }
}