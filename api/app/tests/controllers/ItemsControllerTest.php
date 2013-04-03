<?php

/**
 * This class checks the ItemsController, and also the routing.
 * Everything for ItemsController should be routed through /items
 *
 * @group controllers
 * @group items
 */
class ItemsControllerTest extends TestCase 
{

// Tests for the index page ------------------------------------------------
	
	public function testIndexPageCanBeOpenedAsAControllerAction()
	{
		$this->getProviderMock('Item', 'search', JSON_WORKS);
		$json = $this->getJsonAction('ItemsController@index');
		$this->assertEquals('works', $json->name);
	}

	public function testEmptyIndexPageReturnsErrorString()
	{
		$this->getProviderMock('Item', 'search', Null);
		$response = $this->getAction('ItemsController@index');
		$this->assertError(404, 'no items found');
	}


// Tests for the find page -------------------------------------------------
	
	// public function testFindPageCanBeOpenedWithAMock()
	// {
	//  	$mock = \Mockery::mock('ItemRepositoryInterface');
	// 	$mock->shouldReceive('search')->once()->andReturn('{"name":"works"}');
	// 	App::instance('ItemRepositoryInterface', $mock);

	// 	$json = $this->getJsonAction('ItemsController@show', '1');
	// 	$this->assertEquals('works', $json->name);
	// }

	public function testFindPageCanBeOpenedWithAnInheritedMock()
	{
		$this->getProviderMock('Item', 'search', JSON_WORKS);
		$json = $this->getJsonAction('ItemsController@show', '1');
		$this->assertEquals('works', $json->name);
	}

	/**
	 * Try to open an item that does not exist in the database
	 * (it should return a 'not found' error)
	 * http://api.shop/items/99
	 */
	public function testFindPageReturnsErrorMessageForInvalidItemNumber()
	{
		// $this->getProviderMock('Item', 'search', Null);

		$this->mock('Item')->shouldReceive('search')->once()->andReturn(Null);
		$response = $this->getAction('ItemsController@show', '1');
		$this->assertError(404, 'Item 1 was not found');
	}

	/**
	 * Return an error message if we have an invalid item 
	 * http://api.shop/items/somethingThatDoesNotExist
	 */
	public function testFindPageReturnsErrorMessageForInvalidItem()
	{
		// TODO: Get error handling to work consistently
		$this->mock('Item')->shouldReceive('search')->once()->andReturn(Null);
		// $this->getProviderMock('Item', 'search', Null);
        $response = $this->getAction('ItemsController@show', 'somethingThatDoesNotExist');
		$this->assertError(404, 'Item somethingThatDoesNotExist was not found');
	}

	/**
	 * Return data from a search
	 * http://api.shop/items/name=works
	 */
	public function testFindPageReturnsDataFromASearch()
	{
		$this->getProviderMock('Item', 'search', JSON_WORKS);
		$json = $this->getJsonAction('ItemsController@show', 'name=works');
		$this->assertEquals('works', $json->name);
	}

	/**
	 * Return an error if there was no data returned from a search
	 * http://api.shop/items/name=test
	 */
	public function testFindPageReturnsErrorIfNoDataReturnedFromSearch()
	{
		$this->getProviderMock('Item', 'search', Null);
        $response = $this->getAction('ItemsController@show', 'name=test');
		$this->assertError(404, 'no items found');
	}


// Tests for the vendors page -------------------------------------------------

	/**
	 * Show all vendors associated with a given item
	 * http://api.shop/items/1/vendors
	 */
	public function testItemVendorsPageCanBeShown()
	{
		$mockVendor = $this->mock('Vendor');
		$mockVendor->shouldReceive('get')->once()->andReturn('{"name":"vendor works"}');

		$mockItem = $this->mock('Item');
		$mockItem->shouldReceive('search')->once()->andReturn($mockItem);
		$mockItem->shouldReceive('vendors')->once()->andReturn($mockVendor); 

		$json = $this->getJsonAction('ItemsController@vendors', '1');
	 	$this->assertEquals('vendor works', $json->name);
	}

	/**
	 * Show vendors associated with an invalid item
	 * http://api.shop/items/99/vendors
	 */
	public function testItemVendorsPageReturnsErrorIfInvalidItemSelected()
	{
		$mockItem = $this->mock('Item');
		$mockItem->shouldReceive('search')->once()->andReturn(Null);

		$json = $this->getAction('ItemsController@vendors', '1');
		$this->assertError(404, 'Item 1 was not found');
	}

	/**
	 * Show vendors associated with an item where no vendors were found
	 * @return [type] [description]
	 */
	public function testItemVendorsPageReturnsErrorMessageIfNoVendorsFound()
	{
		$mockItem = $this->mock('Item');
		$mockItem->shouldReceive('search')->once()->andReturn($mockItem);
		$mockItem->shouldReceive('vendors')->once()->andReturn(Null); 

		$json = $this->getAction('ItemsController@vendors', '1');
		$this->assertError(404, 'There were no vendors for item 1');
	}

// Tests for the carts page -------------------------------------------------

	/**
	 * Show carts associated with an item
	 * http://api.shop/items/10/carts
	 */
	public function testItemCartsPageCanBeShown()
	{
		$mockCart = $this->mock('Cart');
		$mockCart->shouldReceive('get')->once()->andReturn('{"name":"cart works"}');

		$mockItem = $this->mock('Item');
		$mockItem->shouldReceive('search')->once()->andReturn($mockItem);
		$mockItem->shouldReceive('carts')->once()->andReturn($mockCart); 

		$json = $this->getJsonAction('ItemsController@carts', '1');
	 	$this->assertEquals('cart works', $json->name);
	}

	/**
	 * Show carts associated with an invalid item
	 * http://api.shop/items/99/carts
	 */
	public function testItemCartsPageReturnsErrorIfInvalidItemSelected()
	{
		$mockItem = $this->mock('Item');
		$mockItem->shouldReceive('search')->once()->andReturn(Null);

		$json = $this->getAction('ItemsController@carts', '1');
		$this->assertError(404, 'Item 1 was not found');
	}


	/**
	 * Show carts associated with an item where no carts were found
	 */
	public function testItemCartsPageReturnsErrorMessageIfNoCartsFound()
	{
		$mockItem = $this->mock('Item');
		$mockItem->shouldReceive('search')->once()->andReturn($mockItem);
		$mockItem->shouldReceive('carts')->once()->andReturn(Null); 

		$json = $this->getAction('ItemsController@carts', '1');
		$this->assertError(404, 'There were no carts for item 1');
	}

// Tests for deleting data ------------------------------------------------

	public function testDeleteItem()
	{
		// TODO: Activate this
		// $response = $this->delete('items/10');
		// $this->assertOK();
	}

// Tests for storing data -------------------------------------------------

	/**
	 * Fail a test due to bad json being sent. 
	 */
	public function testFailToStoreItemDueToBadJson()
	{
        $json = '{"name":"dragon","details":"I like dragons.",';
        $response = $this->post('items', $json);
		$this->assertError(400, 'Invalid json string');
	}

	public function testFailToStoreItemDueToInvalidDetails()
	{
  //       $json = '{"name":"Joel","details":"d"}';
  //       $response = $this->post('items', $json);
		// $this->assertError(400, 'details');

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

}
