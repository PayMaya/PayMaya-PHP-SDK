<?php

namespace PayMaya\Core;

use PayMaya\PayMayaSDK;
use PayMaya\Core\HTTPConfig;
use PayMaya\Core\HTTPConnection;
use PayMaya\Core\Constants;

class APIManager
{
	// protected static $publicAPIKey;
	// protected static $secretAPIKey;

	public function executeCheckout($checkoutInformation) 
	{
		$clientKey = PayMayaSDK::getInstance()->getCheckoutPublicAPIKey();
		$clientSecret = "";
		$environment = PayMayaSDK::getInstance()->getCheckoutEnvironment();

		$authorizationToken = base64_encode($clientKey . ":" . $clientSecret);

		$checkoutURL = null;
		switch ($environment) {
			case "PRODUCTION":
				$checkoutURL = Constants::CHECKOUT_PRODUCTION_URL;
				break;
			default:
				$checkoutURL = Constants::CHECKOUT_SANDBOX_URL;
		}

		$httpConfig = new HTTPConfig($checkoutURL . "/v1/checkouts", 
									 "POST",
									 array(
										"Content-Type" => "application/json",
										"Authorization" => "Basic " . $authorizationToken
									));

		$httpConnection = new HTTPConnection($httpConfig);
		$payload = json_encode($checkoutInformation);
		$response = $httpConnection->execute($payload);

		return $response;
	}
}
