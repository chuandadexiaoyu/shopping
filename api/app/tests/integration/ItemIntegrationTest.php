<?php

// The integration tests rely on sample data being in the database

/**
 * @group integration
 * @group items
 * @group db
 */
class ItemIntegrationTest extends IntegrationTestCase 
{
    public function setUp()
    {
        parent::setUp();
        $this->prepareForTests();
    }

    public function testDatabaseConnectionWorks()
    {
        $json = $this->getJsonRoute('items');
        $this->assertGreaterThan(10, count($json));
    }

    public function testFindAllItems()
    {
        $json = $this->getJsonRoute('items');
        $this->assertRecordFound($json, 'name', 'windex', 'should find Windex'); 
        $this->assertRecordFound($json, 'name', 'pencil', 'should find pencil'); 
    }

    public function testFindOneItem()
    {
        $json = $this->getJsonRoute('items/1');
        $this->assertEquals(1, count($json));
        $this->assertRecordFound($json, 'name', 'windex', 'should find Windex for item 1'); 
        $this->assertRecordNotFound($json, 'name', 'pencil', 'should not find pencil for item 1'); 
    }

    public function testSearchForItemByName()
    {
        $json = $this->getJsonRoute('items/name=x');
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
        $json = $this->getJsonRoute('items?name=x');
        $this->assertRecordFound($json, 'name', 'windex', 'should find Windex for items?name=w'); 
        $this->assertRecordNotFound($json, 'name', 'pencil', 'should not find pencil for items?name=w'); 
    }

    // TODO: Fix
    // public function testFailOnSearchForItemByTextOnly()
    // {
    //     $response = $this->get('items/somethingThatDoesNotExist');
    //     $this->assertError(404, 'Item somethingThatDoesNotExist was not found');
    // }


    // public function testFailOnSearchForItemByTextOnly()
    // {
    //     try {
    //         $response = $this->get('items/somethingThatDoesNotExist');
    //     } catch( Symfony\Component\HttpKernel\Exception\HttpException $e ) {
    //         $this->assertError(404, 'Item somethingThatDoesNotExist was not found');
    //     }
    // }




    // TODO: Fail on searches for items with bad field names
    // public function testFailOnSearchForItemWithBadFieldName()
    // {
    //     $response = $this->get('items/invalidFieldName=someText');
    //     $this->assertError(404, 'Field invalidFieldName does not exist in table items');
    // }
    
}
