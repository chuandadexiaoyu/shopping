<?php

/**
 * This class tests the item model
 * 
 * @group models
 * @group items
 */
class ItemTest extends TestCase 
{
    public function tearDown()
    {
        \Mockery::close();
    }


// Get Vendors and Carts -------------------------------------------------

    public function testCanGetVendors()
    {
        $this->prepareForTests();
        $model = new Item;

        // Search for an item with multiple vendors
        $vendors = $model->search(1)->vendors()->get();
        $this->assertGreaterThan(1, count($vendors), 'should have more than 1 vendor for item #1');
        $this->assertRecordFound($vendors, 'name', 'Depot', 'should include "Home Depot" (Depot)');

        // Search for an item with one vendor
        $vendors = $model->search(4)->vendors()->get();
        $this->assertEquals(1, count($vendors), 'should have 1 vendors for item #4');
        $this->assertRecordFound($vendors, 'name', 'home', 'should include "Home Depot" (home)');

        // Search for an item with no vendors
        $vendors = $model->search(5)->vendors()->get();
        $this->assertEquals(0, count($vendors), 'should have 0 vendors for item #5');
    }

    /**
     * @group db
     */
    public function testCanGetCarts()
    {
        $this->prepareForTests();
        $model = new Item;

        // Search for an item with multiple carts
        $carts = $model->search(10)->carts()->get();
        $this->assertGreaterThan(1, count($carts), 'should have more than 1 cart for item #1');

        // Search for an item with one cart
        $carts = $model->search(1)->carts()->get();
        $this->assertEquals(1, count($carts), 'should have 1 carts for item #4');

        // Search for an item with no carts
        $carts = $model->search(2)->carts()->get();
        $this->assertEquals(0, count($carts), 'should have 0 carts for item #5');
    }

}

