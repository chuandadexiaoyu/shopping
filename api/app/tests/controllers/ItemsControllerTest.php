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
		if($this->runFailingTests)
			$this->assertFalse(True);
	}

	public function testIndex()
	{
		// $response = $this->action('GET', 'ItemsController/index');
		$response = $this->call('GET', 'items');
		$this->assertTrue($response->isOk());
		$json = json_decode($response->getContent());
		$this->assertGreaterThan(10, count($json));
	}

	public function testShow()
	{
		$response = $this->call('GET', 'items/1');
		$this->assertTrue($response->isOk());
		$json = json_decode($response->getContent());
		$this->assertEquals('Windex', $json->name);
	}

	/**
	 * Try to open an item that does not exist in the database
	 * (it should return a 'not found' error)
	 * http://api.shop/items/99
	 */
	public function testShowInvalidItem()
	{
		$response = $this->call('GET', 'items/99');
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
		$response = $this->call('GET', 'items/2/vendors');
		$this->assertTrue($response->isOk());
		$json = json_decode($response->getContent());
		$this->assertEquals(4,count($json));
		$this->assertEquals('Wallmart', $json[0]->name);
	}

	/**
	 * Show vendors associated with an invalid item
	 * http://api.shop/items/99/vendors
	 */
	public function testShowInvalidItemVendors()
	{
		$response = $this->call('GET', 'items/99/vendors');
		$this->assertTrue($response->isNotFound());		
	}

	/**
	 * Show carts associated with an item
	 * http://api.shop/items/2/carts
	 */
	public function testShowItemNotInCart()
	{
		$response = $this->call('GET', 'items/2/carts');
		$this->assertTrue($response->isOk());		
		$json = json_decode($response->getContent());
		$this->assertEquals(0,count($json));
	}

	/**
	 * Show carts associated with an item
	 * http://api.shop/items/10/carts
	 */
	public function testShowItemsInCart()
	{
		$response = $this->call('GET', 'items/10/carts');
		$this->assertTrue($response->isOk());		
		$json = json_decode($response->getContent());
		$this->assertEquals(2,count($json));
	}

	/**
	 * Show carts associated with an invalid item
	 * http://api.shop/items/99/carts
	 */
	public function testShowInvalidItemCarts()
	{
		$response = $this->call('GET', 'items/99/carts');
		$this->assertTrue($response->isNotFound());		
	}

	/**
	 * Fail a test due to bad json being sent. 
	 * The call method takes these parameters:
	 *   string  $method 		The HTTP method (GET, POST, PUT, DELETE, etc.)
	 *   string  $uri 			The URI
	 *   array   $parameters 	The query (GET) or request (POST) parameters
	 *   array   $files 		The request files ($_FILES)
	 *   array   $server 		The server parameters ($_SERVER)
	 *   string  $content 		The raw body data
	 *   bool    $changeHistory	
	 *   
	 */
	public function testFailToStoreItemDueToBadJSON()
	{
        $json = '{"name":"dragon","details":"I like dragons.",{}';
        $response = $this->call('POST', 'items', array(), array(), array(), $json);
        $this->assertTrue($response->isClientError(), 'should have a client error');
        $this->assertEquals('"Invalid json string"', $response->getContent(), 'should return error message');
	}

	public function testFailToStoreItemDueToInvalidData()
	{
        $json = '{"name":"","details":"I like dragons."}';
        $response = $this->call('POST', 'items', array(), array(), array(), $json);
        $this->assertTrue($response->isClientError(), 'should reject due to invalid data');
        // $this->assertEquals('"Invalid json string"', $response->getContent(), 'should return error message');
	}

	/**
	 * Test successfully storing a single item
	 * POST http://api.shop/items
	 */
// 	public function testStoreItem()
// 	{
// 		$json = '{"name":"dragon","details":"I like dragons."}';
// 		$response = $this->call('POST', 'items', array(), array(), array(), $json);
// 		$this->assertTrue($response->isOK());
// //		$response = $this->call('POST', 'items&name="test item"&details="This is a single test item"')
// 	}

}
