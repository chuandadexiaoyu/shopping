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
	public function testTesterWorks()
	{
		$this->assertTrue(True);
		$mock = \Mockery::mock('something');
		$mock->shouldReceive('test')->once()->andReturn('works');
		$this->assertEquals('works', $mock->test());
	}

	/**
     * @group failing 
     */
    public function testTesterWorksForFailingTests()
    {
        $this->assertFalse(True);
    }


	public function testIndexCanBeOpenedAsAControllerAction()
	{
		$this->mock('Item')->shouldReceive('all')->once()->andReturn('{"name":"works"}');
		$response = $this->action('GET', 'ItemsController@index');
		$this->assertOK();
		$json = json_decode($response->getContent());
		$this->assertEquals('works', $json->name);
	}

	public function testIndexPageWorks()
	{
		$this->mock('Item')->shouldReceive('all')->once()->andReturn('{"name":"works"}');
		$json = $this->getJSON('items');
		$this->assertEquals('works', $json->name);
	}

	public function testFindPageCanBeOpenedWithAMock()
	{
	 	$mock = \Mockery::mock('ItemRepositoryInterface');
		$mock->shouldReceive('find')->once()->andReturn('{"name":"works"}');
		App::instance('ItemRepositoryInterface', $mock);

		$json = $this->getJSON('items/1');
		$this->assertEquals('works', $json->name);
	}

	public function testFindPageCanBeOpenedWithAnInheritedMock()
	{
		$this->mock('Item')->shouldReceive('find')->once()->andReturn('{"name":"works"}');
		$json = $this->getJSON('items/1');
		$this->assertEquals('works', $json->name);
	}

	/**
	 * Try to open an item that does not exist in the database
	 * (it should return a 'not found' error)
	 * http://api.shop/items/99
	 */
	public function testFindPageReturnsErrorMessageForInvalidItemNumber()
	{
		$this->mock('Item')->shouldReceive('find')->once()->andReturn(Null);
		$response = $this->get('items/1');
		$this->assertError(404, 'Item 1 was not found');
	}


	/**
	 * Return an error message if we have an invalid item 
	 */
	public function testFindPageReturnsErrorMessageForInvalidItem()
	{
		$this->mock('Item')->shouldReceive('find')->once()->andReturn(Null);
        $response = $this->get('items/somethingThatDoesNotExist');
		$this->assertError(404, 'Item somethingThatDoesNotExist was not found');
	}



	/**
	 * Show all vendors associated with a given item
	 * http://api.shop/items/1/vendors
	 */
	public function testItemVendorsPageCanBeShown()
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
	public function testItemVendorsPageReturnsErrorIfInvalidItemSelected()
	{
		$mockItem = $this->mock('Item');
		$mockItem->shouldReceive('find')->once()->andReturn(Null);

		$response = $this->get('items/1/vendors');
		$this->assertError(404, 'Item 1 was not found');
	}

	/**
	 * Show vendors associated with an item where no vendors were found
	 * @return [type] [description]
	 */
	public function testItemVendorsPageReturnsErrorMessageIfNoVendorsFound()
	{
		$mockItem = $this->mock('Item');
		$mockItem->shouldReceive('find')->once()->andReturn($mockItem);
		$mockItem->shouldReceive('vendors')->once()->andReturn(Null); 

		$response = $this->get('items/1/vendors');
		$this->assertError(404, 'There were no vendors for item 1');
	}

	/**
	 * Show carts associated with an item
	 * http://api.shop/items/10/carts
	 */
	public function testItemCartsPageCanBeShown()
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
	public function testItemCartsPageReturnsErrorIfInvalidItemSelected()
	{
		$mockItem = $this->mock('Item');
		$mockItem->shouldReceive('find')->once()->andReturn(Null);

		$response = $this->get('items/1/carts');
		$this->assertError(404, 'Item 1 was not found');
	}


	/**
	 * Show carts associated with an item where no carts were found
	 * @return [type] [description]
	 */
	public function testItemCartsPageReturnsErrorMessageIfNoCartsFound()
	{
		$mockItem = $this->mock('Item');
		$mockItem->shouldReceive('find')->once()->andReturn($mockItem);
		$mockItem->shouldReceive('carts')->once()->andReturn(Null); 

		$response = $this->get('items/1/carts');
		$this->assertError(404, 'There were no carts for item 1');
	}

	/**
	 * Fail a test due to bad json being sent. 
	 */
	public function testFailToStoreItemDueToBadJson()
	{
        $json = '{"name":"dragon","details":"I like dragons.",';
        $response = $this->post('items', $json);
		$this->assertError(400, 'Invalid json string');
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
