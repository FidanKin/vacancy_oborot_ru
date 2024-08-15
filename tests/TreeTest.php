<?php

class TreeTest extends \PHPUnit\Framework\TestCase
{
    public function test_max_fruit_weight_is_right()
    {
        $this->checkFruitsTreeWeight([PearTree::class, AppleTree::class]);
    }

    private function checkFruitsTreeWeight(array $treeTypeClasses) {
        $messageFormat = "%s tree fruit max weight is invalid";

        $counter = 0;
        foreach ($treeTypeClasses as $treeTypeClass) {
            if (class_exists($treeTypeClass)) {
                /** @var \AbstractTree $tree */
                $tree = new $treeTypeClass($counter);
                $maxFruitWeight = 0;

                foreach ($tree->getFruits() as $fruitWeight) {
                    if ($fruitWeight > $maxFruitWeight) {
                        $maxFruitWeight = $fruitWeight;
                    }
                }

                $this->assertEquals($maxFruitWeight, $tree->getMaxFruitWeight(),
                    sprintf($messageFormat, $tree->getTreeType()));
            }

            $counter++;
        }
    }
}