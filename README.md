# PayMaya-PHP-SDK

PayMaya PHP SDK allows your web applications to accept payments from your customers using any MasterCard and Visa enabled card (credit, debit, or prepaid).

[![Code Climate](https://codeclimate.com/github/PayMaya/PayMaya-PHP-SDK/badges/gpa.svg)](https://codeclimate.com/github/PayMaya/PayMaya-PHP-SDK)

## Prerequisites

* PHP 5.3 or above
* [curl](http://php.net/manual/en/book.curl.php), [json](http://php.net/manual/en/book.json.php) & [openssl](http://php.net/manual/en/book.openssl.php) extensions must be enabled

Tests
* phpunit/phpunit: 4.8.*


## Installation

* Via Composer
```sh
composer require "paymaya/paymaya-sdk:*"
```

* Direct download

Integrate the SDK by cloning this repo (https://github.com/PayMaya/PayMaya-PHP-SDK) and manually adding it to your project. You can look at the sample directory to guide you on using the SDK

## Prerequisites

#### _API Keys_
To use PayMaya PHP SDK, you need to have a different API key for Sandbox and Production environment.
 
##### _Sandbox Environment_
 
Sandbox credentials are useful for testing application integration. All transactions and money flow made in this environment are only simulated and does not reflect your production records. Sandbox API keys are available in the following:

https://developers.paymaya.com/blog/entry/checkout-api-test-credit-card-account-numbers

##### _Production Environment_
 
Upon successful integration testing, contact us in the PayMaya Developers Portal to know more about the merchant onboarding process. Once you are onboarded, we will provide your production API credentials. Upon receipt, just change your SDK initialization to use production environment to start accepting live transactions.

## Usage

#### 1. Autoload the SDK. This will include all the files and classes to your autoloader. If you downloaded the SDK using composer, replace PayMaya-PHP-SDK with vendor.
```php
// Used for composer based installation
require __DIR__  . '/vendor/autoload.php';
// Use below for direct download installation
// require __DIR__  . '/PayMaya-PHP-SDK/autoload.php';
```

#### 2. Initialize SDK with public-facing API key, secret API key, and the intended environment ("SANDBOX" or "PRODUCTION)
```php
//
PayMayaSDK::getInstance()->initCheckout(<PUBLIC_API_KEY>, <SECRET_API_KEY>, <ENVIRONMENT>);
```

#### _Checkout_

##### 1. Create Checkout object
```php
// Checkout
$itemCheckout = new Checkout();
$user = new User();
$itemCheckout->buyer = $user->buyerInfo();

// Item
$itemAmountDetails = new ItemAmountDetails();
$itemAmountDetails->shippingFee = "14.00";
$itemAmountDetails->tax = "5.00";
$itemAmountDetails->subtotal = "50.00";
$itemAmount = new ItemAmount();
$itemAmount->currency = "PHP";
$itemAmount->value = "69.00";
$itemAmount->details = $itemAmountDetails;
$item = new Item();
$item->name = "Leather Belt";
$item->code = "pm_belt";
$item->description = "Medium-sized belt made from authentic leather";
$item->quantity = "1";
$item->amount = $itemAmount;
$item->totalAmount = $itemAmount;

$itemCheckout->items = array($item);
$itemCheckout->totalAmount = $itemAmount;
$itemCheckout->requestReferenceNumber = "123456789";
$itemCheckout->redirectUrl = array(
	"success" => "https://shop.com/success",
	"failure" => "https://shop.com/failure",
	"cancel" => "https://shop.com/cancel"
	);
```

##### 2. Checkout methods
* Execute Checkout - Method will assign checkout ID and checkout URL to checkout object. Use the checkout URL to redirect the buyer to Checkout page.
```php
$itemCheckout->execute();

echo $itemCheckout->id // Checkout ID
echo $itemCheckout->url // Checkout URL
```

* Retrieve Checkout - Method will assign all available checkout information to the object give checkout ID.
```php
$itemCheckout->retrieve();

/* The following properties will be populated
 *  $status
	*  $paymentType
	*  $transactionReferenceNumber
	*  $receiptNumber;
	*  $paymentStatus;
	*  $voidStatus;
	*  $metadata;
	*/
	
```

#### _Customization_
##### 1. Create Customization object
```php
<?php
$shopCustomization = new Customization();
$shopCustomization->logoUrl = "https://cdn.paymaya.com/production/checkout_api/customization_example/yourlogo.svg";
$shopCustomization->iconUrl = "https://cdn.paymaya.com/production/checkout_api/customization_example/youricon.ico";
$shopCustomization->appleTouchIconUrl = "https://cdn.paymaya.com/production/checkout_api/customization_example/youricon_ios.ico";
$shopCustomization->customTitle = "Checkout Page Title";
$shopCustomization->colorScheme = "#368d5c";
```

##### 2. Customization methods
* Set Customization - Used to set a merchant's checkout page customization.
```php
$shopCustomization->set();

echo "Logo URL: " . $shopCustomization->logoUrl . "\n";
// https://cdn.paymaya.com/production/checkout_api/customization_example/yourlogo.svg
echo "Icon URL: " . $shopCustomization->iconUrl . "\n";
// https://cdn.paymaya.com/production/checkout_api/customization_example/youricon.ico
echo "Apple Touch Icon URL: " . $shopCustomization->appleTouchIconUrl . "\n";
// https://cdn.paymaya.com/production/checkout_api/customization_example/youricon_ios.ico
echo "Custom Title: " . $shopCustomization->customTitle . "\n";
// Checkout Page Title
echo "Color Scheme: " . $shopCustomization->colorScheme . "\n";
// #368d5c
```

* Get Customization - Used to get a merchant's checkout page customization.
```php
$shopCustomization->get();

echo "Logo URL: " . $shopCustomization->logoUrl . "\n";
// https://cdn.paymaya.com/production/checkout_api/customization_example/yourlogo.svg
echo "Icon URL: " . $shopCustomization->iconUrl . "\n";
// https://cdn.paymaya.com/production/checkout_api/customization_example/youricon.ico
echo "Apple Touch Icon URL: " . $shopCustomization->appleTouchIconUrl . "\n";
// https://cdn.paymaya.com/production/checkout_api/customization_example/youricon_ios.ico
echo "Custom Title: " . $shopCustomization->customTitle . "\n";
// Checkout Page Title
echo "Color Scheme: " . $shopCustomization->colorScheme . "\n";
// #368d5c
```

* Remove Customization - Used to remove a merchant's checkout page customization.
```php
$shopCustomization->remove();

echo "Logo URL: " . $shopCustomization->logoUrl . "\n";
// null
echo "Icon URL: " . $shopCustomization->iconUrl . "\n";
// null
echo "Apple Touch Icon URL: " . $shopCustomization->appleTouchIconUrl . "\n";
// null
echo "Custom Title: " . $shopCustomization->customTitle . "\n";
// null
echo "Color Scheme: " . $shopCustomization->colorScheme . "\n";
// null
```

#### _Webhook_

##### 1. Create Webhook object
```php
$successWebhook = new Webhook();
$successWebhook->name = Webhook::CHECKOUT_SUCCESS;
$successWebhook->callbackUrl = "http://shop.someserver.com/success";
```

##### 2. Webhook methods
* Register webhook - Used to register an event-based webhook.
```php
$successWebhook->register();
```

* Update webhook - Used to update an existing event-based webhook.
```php
$successWebhook->callbackUrl .= "Updated";
$successWebhook->update();

// $successWebhook->callbackUrl = "http://shop.someserver.com/successUpdated"
```

* Delete webhook - Used to delete an existing webhook. You cannot undo this action.
```php
$successWebhook->delete();
```

* Retrieve webhooks - Used to retrieve the list of merchant registered webhooks.
```php
Webhook::retrieve();
```

## Summary
* These docs in the SDK include an overview of usage, step-by-step integration instructions, and sample code.
* A sample app is included in the sample folder in the project.
* [Checkout API Documentation](https://developers.paymaya.com/blog/entry/paymaya-checkout-api-overview) and [Payments API Documentation](https://developers.paymaya.com/docs/e/payments) are currently available which cover error codes and server-side integration instructions.

## Contribution
   * If you would like to contribute, please fork the repo and send in a pull request.
