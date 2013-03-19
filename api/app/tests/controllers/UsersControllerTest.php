<?php

class UsersControllerTest extends TestCase {
	public function testIndex()
	{
		$response = $this->call('GET', 'users');
		$this->assertTrue($response->isOk());
	}

	public function testShow()
	{
		$response = $this->call('GET', 'users/1');
		$this->assertTrue($response->isOk());
	}

}
