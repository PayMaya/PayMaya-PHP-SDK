<?php

namespace PayMaya\Core;

use PayMaya\PayMayaSDK;
use PayMaya\Core\HTTPConfig;
use PayMaya\Core\HTTPConnection;
use PayMaya\Core\Constants;

class CheckoutAPIManager
{
	private $publicAPIKey;
	private $secretAPIKey;
	private $environment;
	private $baseUrl;
	private $httpHeaders;

	public function __construct()
	{
		$this->publicAPIKey = PayMayaSDK::getInstance()->getCheckoutPublicAPIKey();
		$this->secretAPIKey = PayMayaSDK::getInstance()->getCheckoutSecretAPIKey();
		$this->environment = PayMayaSDK::getInstance()->getCheckoutEnvironment();
		$this->baseUrl = $this->getBaseUrl();
		$this->httpHeaders = array("Content-Type" => "application/json");
	}

	private function getBaseUrl()
	{
		$baseUrl = null;
		switch ($this->environment) {
			case "PRODUCTION":
				$baseUrl = Constants::CHECKOUT_PRODUCTION_URL;
				break;
			default:
				$baseUrl = Constants::CHECKOUT_SANDBOX_URL;
		}
		return $baseUrl;
	}

	private function getAuthorizationToken($apiKey)
	{
		return base64_encode($apiKey . ":");
	}

	public function initiateCheckout($checkoutInformation) 
	{
		$authorizationToken = $this->getAuthorizationToken($this->publicAPIKey);
		$this->httpHeaders["Authorization"] = "Basic " . $authorizationToken;
		$httpConfig = new HTTPConfig($this->baseUrl . "/v1/checkouts", 
									 "POST",
									 $this->httpHeaders
									 );
		$httpConnection = new HTTPConnection($httpConfig);
		$payload = json_encode($checkoutInformation);
		$response = $httpConnection->execute($payload);
		return $response;
	}
}
