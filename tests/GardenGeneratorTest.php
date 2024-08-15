<?php
class GardenGeneratorTest extends \PHPUnit\Framework\TestCase
{


    public function test_not_generate_garden_when_add_not_supported_trees()
    {
        $this->expectException(InvalidArgumentException::class);
        new \GardenGenerator(['pear' => 1, 'banana' => 2]);
    }


    public function test_check_created_expected_quantity_all_trees()
    {
        $garden = new GardenGenerator(['pear' => 20, 'apple' => 15]);
        $garden->seedTrees();

        $this->assertCount(35, $garden->getTrees());
    }

    public function test_check_created_expected_quantity_trees_with_types()
    {
        $garden = new GardenGenerator(['pear' => 16, 'apple' => 30]);
        $garden->seedTrees();

        $trees['pear'] = [];
        $trees['apple'] = [];

        foreach ($garden->getTrees() as $tree) {
            $trees[$tree->getTreeType()][]= $tree;
        }

        $this->assertCount(16, $trees['pear'], 'Invalid pear tree quantity');
        $this->assertCount(30, $trees['apple'], 'Invalid apple tree quantity');
    }


}