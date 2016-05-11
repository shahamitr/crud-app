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
		$url = "http://127.0.0.1/jenkinsdemo";
		
		$this->url($url);
		
		$this->assertEquals("PHP - Jenkins demo", $this->title());
	}
	
	public function tearDown()
	{
		$this->stop();
	}
}
?>