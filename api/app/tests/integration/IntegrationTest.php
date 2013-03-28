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

    public function testDBConnectionWorks()
    {
        $this->prepareForTests();
        $json = $this->getJSON('items');
        $this->assertGreaterThan(10, count($json));
    }

    public function testSearchForItem()
    {
        $this->prepareForTests();
        $json = $this->getJSON('items/1');
        $this->assertEquals(1, count($json));
        $this->assertRecordFound($json, 'name', 'windex', 'should find Windex'); 
        $this->assertRecordNotFound($json, 'name', 'pencil', 'should not find pencil'); 
        // $json = $this->getJSON('items?name=pencil');
        // $this->assertRecordNotFound($json, 'name', 'pencil', 'should not find pencil'); 
        // $json = $this->getJSON('items', array('name'=>'pencil'));

        // TODO: Figure out how to search for an object
        return; 
        $json = $this->getJSON('items', array('name'=>'pencil'));
        $json = $this->getJSON('items?name=pencil');
        $this->assertRecordFound($json, 'name', 'Pencil', 'should find pencil'); 
        $json = $this->getJSON('items?name=pencil');
        $json = $this->getJSON('items/name=pencil');
    }
}
