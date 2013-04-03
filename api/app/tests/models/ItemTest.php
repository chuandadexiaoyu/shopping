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


//     class EloquentModelFindStub extends Illuminate\Database\Eloquent\Model {
//     public function newQuery()
//     {
//         $mock = m::mock('Illuminate\Database\Eloquent\Builder');
//         $mock->shouldReceive('find')->once()->with(1, array('*'))->andReturn('foo');
//         return $mock;
//     }
// }

    // TODO: Figure out how to use an array instead of a database
    // public function testIndex()
    // {
    //     Eloquent::shouldReceive('foo')->andReturn('bar');
    //     // DB::shouldReceive('select')->once()->andReturn('foo');

    //     // DB::pretend(function() {
    //     //     return array( 'name' => 'Window' );
    //     // });
    //     //shouldReceive('get')->once()->andReturn('foo');
    //     $item = new Item;
    //     $this->assertEquals('Windex', $item->search(1)->name, 'should find Windex');
    // }

    /**
     * @group db
     */
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

    /**
     * @group db
     */
    public function testSearchFailsIfPassedInvalidParams()
    {
        $this->prepareForTests();
        $item = new Item;
        $result = $item->search('invalidSearchParameter');
        $this->assertEquals(0, count($result));
    }

    // public function testSearchFailsIfPassedInvalidFieldNames()
    // {
    //     // TODO: extract key words from the search string,
    //     // eg count=x&offset=y; these should be OK
    //     // dragon=x should return an empty string.
    //     $this->markTestIncomplete();
    //     $this->prepareForTests();
    //     $item = new Item;
    //     $result = $item->search('dragon=4');
    //     $this->assertEquals(0, count($result));
    // }

    /**
     * @group db
     */
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

    /**
     * @group db
     */
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

    public function testValidateFailsForInvalidDetails()
    {
        $item = new Item;

        // Do not send Name field, just (too short) details
        $data = array('details' => 'a');
        $validator = $item->validate($data);
        $this->assertTrue($validator->fails(), 'should fail for missing item');
        $errors = $validator->errors()->all(':message');
        $this->assertEquals(2, count($errors), 'should fail 2 tests');
        $this->assertTrue($this->substrInArray($errors, 'required'), 
            'should return field required message');
        $this->assertTrue($this->substrInArray($errors, 'between'), 
            'should return character limit message');
    }

    public function testValidateFailsForInvalidSKU()
    {
        $item = new Item;

        // Send (valid) name field, and (too short) sku
        $data = array('name'=>'joel', 'sku'=>'a');
        $validator = $item->validate($data);
        $this->assertTrue($validator->fails(), 'should fail for short sku');
        $errors = $validator->errors()->all(':message');
        $this->assertEquals(1, count($errors), 'should fail 1 test');
        $this->assertTrue($this->substrInArray($errors, 'between'), 
            'should return character limit message');
    }

    public function testValidateSucceedsForValidName()
    {
        $item = new Item;

        // Send (valid) name field
        $data = array('name'=>'joel');
        $validator = $item->validate($data);
        $this->assertTrue($validator->passes(), 'should succeed for valid name');
        $errors = $validator->errors()->all(':message');
        $this->assertEquals(0, count($errors), 'should not have any errors');
    }

    public function testValidateSucceedsIfPassedValidObjectData()
    {
        $item = new Item;
        $data = new \Symfony\Component\HttpFoundation\ParameterBag(array('name'=>'joel'));
        $validator = $item->validate($data);
        $this->assertTrue($validator->passes());
    }

    public function testValidateFailsIfPassedInvalidObjectData()
    {
        $item = new Item;
        $data = new \Symfony\Component\HttpFoundation\ParameterBag(array('name'=>'j'));
        $validator = $item->validate($data);
        $this->assertFalse($validator->passes());
        $errors = $validator->errors()->all(':message');
        $this->assertEquals(1, count($errors), 'should fail 1 test');
        $this->assertTrue($this->substrInArray($errors, 'characters'), 
            'should return character limit message');
    }

    public function testTesterWorksAgain()
    {
        $this->assertTrue(True);
    }


}

