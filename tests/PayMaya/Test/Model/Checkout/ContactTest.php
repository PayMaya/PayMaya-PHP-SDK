<?php

namespace PayMaya\Test\Model\Checkout;

use PayMaya\Model\Checkout\Contact;

class ContactTest extends \PHPUnit_Framework_TestCase
{
	public static function getObject()
	{
		$contact = new Contact();
		$contact->phone = "+63(2)1234567890";
		$contact->email = "paymayabuyer1@gmail.com";
		return $contact;
	}

	public function testInitialization()
	{
		$obj = self::getObject();
		$this->assertEquals($obj->phone, "+63(2)1234567890");
		$this->assertEquals($obj->email, "paymayabuyer1@gmail.com");
	}
}
