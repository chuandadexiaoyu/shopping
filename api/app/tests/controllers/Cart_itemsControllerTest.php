<?php

class Cart_itemsControllerTest extends TestCase {
	public function testIndex()
	{
		$response = $this->call('GET', 'cart_items');
		$this->assertTrue($response->isOk());
	}

	public function testShow()
	{
		$response = $this->call('GET', 'cart_items/1');
		$this->assertTrue($response->isOk());
	}

	public function testCreate()
	{
		$response = $this->call('GET', 'cart_items/create');
		$this->assertTrue($response->isOk());
	}

	public function testEdit()
	{
		$response = $this->call('GET', 'cart_items/1/edit');
		$this->assertTrue($response->isOk());
	}
}
