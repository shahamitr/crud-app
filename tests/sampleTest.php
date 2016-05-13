<?php

class sampleTest extends PHPUnit_Extensions_Selenium2TestCase
{
	public function setUp()
	{
		$this->screenshotPath = getenv('SELENIUM_SERVER_SCREENSHOT_FOLDER');
		$this->screenshotUrl = getenv('SELENIUM_SERVER_SCREENSHOT_URL');
		$this->setPort(intval(getenv('SELENIUM_SERVER_PORT')));
		$this->setHost(getenv('SELENIUM_SERVER_IP'));
		$this->setBrowser(getenv('BROWSER'));
		$this->setBrowserUrl(getenv('APP_URL'));
	}
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