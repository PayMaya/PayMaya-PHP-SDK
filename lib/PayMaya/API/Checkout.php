<?php

namespace PayMaya\API;

use PayMaya\Core\CheckoutAPIManager;

class Checkout
{
	// public $id;
	public $url;
	public $buyer;
	public $items;
	public $totalAmount;
	public $requestReferenceNumber;
	public $redirectUrl;
	// public $status;
	public $paymentType;
	public $transactionReferenceNumber;
	public $receiptNumber;
	public $paymentStatus;
	public $voidStatus;
	public $metadata;

	private $apiManager;

	public function __construct()
	{
		$this->apiManager = new CheckoutAPIManager();
	}

	public function execute()
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
		$responseArr = json_decode($response, true);

		$this->status = $responseArr["status"];
		$this->paymentType = $responseArr["paymentType"];
		$this->transactionReferenceNumber = $responseArr["transactionReferenceNumber"];
		$this->receiptNumber = $responseArr["receiptNumber"];
		$this->paymentStatus = $responseArr["paymentStatus"];
		$this->voidStatus = $responseArr["voidStatus"];
		$this->metadata = $responseArr["metadata"];

		return $response;
	}
}
