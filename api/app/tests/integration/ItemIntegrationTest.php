<?php

// The integration tests rely on sample data being in the database

use Symfony\Component\HttpKernel\Exception\HttpException;

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
    // (fails with ErrorException: Notice: Undefined property: 
    //      Symfony\Component\HttpFoundation\ResponseHeaderBag::$name 
    //      in C:\wamp\www\shopping\api\app\tests\TestCase.php line 293)
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

    public function testFailOnSearchForMissingItem()
    {
        $this->runTestForException('GET', 'items/99', 404, 'Item 99 was not found');
    }

    public function testFailOnSearchForItemByKeyOnly()
    {
        $this->runTestForException('GET', 'items/name', 400, 'invalid value');
    }

    public function testFailOnSearchForItemWithoutOneValue()
    {
        $this->runTestForException('GET', 'items/name=&sku=c', 400, 'invalid value');
    }

    public function testFailOnSearchForItemByUnknownTextOnly()
    {
        $this->runTestForException('GET', 'items/somethingThatDoesNotExist', 400, 'Unknown field');
    }

    public function testFailOnSearchForItemWithBadFieldName()
    {
        $this->runTestForException('GET', 'items/foo=bar', 400, 'Unknown field');
    }

    public function testFailOnSearchForItemWithOneBadFieldName()
    {
        $this->runTestForException('GET', 'items/name=c&foo=bar', 400, 'Unknown field');
    }

// Tests for storing data -------------------------------------------------

    public function testFailToStoreItemDueToBadJson()
    {
        $json = '{"name":"dragon","details":"I like dragons.",';
        $this->postUriWithException('items', $json, 400, 'Invalid json string'); 
    }

    // public function testFailToStoreItemDueToInvalidDetails()
    // {
    //     $json = '{"name":"Joel","details":"d"}';
    //     $this->postUriWithException('items', $json, 400, 'Invalid detail'); 
    // }

// Tests for deleting data ------------------------------------------------

    // public function testDestroyItem()
    // {
    //     $this->delete('items/10');
    // }
    

// Helper Functions ---------------------------------------------------------------

    private function runTestForException($method, $uri, $expectedStatusCode, $expectedError)
    {
        try {
            $result = $this->call($method, $uri);
        } catch( HttpException $e ) {
            $this->assertEquals($expectedStatusCode, $e->getStatusCode());
            $this->assertContains($expectedError, $e->getMessage());
            return;
        }
        $this->assertTrue(False, 'should throw an exception');

    }

}
