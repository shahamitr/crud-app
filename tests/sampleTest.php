<?php

class sampleTest extends PHPUnit_Extensions_Selenium2TestCase
{
	public function setUp()
	{
		$this->screenshotPath = getenv('SELENIUM_SERVER_SCREENSHOT_FOLDER');
		$this->screenshotUrl = getenv('SELENIUM_SERVER_SCREENSHOT_URL');
		$this->Port = (intval(getenv('SELENIUM_SERVER_PORT')));
		$this->Host = getenv('SELENIUM_SERVER_IP');
		$this->Browser = getenv('BROWSER');
		$this->BrowserUrl = getenv('APP_URL');
	}
	
	/**
     * Sample Test case
     *
	 * @test
	 */	
	public function TC1()
	{
		$this->url($this->BrowserUrl);
		
		$this->assertEquals("PHP - Jenkins demo", $this->title());
	}
	
	/**
     * Sample Test case
     *
	 * @test
	 */	
	public function tearDown()
	{
		$this->url("http://".SELENIUM_SERVER_IP."/selenium-server/driver/?cmd=shutDownSeleniumServer");
	}
}
?>