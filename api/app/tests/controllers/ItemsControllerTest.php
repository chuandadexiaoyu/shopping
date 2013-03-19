<?php

class ItemsControllerTest extends TestCase {
	public function testIndex()
	{
		$response = $this->call('GET', 'items');
		$this->assertTrue($response->isOk());
	}

	public function testShow()
	{
		$response = $this->call('GET', 'items/1');
		$this->assertTrue($response->isOk());
	}

}
