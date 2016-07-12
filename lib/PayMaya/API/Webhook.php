<?php

namespace PayMaya\API;

use PayMaya\Core\CheckoutAPIManager;

class Webhook
{
	const CHECKOUT_SUCCESS = "CHECKOUT_SUCCESS";
	const CHECKOUT_FAILURE = "CHECKOUT_FAILURE";

	public $id;
	public $name;
	public $callbackUrl;

	private $apiManager;

	public function __construct()
	{
		$this->apiManager = new CheckoutAPIManager();
	}

	public static function retrieve()
	{
		$apiManager = new CheckoutAPIManager();
		$response = $apiManager->retrieveWebhook();
		$responseArr = json_decode($response, true);
		$webhooks = array();
		foreach ($responseArr as $webhookInfo) {
			$webhook = new Webhook();
			$webhook->id = $webhookInfo["id"];
			$webhook->name = $webhookInfo["name"];
			$webhook->callbackUrl = $webhookInfo["callbackUrl"];
			$webhooks[] = $webhook;
		}
		return $webhooks;
	}

	public function register()
	{
		$webhookInformation = json_decode(json_encode($this), true);
		$response = $this->apiManager->registerWebhook($webhookInformation);
		$responseArr = json_decode($response, true);

		$this->id = $responseArr["id"];

		return $response;
	}

	public function update()
	{
		$webhookInformation = json_decode(json_encode($this), true);
		$response = $this->apiManager->updateWebhook($this->id, $webhookInformation);
		$responseArr = json_decode($response, true);

		$this->id = $responseArr["id"];
		$this->name = $responseArr["name"];
		$this->callbackUrl = $responseArr["callbackUrl"];

		return $response;
	}

	public function delete()
	{
		$response = $this->apiManager->deleteWebhook($this->id);

		$this->id = null;
		$this->name = null;
		$this->callbackUrl = null;

		return $response;
	}
}
