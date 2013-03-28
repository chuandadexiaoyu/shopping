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
        $item = new Item;
        $this->assertEquals('Windex', $item->search(1)->name, 'should find the first item');
        $this->assertEquals('Windex', $item->search('1')->name, 'should find the first item');
        $this->assertEquals('2', $item->search('name=Pencils')->id, 'should find name "Pencils"');

        // Search for a letter
        $item1 = $item->search('name=c');
        $this->assertGreaterThan(4, count($item1), 'should have more than 4 with "c"');

        $this->assertRecordFound($item1, 'name', 'Pencils', 
            'should have found Pencils when searching for "c"');
        $this->assertRecordFound($item1, 'name', 'chair', 
            'should have found chair when searching for "c"');
        
        // Search in more than one field
        $item2 = $item->search('sku=s&name=c');
        $this->assertLessThan(count($item1), count($item2), 
            'should have fewer results for both sku and name than with just name');

        $this->assertRecordFound($item2, 'name', 'Pencils', 
            'should have found Pencils when searching for "c"');
        $this->assertRecordNotFound($item2, 'name', 'chair', 
            'should have found chair when searching for "c"');

        // Search for an array of parameters
        $params = array('name' => 'c');
        $items = $item->search($params);
        $this->assertRecordFound($items, 'name', 'pencils', 'should find Pencils from search array');
    }

    public function testCanGetVendors()
    {
        $this->prepareForTests();
        $item = new Item;

        // Search for an item with multiple vendors
        $vendors = $item->search(1)->vendors()->get();
        $this->assertGreaterThan(1, count($vendors), 'should have more than 1 vendor for item #1');
        $this->assertRecordFound($vendors, 'name', 'Depot', 'should include "Home Depot" (Depot)');

        // Search for an item with one vendor
        $vendors = $item->search(4)->vendors()->get();
        $this->assertEquals(1, count($vendors), 'should have 1 vendors for item #4');
        $this->assertRecordFound($vendors, 'name', 'home', 'should include "Home Depot" (home)');

        // Search for an item with no vendors
        $vendors = $item->search(5)->vendors()->get();
        $this->assertEquals(0, count($vendors), 'should have 0 vendors for item #5');
    }

    public function testCanGetCarts()
    {
        $this->prepareForTests();
        $item = new Item;

        // Search for an item with multiple carts
        $carts = $item->search(10)->carts()->get();
        $this->assertGreaterThan(1, count($carts), 'should have more than 1 cart for item #1');

        // Search for an item with one cart
        $carts = $item->search(1)->carts()->get();
        $this->assertEquals(1, count($carts), 'should have 1 carts for item #4');

        // Search for an item with no carts
        $carts = $item->search(2)->carts()->get();
        $this->assertEquals(0, count($carts), 'should have 0 carts for item #5');
    }

    public function testCanValidateFailsForInvalidDetails()
    {
        // $this->prepareForTests();
        $item = new Item;

        // Do not send Name field, just (too short) details
        $data = array('details' => 'a');
        $validator = $item->validate($data);
        $this->assertTrue($validator->fails(), 'should fail for missing items');
        $errors = $validator->errors()->all(':message');
        $this->assertEquals(2, count($errors), 'should fail 2 tests');
        $this->assertTrue($this->stringInArray($errors, 'required'), 'should return field required message');
        $this->assertTrue($this->stringInArray($errors, 'between'), 'should return character limit message');

        // TODO: Similar for other data parameters
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
        if (!$this->recordFound($itemList, $field, $expectedValue)) 
            $this->assertTrue(False, $errorMessage);
    }

    private function assertRecordNotFound($itemList, $field, $expectedValue, $errorMessage) 
    {
        if ($this->recordFound($itemList, $field, $expectedValue)) 
            $this->assertTrue(False, $errorMessage);
    }

    private function recordFound($itemList, $field, $expectedValue)
    {
        foreach ($itemList as $item)
            if (stripos($item->$field, $expectedValue) !== False )
                return True;
        return False;
    }

    private function stringInArray($arr, $expectedValue)
    {
        foreach($arr as $item)
            if (stripos($item, $expectedValue) !== False)
                return True;
        return False;
    }
}

