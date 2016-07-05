<?php

namespace PayMaya\API;

use PayMaya\Core\CheckoutAPIManager;

class Customization
{
	public $logoUrl;
	public $iconUrl;
	public $appleTouchIconUrl;
	public $customTitle;
	public $colorScheme;

	public function __construct()
	{
		$this->apiManager = new CheckoutAPIManager();
	}

	public function set()
	{
		$customizationInfo = json_decode(json_encode($this), true);
		$response = $this->apiManager->setCustomization($customizationInformation);
		$responseArr = json_decode($response, true);
		
		return $response;
	}

	public function get()
	{
		$response = $this->apiManager->getCustomization();
		$responseArr = json_decode($response, true);
		
		return $response;
	}

	public function remove()
	{
		$response = $this->apiManager->removeCustomization();
		$responseArr = json_decode($response, true);
		
		return $response;
	}
}
