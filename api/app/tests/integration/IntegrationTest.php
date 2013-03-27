<?php

// The integration tests rely on sample data being in the database

/**
 * @group integration
 */
class IntegrationTest extends TestCase 
{
    public function testTesterWorks()
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

    public function testDBConnection()
    {
     $json = $this->getJSON('items');
     $this->assertGreaterThan(10, count($json));
    }
}
