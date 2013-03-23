<?php

// The integration tests rely on sample data being in the database

/**
 * @group integration
 */
class IntegrationTest extends TestCase 
{
    public function testerWorks()
    {
        $this->assertTrue(True);
        if($this->runFailingTests){
            $this->assertFalse(True);
        }
        $mock = \Mockery::mock('something');
        $mock->shouldReceive('test')->once()->andReturn('works');
        $this->assertEquals('works', $mock->test());
    }

    public function testDBConnection()
    {
     $json = $this->getJSON('items');
     $this->assertGreaterThan(10, count($json));
    }
}
