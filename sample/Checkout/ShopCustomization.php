<?php

require __DIR__ . "/../autoload.php";

use PayMaya\PayMayaSDK;
use PayMaya\API\Customization;

PayMayaSDK::getInstance()->initCheckout("pk-iaioBC2pbY6d3BVRSebsJxghSHeJDW4n6navI7tYdrN", 
										"sk-uh4ZFfx9i0rZpKN6CxJ826nVgJ4saGGVAH9Hk7WrY6Q", 
										"SANDBOX");

$shopCustomization = new Customization();
$shopCustomization->get();
echo "Logo URL: " . $shopCustomization->logoUrl . "\n";
echo "Icon URL: " . $shopCustomization->iconUrl . "\n";
echo "Apple Touch Icon URL: " . $shopCustomization->appleTouchIconUrl . "\n";
echo "Custom Title: " . $shopCustomization->customTitle . "\n";
echo "Color Scheme: " . $shopCustomization->colorScheme . "\n";

$oldShopCustomization = clone $shopCustomization;

$shopCustomization->remove();
echo "Logo URL: " . $shopCustomization->logoUrl . "\n";
echo "Icon URL: " . $shopCustomization->iconUrl . "\n";
echo "Apple Touch Icon URL: " . $shopCustomization->appleTouchIconUrl . "\n";
echo "Custom Title: " . $shopCustomization->customTitle . "\n";
echo "Color Scheme: " . $shopCustomization->colorScheme . "\n";

$oldShopCustomization->set();
echo "Logo URL: " . $oldShopCustomization->logoUrl . "\n";
echo "Icon URL: " . $oldShopCustomization->iconUrl . "\n";
echo "Apple Touch Icon URL: " . $oldShopCustomization->appleTouchIconUrl . "\n";
echo "Custom Title: " . $oldShopCustomization->customTitle . "\n";
echo "Color Scheme: " . $oldShopCustomization->colorScheme . "\n";
