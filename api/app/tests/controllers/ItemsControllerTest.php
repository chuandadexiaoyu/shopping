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
	
	public function testIndexPageCanBeOpened()
	{
		$this->getProviderMock('Item', 'search', JSON_WORKS);
		$json = $this->getJsonAction('ItemsController@index');
		$this->assertEquals('works', $json->name);
	}

	public function testEmptyIndexPageReturnsErrorString()
	{
		$this->getProviderMock('Item', 'search', Null);
		$response = $this->getActionWithException('ItemsController@index', Null, 404, 'no items found');
	}


// Tests for the find page -------------------------------------------------
	
	public function testFindPageReturnsDataForExistingItemNumber()
	{
		$this->getProviderMock('Item', 'search', JSON_WORKS);
		$json = $this->getJsonAction('ItemsController@show', '1');
		$this->assertEquals('works', $json->name);
	}

	/**
	 * Return data from a search
	 * http://api.shop/items/name=works
	 */
	public function testFindPageReturnsDataForSuccessfulSearch()
	{
		$this->getProviderMock('Item', 'search', JSON_WORKS);
		$json = $this->getJsonAction('ItemsController@show', 'name=works');
		$this->assertEquals('works', $json->name);
	}

	/**
	 * Try to open an item that does not exist in the database
	 * (it should return a 'not found' error)
	 * http://api.shop/items/99
	 */
	public function testFindPageThrowsErrorMessageForInvalidItemNumber()
	{
		$this->mock('Item')->shouldReceive('search')->once()->andReturn(Null);
		$this->getActionWithException('ItemsController@show', 1, 404, 'Item 1 was not found');
	}

	/**
	 * Return an error message if we have an invalid item 
	 * http://api.shop/items/somethingThatDoesNotExist
	 */
	public function testFindPageThrowsErrorMessageForMissingFieldName()
	{
		$e = $this->mockException(404, 'Unknown field');
		$this->mock('Item')->shouldReceive('search')->once()->andThrow($e);
        $this->getActionWithException('ItemsController@show', 'somethingThatDoesNotExist', 404, 'Unknown field');
	}

	/**
	 * Return an error if there was no data returned from a search
	 * http://api.shop/items/name=test
	 */
	public function testFindPageThrowsErrorIfNoDataReturnedFromSearch()
	{
		$this->getProviderMock('Item', 'search', Null);
        $response = $this->getActionWithException('ItemsController@show', 'name=test', 404, 'no items found');
	}

	public function testFindPageThrowsErrorIfInvalidFieldNameUsed()
	{
		$this->getProviderMock('Item', 'search', Null);
        $response = $this->getActionWithException('ItemsController@show', 'foo=bar', 404, 'no items found');
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
	public function testItemVendorsPageThrowsErrorIfInvalidItemSelected()
	{
		$mockItem = $this->mock('Item');
		$mockItem->shouldReceive('search')->once()->andReturn(Null);

		$json = $this->getActionWithException('ItemsController@vendors', '1', 404, 'Item 1 was not found');
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

		$json = $this->getActionWithException('ItemsController@vendors', '1', 404, 'There were no vendors for item 1');
	}

// Tests for the carts page -------------------------------------------------

	/**
	 * Show carts associated with an item
	 * http://api.shop/items/10/carts
	 */
	public function testItemCartsPageCanBeShown()
	{
		$mockCart = $this->mock('Cart');
		$mockCart->shouldReceive('get')->once()->andReturn(JSON_CART_WORKS);

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

		$json = $this->getActionWithException('ItemsController@carts', '1', 404, 'Item 1 was not found');
	}


	/**
	 * Show carts associated with an item where no carts were found
	 */
	public function testItemCartsPageReturnsErrorMessageIfNoCartsFound()
	{
		$mockItem = $this->mock('Item');
		$mockItem->shouldReceive('search')->once()->andReturn($mockItem);
		$mockItem->shouldReceive('carts')->once()->andReturn(Null); 
		$this->getActionWithException('ItemsController@carts', '1', 404, 'There were no carts for item 1');
	}

// Tests for deleting data ------------------------------------------------

	public function testDestroyFailsForNonExistingItem()
	{
		$mockItem = $this->mock('Item');
		$mockItem->shouldReceive('search')->once()->andReturn(Null);
		$this->getActionWithException('ItemsController@destroy', '1', 404, 'not found');
	}

	// public function testDestroySuccess()
	// {
	// 	$mockItem = $this->mock('Item');
	// 	$mockItem->shouldReceive('search')->once()->andReturn(True);
	// 	$mockItem->shouldReceive('destroy')->once()->andReturn(Null);
	// 	$json = $this->getJsonAction('ItemsController@destroy', '1');	
			
	// }

// Tests for storing data -------------------------------------------------

	public function testFailToStoreItemDueToBadJson()
	{
        $json = '{"name":"dragon","details":"I like dragons.",';
        $this->postUriWithException('items', $json, 400, 'Invalid json'); 
	}

	public function testFailToStoreItemDueToValidationError()
	{
		$validator = Mockery::mock('Illuminate\Validation\Factory');
		$validator->shouldReceive('make')->once()->andReturn($validator)
			->shouldReceive('passes')->once()->andReturn(False)
			->shouldReceive('errors->toJson')->once()->andReturn(JSON_ERROR);
		Validator::swap($validator);
        $json = '{"name":"Joel","details":"d"}';
        $this->postUriWithException('items', $json, 400, 'error'); 
	}

	public function testFailToStoreItemDueToMultipleValidationErrors()
	{
		$validator = Mockery::mock('Illuminate\Validation\Factory');
		$validator->shouldReceive('make')->once()->andReturn($validator)
			->shouldReceive('passes')->once()->andReturn(False)
			->shouldReceive('errors->toJson')->once()->andReturn(JSON_ERRORS);
		Validator::swap($validator);
        $json = '{"name":"j","details":"d"}';
        $this->postUriWithException('items', $json, 400, array('name must be at least', 
        	'details must be between')); 
	}

	// public function testFailToStoreItemDueToMissingTable()
	// {
	// 	// We do not prepare the database; this will cause it to fail
 //        $json = '{"name":"joel","details":"dragon"}';
 //        $this->postUriWithException('items', $json, Null, 'General error'); 
	// }

	/**
	 * @group anow
	 * Test successfully storing a single item
	 * POST http://api.shop/items
	 */
// 	public function testStoreItem()
// 	{
// 		$json = '{"name":"dragon","details":"I like dragons."}';
// 		$response = $this->post('items', $json);
//         // $response = $this->action('POST', 'ItemsController@store', $json);
// 		// $this->assertTrue($response->isOK());
// //		$response = $this->call('POST', 'items&name="test item"&details="This is a single test item"')
// 	}

}
