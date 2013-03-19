<?php

class AccountsControllerTest extends TestCase {
	public function testIndex()
	{
		$response = $this->call('GET', 'accounts');
		$this->assertTrue($response->isOk());
	}

	public function testShow()
	{
		$response = $this->call('GET', 'accounts/1');
		$this->assertTrue($response->isOk());
	}

	public function testCreate()
	{
		$response = $this->call('GET', 'accounts/create');
		$this->assertTrue($response->isOk());
	}

	public function testEdit()
	{
		$response = $this->call('GET', 'accounts/1/edit');
		$this->assertTrue($response->isOk());
	}
}
