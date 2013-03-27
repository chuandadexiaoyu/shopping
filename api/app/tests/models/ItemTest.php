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

    public function testSearchForItem()
    {
        $this->prepareForTests();
        $this->assertEquals('Windex', Item::search(1)->name, 'should find the first item');
        $this->assertEquals('2', Item::search('name=Pencils')->id, 'should find name "Pencils"');

        // Search for a letter
        $item1 = Item::search('name=c');
        $this->assertGreaterThan(4, count($item1), 'should have more than 4 with "c"');

        $this->assertRecordFound($item1, 'name', 'Pencils', 
            'should have found Pencils when searching for "c"');
        $this->assertRecordFound($item1, 'name', 'chair', 
            'should have found chair when searching for "c"');
        
        // Search in more than one field
        $item2 = Item::search('sku=s&name=c');
        $this->assertLessThan(count($item1), count($item2), 
            'should have fewer results for both sku and name than with just name');

        $this->assertRecordFound($item2, 'name', 'Pencils', 
            'should have found Pencils when searching for "c"');
        $this->assertRecordNotFound($item2, 'name', 'chair', 
            'should have found chair when searching for "c"');
    }

    public function testCanGetVendors()
    {

    }

    public function testCanGetCarts()
    {

    }

    public function testCanValidate()
    {

    }


    /**
     * Make sure that a particular record was found in a search
     * @param  $itemList        List of records (found with 'where' clause)
     * @param  $field           Name of the field to check
     * @param  $expectedValue   Value that should be found in a record in the results
     * @param  $errorMessage    Message to return if there was no match
     * @return                
     */
    private function assertRecordFound($itemList, $field, $expectedValue, $errorMessage) 
    {
        foreach ($itemList as $item){ 
            if (strpos($item->$field, $expectedValue) !== False) {
                return;     // the item was found
            }
        }
        $this->assertTrue(False, $errorMessage);
    }

    /**
     * Make sure that a particular record was NOT found in a search
     * @param  $itemList        List of records (found with 'where' clause)
     * @param  $field           Name of the field to check
     * @param  $expectedValue   Value that should not be found in a record in the results
     * @param  $errorMessage    Message to return if there was a match
     * @return                
     */
    private function assertRecordNotFound($itemList, $field, $expectedValue, $errorMessage) 
    {
        foreach ($itemList as $item) {
            if (strpos($item->$field, $expectedValue) !== False) { 
                $this->assertTrue(False, $errorMessage);
                return;
            }
        }
    }
}

