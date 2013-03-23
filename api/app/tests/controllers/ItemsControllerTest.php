<?php

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
		$mock = \Mockery::mock('something');
		$mock->shouldReceive('test')->once()->andReturn('works');
		$this->assertEquals('works', $mock->test());
	}

	public function testIndexAsControllerAction()
	{
		$this->mock('Item')->shouldReceive('all')->once()->andReturn('{"name":"works"}');
		$response = $this->action('GET', 'ItemsController@index');
		$this->assertOK();
		$json = json_decode($response->getContent());
		$this->assertEquals('works', $json->name);
	}

	public function testIndex()
	{
		$this->mock('Item')->shouldReceive('all')->once()->andReturn('{"name":"works"}');
		$json = $this->getJSON('items');
		$this->assertEquals('works', $json->name);
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

	/**
	 * TODO: If the user sends a request for an invalid page, report the error 
	 */
	public function testMockItemInvalid()
	{
		$this->mock('Item')->shouldReceive('find')->once()->andReturn('{"name":"works"}');
		$json = $this->getJSON('items/df');
		$this->assertEquals('works', $json->name);
	}

	/**
	 * Try to open an item that does not exist in the database
	 * (it should return a 'not found' error)
	 * http://api.shop/items/99
	 */
	public function testShowInvalidItem()
	{
		$this->mock('Item')->shouldReceive('find')->once()->andReturn(Null);
		$response = $this->get('items/1');
		$this->assertTrue($response->isNotFound());
		$json = json_decode($response->getContent());
		$this->assertEmpty($json); 
	}


	/**
	 * Show all vendors associated with a given item
	 * http://api.shop/items/1/vendors
	 */
	public function testShowItemVendors()
	{
		$mockVendor = $this->mock('Vendor');
		$mockVendor->shouldReceive('get')->once()->andReturn('{"name":"vendor works"}');

		$mockItem = $this->mock('Item');
		$mockItem->shouldReceive('find')->once()->andReturn($mockItem);
		$mockItem->shouldReceive('vendors')->once()->andReturn($mockVendor); 

		$json = $this->getJSON('items/1/vendors');
	 	$this->assertEquals('vendor works', $json->name);
	}

	/**
	 * Show vendors associated with an invalid item
	 * http://api.shop/items/99/vendors
	 */
	public function testShowInvalidItemVendors()
	{
		$mockItem = $this->mock('Item');
		$mockItem->shouldReceive('find')->once()->andReturn(Null);

		$response = $this->get('items/1/vendors');
	 	$this->assertTrue($response->isNotFound());
	}

	/**
	 * Show vendors associated with an item where no vendors were found
	 * @return [type] [description]
	 */
	public function testShowNotFoundVendors()
	{
		$mockItem = $this->mock('Item');
		$mockItem->shouldReceive('find')->once()->andReturn($mockItem);
		$mockItem->shouldReceive('vendors')->once()->andReturn(Null); 

		$response = $this->get('items/1/vendors');
		$this->assertFalse($response->isOK());
		$this->assertTrue($response->isNotFound());
		$this->assertEquals(404, $response->getStatusCode());
		$this->assertEquals('[]', $response->getContent());
	}

	/**
	 * Show carts associated with an item
	 * http://api.shop/items/10/carts
	 */
	public function testShowItemInCarts()
	{
		$mockCart = $this->mock('Cart');
		$mockCart->shouldReceive('get')->once()->andReturn('{"name":"cart works"}');

		$mockItem = $this->mock('Item');
		$mockItem->shouldReceive('find')->once()->andReturn($mockItem);
		$mockItem->shouldReceive('carts')->once()->andReturn($mockCart); 

		$json = $this->getJSON('items/1/carts');
	 	$this->assertEquals('cart works', $json->name);
	}

	/**
	 * Show carts associated with an invalid item
	 * http://api.shop/items/99/carts
	 */
	public function testShowInvalidItemCarts()
	{
		$mockItem = $this->mock('Item');
		$mockItem->shouldReceive('find')->once()->andReturn(Null);

		$response = $this->get('items/1/carts');
	 	$this->assertTrue($response->isNotFound());
	}


	/**
	 * Show vendors associated with an item where no vendors were found
	 * @return [type] [description]
	 */
	public function testShowNotFoundCarts()
	{
		$mockItem = $this->mock('Item');
		$mockItem->shouldReceive('find')->once()->andReturn($mockItem);
		$mockItem->shouldReceive('carts')->once()->andReturn(Null); 

		$response = $this->get('items/1/carts');
		$this->assertFalse($response->isOK());
		$this->assertTrue($response->isNotFound());
		$this->assertEquals('[]', $response->getContent());
	}

	/**
	 * Fail a test due to bad json being sent. 
	 */
	public function testFailToStoreItemDueToBadJSON()
	{
        $json = '{"name":"dragon","details":"I like dragons.",';
        $response = $this->post('items', $json);
        $this->assertTrue($response->isClientError(), 'should return a client error');
        $this->assertEquals(400, $response->getStatusCode());
        $check = json_decode($response->getContent(), True);
        $this->assertEquals('Invalid json string', $check['errors']['error']);
	}

	public function testFailToStoreItemDueToInvalidData()
	{
		// $mock = \Mockery::mock('Validator');
		// $mock->shouldReceive('make')->once()->andReturn(False);

//		$this->mock('Validator')->shouldReceive('make')->once()->andReturn(False);

        // $json = '{"name":"","details":"I like dragons."}';
        // $response = $this->post('items', $json);
        // $this->assertTrue($response->isClientError(), 'should reject due to invalid data');
        // $this->assertEquals('["The name field is required."]', 
        // 	$response->getContent(), 
        // 	'should return error message');
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
