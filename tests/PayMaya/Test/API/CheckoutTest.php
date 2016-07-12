<?php

namespace PayMaya\Test\API;

use PayMaya\API\Checkout;
use PayMaya\Test\Model\Checkout\BuyerTest;
use PayMaya\Test\Model\Checkout\ItemTest;
use PayMaya\Test\Model\Checkout\ItemAmountTest;

class CheckoutTest extends \PHPUnit_Framework_TestCase
{
	public static function getObject()
	{
		$checkout = new Checkout();
		$checkout->buyer = BuyerTest::getObject();
		$checkout->items = array(ItemTest::getObject());
		$checkout->totalAmount = ItemAmountTest::getObject();
		$checkout->requestReferenceNumber = "123456789";
		$checkout->redirectUrl = array(
			"success" => "https://shop.com/success",
			"failure" => "https://shop.com/failure",
			"cancel" => "https://shop.com/cancel"
			);
		return $checkout;
	}

	public function testInitialization()
	{
		$obj = self::getObject();
		$this->assertEquals($obj->buyer, BuyerTest::getObject());
		$this->assertEquals($obj->items, array(ItemTest::getObject()));
		$this->assertEquals($obj->totalAmount, ItemAmountTest::getObject());
		$this->assertEquals($obj->requestReferenceNumber, "123456789");
		$this->assertEquals($obj->redirectUrl, array(
			"success" => "https://shop.com/success",
			"failure" => "https://shop.com/failure",
			"cancel" => "https://shop.com/cancel"
			));
		return $obj;
	}

	/**
	 * @depends testInitialization
	 */
	public function testExecute($obj)
	{
		$obj->execute();
		$this->assertNotNull($obj->id);
		$this->assertNotNull($obj->url);
		return $obj;
	}

	/**
	 * @depends testExecute
	 */
	public function testRetrieve($obj)
	{
		$obj->retrieve();
		$this->assertNotNull($obj->status);
		$this->assertNotNull($obj->paymentType);
		$this->assertNotNull($obj->transactionReferenceNumber);
		$this->assertNotNull($obj->receiptNumber);
		$this->assertNotNull($obj->paymentStatus);
		$this->assertNotNull($obj->voidStatus);
		$this->assertNotNull($obj->metadata);
	}
}
