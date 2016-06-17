<?php

namespace PayMaya\API;

use PayMaya\Core\APIManager;

class Checkout
{
	private $checkoutId;
	private $redirectUrl;

	public $buyer;
	public $items;
	public $totalAmount;
	public $requestReferenceNumber;

	private $apiManager;

	public function __construct()
	{
		$this->apiManager = new APIManager();
	}

	public function execute()
	{
		$checkoutInformation = json_decode(json_encode($this), true);
		$response = $this->apiManager->executeCheckout($checkoutInformation);
		$responseArr = json_decode($response, true);

		$this->checkoutId = $responseArr["checkoutId"];
		$this->redirectUrl = $responseArr["redirectUrl"];
		
		return $response;
	}

	public function getCheckoutId() 
	{
		return $this->checkoutId;
	}

	public function getRedirectUrl() 
	{
		return $this->redirectUrl;
	}
}