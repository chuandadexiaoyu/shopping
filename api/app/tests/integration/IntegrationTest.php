<?php

// The integration tests rely on sample data being in the database

/**
 * @group integration
 * @group db
 */
class IntegrationTest extends TestCase 
{
    public function setUp()
    {
        parent::setUp();
        $this->prepareForTests();
    }

    public function testDBConnectionWorks()
    {
        $json = $this->getJSON('items');
        $this->assertGreaterThan(10, count($json));
    }

    public function testFindAllItems()
    {
        $json = $this->getJSON('items');
        $this->assertRecordFound($json, 'name', 'windex', 'should find Windex'); 
        $this->assertRecordFound($json, 'name', 'pencil', 'should find pencil'); 
    }

    public function testFindOneItem()
    {
        $json = $this->getJSON('items/1');
        $this->assertEquals(1, count($json));
        $this->assertRecordFound($json, 'name', 'windex', 'should find Windex for item 1'); 
        $this->assertRecordNotFound($json, 'name', 'pencil', 'should not find pencil for item 1'); 
    }

    public function testSearchForItemByName()
    {
        $json = $this->getJSON('items/name=x');
        $this->assertRecordFound($json, 'name', 'windex', 'should find Windex for items/name=w'); 
        $this->assertRecordNotFound($json, 'name', 'pencil', 'should not find pencil for items/name=w'); 
    }

    // TODO: Find items with paging
    // public function testFindItemsWithPaging()
    // {
    //     $json = $this->get('items/offset=5&count=5');
    //     $this->assertRecordFound($json, 'name', 'windex', 'should find Windex for items?name=w'); 
    //     $this->assertRecordNotFound($json, 'name', 'pencil', 'should not find pencil for items?name=w'); 
    // }

    public function testSearchForItemByNameInQuery()
    {
        $json = $this->getJSON('items?name=x');
        $this->assertRecordFound($json, 'name', 'windex', 'should find Windex for items?name=w'); 
        $this->assertRecordNotFound($json, 'name', 'pencil', 'should not find pencil for items?name=w'); 
    }

    public function testFailOnSearchForItemByTextOnly()
    {
        $response = $this->get('items/somethingThatDoesNotExist');
        $this->assertError(404, 'Item somethingThatDoesNotExist was not found');
    }

    // TODO: Fail on searches for items with bad field names
    // public function testFailOnSearchForItemWithBadFieldName()
    // {
    //     $response = $this->get('items/invalidFieldName=someText');
    //     $this->assertError(404, 'Field invalidFieldName does not exist in table items');
    // }
    
}
