<?php

/**
 * This class tests the item model
 * 
 * @group models
 * @group items
 */
class ItemTest extends TestCase 
{
    // protected $item;

    public function tearDown()
    {
        \Mockery::close();
    }

    public function testTesterWorks()
    {
        $this->assertTrue(True);
        $mock = \Mockery::mock('something');
        $mock->shouldReceive('test')->once()->andReturn('works');
        $this->assertEquals('works', $mock->test());
    }

    public function testFindItemByNumber()
    {
        $this->prepareForTests();
        $this->assertEquals('Windex', Item::search(1)->name);
    }

    public function testFindItemByName()
    {
        // TODO: Make the syntax of this much prettier
        $this->prepareForTests();
        $found = Item::search('name=Pencils');
        $items = $found->get()->toArray();
        $this->assertEquals('2', $items[0]['id']);
    }

}

