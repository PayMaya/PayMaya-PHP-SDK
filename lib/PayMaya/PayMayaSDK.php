<?php

namespace PayMaya;

class PayMayaSDK
{
	private static $instance;

	private $checkoutPublicAPIKey;
	private $checkoutSecretAPIKey;
	private $checkoutEnvironment;

	private $paymentsPublicAPIKey;
	private $paymentsSecretAPIKey;
	private $paymentsEnvironment;

	public static function getInstance()
	{
		if (null == self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function initCheckout($publicAPIKey = null, $secretAPIKey = null, $environment = "SANDBOX")
	{
		$this->checkoutPublicAPIKey = $publicAPIKey;
		$this->checkoutSecretAPIKey = $secretAPIKey;
		$this->checkoutEnvironment = $environment;
	}

	public function initPayments($publicAPIKey = null, $secretAPIKey = null, $environment = "SANDBOX")
	{
		$this->paymentsPublicAPIKey = $publicAPIKey;
		$this->paymentsSecretAPIKey = $secretAPIKey;
		$this->paymentsEnvironment = $environment;
	}

	public function getCheckoutPublicAPIKey() 
	{
		return $this->checkoutPublicAPIKey;
	}

	public function getCheckoutSecretAPIKey() 
	{
		return $this->checkoutSecretAPIKey;
	}

	public function getCheckoutEnvironment()
	{
		return $this->checkoutEnvironment;
	}

	public function getPaymentsPublicAPIKey() 
	{
		return $this->paymentsPublicAPIKey;
	}

	public function getPaymentsSecretAPIKey() 
	{
		return $this->paymentsSecretAPIKey;
	}

	public function getPaymentsEnvironment()
	{
		return $this->paymentsEnvironment;
	}

	protected function __construct()
	{
	}

	private function __clone()
	{
	}
}
