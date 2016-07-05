<?php

namespace PayMaya\API;

class Webhook
{
	const SUCCESS = "CHECKOUT_SUCCESS";
	const FAILURE = "CHECKOUT_FAILURE";

	private $apiManager;

	private $id;

	public $name;
	public $callbackUrl;


}
