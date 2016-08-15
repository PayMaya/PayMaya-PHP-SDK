<?php

namespace PayMaya;

class PayMayaSDK
{
	private static $instance;

	private $checkoutPublicApiKey;
	private $checkoutSecretApiKey;
	private $checkoutEnvironment;

	private $paymentsPublicApiKey;
	private $paymentsSecretApiKey;
	private $paymentsEnvironment;

	public static function getInstance()
	{
		if (null == self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function initCheckout($publicApiKey = null, $secretApiKey = null, $environment = "SANDBOX")
	{
		$this->checkoutPublicApiKey = $publicApiKey;
		$this->checkoutSecretApiKey = $secretApiKey;
		$this->checkoutEnvironment = $environment;
	}

	public function initPayments($publicApiKey = null, $secretApiKey = null, $environment = "SANDBOX")
	{
		$this->paymentsPublicApiKey = $publicApiKey;
		$this->paymentsSecretApiKey = $secretApiKey;
		$this->paymentsEnvironment = $environment;
	}

	public function getCheckoutPublicApiKey() 
	{
		return $this->checkoutPublicApiKey;
	}

	public function getCheckoutSecretApiKey() 
	{
		return $this->checkoutSecretApiKey;
	}

	public function getCheckoutEnvironment()
	{
		return $this->checkoutEnvironment;
	}

	public function getPaymentsPublicApiKey() 
	{
		return $this->paymentsPublicApiKey;
	}

	public function getPaymentsSecretApiKey() 
	{
		return $this->paymentsSecretApiKey;
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
