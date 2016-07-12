<?php

namespace PayMaya\Test\API;

use PayMaya\API\Customization;

class CustomizationTest extends \PHPUnit_Framework_TestCase
{
	public static function getObject()
	{
		$customization = new Customization();
		$customization->logoUrl = "https://cdn.paymaya.com/production/checkout_api/customization_example/yourlogo.svg";
		$customization->iconUrl = "https://cdn.paymaya.com/production/checkout_api/customization_example/youricon.ico";
		$customization->appleTouchIconUrl = "https://cdn.paymaya.com/production/checkout_api/customization_example/youricon_ios.ico";
		$customization->customTitle = "Checkout Page Title";
		$customization->colorScheme = "#368d5c";
		return $customization;
	}

	public function testRemove()
	{
		$obj = self::getObject();
		$obj->remove();
		$this->assertNull($obj->logoUrl);
		$this->assertNull($obj->iconUrl);
		$this->assertNull($obj->appleTouchIconUrl);
		$this->assertNull($obj->customTitle);
		$this->assertNull($obj->colorScheme);
	}

	public function testInitialization()
	{
		$obj = self::getObject();
		$this->assertEquals($obj->logoUrl, "https://cdn.paymaya.com/production/checkout_api/customization_example/yourlogo.svg");
		$this->assertEquals($obj->iconUrl, "https://cdn.paymaya.com/production/checkout_api/customization_example/youricon.ico");
		$this->assertEquals($obj->appleTouchIconUrl, "https://cdn.paymaya.com/production/checkout_api/customization_example/youricon_ios.ico");
		$this->assertEquals($obj->customTitle, "Checkout Page Title");
		$this->assertEquals($obj->colorScheme, "#368d5c");
		return $obj;
	}

	/**
	 * @depends testInitialization
	 */
	public function testSet($obj)
	{
		$obj->set();
		$this->assertEquals($obj->logoUrl, "https://cdn.paymaya.com/production/checkout_api/customization_example/yourlogo.svg");
		$this->assertEquals($obj->iconUrl, "https://cdn.paymaya.com/production/checkout_api/customization_example/youricon.ico");
		$this->assertEquals($obj->appleTouchIconUrl, "https://cdn.paymaya.com/production/checkout_api/customization_example/youricon_ios.ico");
		$this->assertEquals($obj->customTitle, "Checkout Page Title");
		$this->assertEquals($obj->colorScheme, "#368d5c");
		return $obj;
	}

	/**
	 * @depends testSet
	 */
	public function testGet($obj)
	{
		$obj->get();
		$this->assertEquals($obj->logoUrl, "https://cdn.paymaya.com/production/checkout_api/customization_example/yourlogo.svg");
		$this->assertEquals($obj->iconUrl, "https://cdn.paymaya.com/production/checkout_api/customization_example/youricon.ico");
		$this->assertEquals($obj->appleTouchIconUrl, "https://cdn.paymaya.com/production/checkout_api/customization_example/youricon_ios.ico");
		$this->assertEquals($obj->customTitle, "Checkout Page Title");
		$this->assertEquals($obj->colorScheme, "#368d5c");
		return $obj;
	}
}
