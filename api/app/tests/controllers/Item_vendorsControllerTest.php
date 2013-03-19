<?php

class Item_vendorsControllerTest extends TestCase {
	public function testIndex()
	{
		$response = $this->call('GET', 'item_vendors');
		$this->assertTrue($response->isOk());
	}

	public function testShow()
	{
		$response = $this->call('GET', 'item_vendors/1');
		$this->assertTrue($response->isOk());
	}

	public function testCreate()
	{
		$response = $this->call('GET', 'item_vendors/create');
		$this->assertTrue($response->isOk());
	}

	public function testEdit()
	{
		$response = $this->call('GET', 'item_vendors/1/edit');
		$this->assertTrue($response->isOk());
	}
}
