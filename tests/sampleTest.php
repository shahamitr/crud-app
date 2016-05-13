<?php

class sampleTest extends PHPUnit_Extensions_Selenium2TestCase
{
	/**
     * Sample Test case
     *
	 * @test
	 */	
	public function TC1()
	{
		$this->url(getenv('APP_URL'));
		
		$this->assertEquals("PHP - Jenkins demo", $this->title());
	}
	
	/**
     * Sample Test case
     *
	 * @test
	 */	
	public function tearDown()
	{
		$this->url("http://".getenv('SELENIUM_SERVER_IP').":".getenv('SELENIUM_SERVER_PORT')."/selenium-server/driver/?cmd=shutDownSeleniumServer");
	}
}
?>