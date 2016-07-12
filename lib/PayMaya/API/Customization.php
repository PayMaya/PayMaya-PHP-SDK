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

	private $apiManager;

	public function __construct()
	{
		$this->apiManager = new CheckoutAPIManager();
	}

	public function set()
	{
		$customizationInformation = json_decode(json_encode($this), true);
		$response = $this->apiManager->setCustomization($customizationInformation);
		$responseArr = json_decode($response, true);

		$this->logoUrl = $responseArr["logoUrl"];
		$this->iconUrl = $responseArr["iconUrl"];
		$this->appleTouchIconUrl = $responseArr["appleTouchIconUrl"];
		$this->customTitle = $responseArr["customTitle"];
		$this->colorScheme = $responseArr["colorScheme"];

		return $response;
	}

	public function get()
	{
		$response = $this->apiManager->getCustomization();
		$responseArr = json_decode($response, true);

		$this->logoUrl = $responseArr["logoUrl"];
		$this->iconUrl = $responseArr["iconUrl"];
		$this->appleTouchIconUrl = $responseArr["appleTouchIconUrl"];
		$this->customTitle = $responseArr["customTitle"];
		$this->colorScheme = $responseArr["colorScheme"];
		
		return $response;
	}

	public function remove()
	{
		$response = $this->apiManager->removeCustomization();
		
		$this->logoUrl = null;
		$this->iconUrl = null;
		$this->appleTouchIconUrl = null;
		$this->customTitle = null;
		$this->colorScheme = null;

		return $response;
	}
}
