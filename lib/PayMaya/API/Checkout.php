<?php

namespace PayMaya\API;

use PayMaya\Core\CheckoutAPIManager;

class Checkout
{
	private $apiManager;

	private $id;
	private $url;
	private $status;
	private $paymentType;
	private $paymentStatus;
	private $metadata;

	public $buyer;
	public $items;
	public $totalAmount;
	public $requestReferenceNumber;
	public $redirectUrl;

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

	}

	public function getId() 
	{
		return $this->id;
	}

	public function getUrl() 
	{
		return $this->url;
	}
}
