<?php

/**
 * This class checks the ItemsController, and also the routing.
 * Everything for ItemsController should be routed through /items
 *
 * @group models
 * @group items
 */
class ItemTest extends TestCase 
{
    public function testerWorks()
    {
        $this->assertTrue(True);
        $mock = \Mockery::mock('something');
        $mock->shouldReceive('test')->once()->andReturn('works');
        $this->assertEquals('works', $mock->test());
    }

    /**
     * @group failing 
     */
    public function testFailingTests()
    {
        $this->assertFalse(True);
    }

}
