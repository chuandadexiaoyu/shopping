<?php

class CartsControllerTest extends TestCase {
	public function testIndex()
	{
		$response = $this->call('GET', 'carts');
		$this->assertTrue($response->isOk());
	}

	public function testShow()
	{
		$response = $this->call('GET', 'carts/1');
		$this->assertTrue($response->isOk());
	}

}
