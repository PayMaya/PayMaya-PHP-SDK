<?php

namespace PayMaya;

class PayMayaSDK
{
	private static $instance;

	private $checkoutAPIKey;
	private $checkoutEnvironment;
	private $paymentsAPIKey;
	private $paymentsEnvironment;

	public static function getInstance()
	{
		if (!isset(self::instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function initCheckout($apiKey = null, $environment = "SANDBOX")
	{
		$this->checkoutAPIKey = $apiKey;
		$this->checkoutEnvironment = $environment;
	}

	public function initPayments($apiKey = null, $environment = "SANDBOX")
	{
		$this->paymentsAPIKey = $apiKey;
		$this->paymentsEnvironment = $environment;
	}

	protected function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}