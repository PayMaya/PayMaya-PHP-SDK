<?php

namespace PayMaya\API;

use PayMaya\Core\CheckoutAPIManager;

class Checkout
{
	public $id;
	public $url;
	public $buyer;
	public $items;
	public $totalAmount;
	public $requestReferenceNumber;
	public $redirectUrl;
	public $status;
	public $paymentType;
	public $paymentStatus;
	public $metadata;

	private $apiManager;

	public function __construct()
	{
		$this->apiManager = new CheckoutAPIManager();
	}

	public function initiate()
	{
		$checkoutInformation = json_decode(json_encode($this), true);
		$response = $this->apiManager->initiateCheckout($checkoutInformation);
		$responseArr = json_decode($response, true);

		$this->id = $responseArr["checkoutId"];
		$this->url = $responseArr["redirectUrl"];
		
		return $response;
	}

	public function retrieve()
	{
		$response = $this->apiManager->retrieveCheckout($this->id);

		return $response;
	}
}
