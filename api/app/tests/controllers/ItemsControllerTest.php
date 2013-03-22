<?php

use Mockery\Mockery;

/**
 * This class checks the ItemsController, and also the routing.
 * Everything for ItemsController should be routed through /items
 */
class ItemsControllerTest extends TestCase 
{
	public function testerWorks()
	{
		$this->assertTrue(True);
		if($this->runFailingTests){
			$this->assertFalse(True);
		}
		$mock = \Mockery::mock('Item');
		$mock->shouldReceive('test')->once()->andReturn('works');
		$this->assertEquals('works', $mock->test());
	}

	public function testIndex()
	{
		// $response = $this->action('GET', 'ItemsController/index');
		$json = $this->getJSON('items');
		$this->assertGreaterThan(10, count($json));
	}


	public function testMockShow()
	{
	 	$mock = \Mockery::mock('ItemRepositoryInterface');
		$mock->shouldReceive('find')->once()->andReturn('{"name":"works"}');
		App::instance('ItemRepositoryInterface', $mock);

		$json = $this->getJSON('items/1');
		$this->assertEquals('works', $json->name);
	}

	public function testMockItemShow()
	{
		$this->mock('Item')->shouldReceive('find')->once()->andReturn('{"name":"works"}');
		$json = $this->getJSON('items/1');
		$this->assertEquals('works', $json->name);
	}

	// This will load data from the database, so is no longer needed for our tests.
	// public function testShow()
	// {
	// 	$json = $this->getJSON('items/1');
	// 	// $this->assertEquals('works', $json->name);
	//  	$this->assertEquals('Windex', $json->name);
	// }

	/**
	 * Try to open an item that does not exist in the database
	 * (it should return a 'not found' error)
	 * http://api.shop/items/99
	 */
	public function testShowInvalidItem()
	{
		$response = $this->get('items/99');
		$this->assertTrue($response->isNotFound());
		$json = json_decode($response->getContent());
		$this->assertEmpty($json); 
	}

	/**
	 * Show vendors associated with a given item
	 * http://api.shop/items/2/vendors
	 */
	public function testShowItemVendors()
	{
		$json = $this->getJSON('items/2/vendors');
		$this->assertEquals(4,count($json));
		$this->assertEquals('Wallmart', $json[0]->name);
	}

	/**
	 * Show vendors associated with an invalid item
	 * http://api.shop/items/99/vendors
	 */
	public function testShowInvalidItemVendors()
	{
		$response = $this->get('items/99/vendors');
		$this->assertTrue($response->isNotFound());		
	}

	/**
	 * Show carts associated with an item
	 * http://api.shop/items/2/carts
	 */
	public function testShowItemNotInCart()
	{
		$json = $this->getJSON('items/2/carts');
		$this->assertEquals(0,count($json));
	}

	/**
	 * Show carts associated with an item
	 * http://api.shop/items/10/carts
	 */
	public function testShowItemsInCart()
	{
		$json = $this->getJSON('items/10/carts');
		$this->assertEquals(2,count($json));
	}

	/**
	 * Show carts associated with an invalid item
	 * http://api.shop/items/99/carts
	 */
	public function testShowInvalidItemCarts()
	{
		$response = $this->get('items/99/carts');
		$this->assertTrue($response->isNotFound());		
	}

	/**
	 * Fail a test due to bad json being sent. 
	 */
	public function testFailToStoreItemDueToBadJSON()
	{
        $json = '{"name":"dragon","details":"I like dragons.",{}';
        $response = $this->post('items', $json);
        $this->assertTrue($response->isClientError(), 'should have a client error');
        $this->assertEquals('"Invalid json string"', $response->getContent(), 'should return error message');
	}

	public function testFailToStoreItemDueToInvalidData()
	{
		// $mock = \Mockery::mock('Validator');
		// $mock->shouldReceive('make')->once()->andReturn(False);

//		$this->mock('Validator')->shouldReceive('make')->once()->andReturn(False);
        $json = '{"name":"","details":"I like dragons."}';
        $response = $this->post('items', $json);
        $this->assertTrue($response->isClientError(), 'should reject due to invalid data');
        $this->assertEquals('["The name field is required."]', 
        	$response->getContent(), 
        	'should return error message');
	}

	/**
	 * Test successfully storing a single item
	 * POST http://api.shop/items
	 */
// 	public function testStoreItem()
// 	{
// 		$json = '{"name":"dragon","details":"I like dragons."}';
        // $response = $this->post('items', $json);
// 		$this->assertTrue($response->isOK());
// //		$response = $this->call('POST', 'items&name="test item"&details="This is a single test item"')
// 	}

	// public function testDeleteItem()
	// {
	// 	$response = $this->delete('items/10');

	// }
}
