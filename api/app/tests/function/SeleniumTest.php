<?php

class SeleniumTest extends PHPUnit_Extensions_Selenium2TestCase
{
    public function __construct()
    {
        parent::__construct();
        $this->setBrowserUrl('http://lkata');
        $this->setBrowser('chrome');
        $this->setHost('localhost');
        $this->setPort(4444);
    }

    public function testHomePageDoesNotIncludeDebugError()
    {
        $this->assertEquals(0, 
            preg_match('/xdebug-error/i', $this->source()), 
            'should not return an xdebug error');
    }
}

