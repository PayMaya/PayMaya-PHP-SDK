# PayMaya-PHP-SDK

PayMaya PHP SDK allows your web applications to accept payments from your customers using any MasterCard and Visa enabled card (credit, debit, or prepaid).

[![Code Climate](https://codeclimate.com/github/PayMaya/PayMaya-PHP-SDK/badges/gpa.svg)](https://codeclimate.com/github/PayMaya/PayMaya-PHP-SDK)

## Prerequisites

* PHP 5.3 or above
* [curl[(http://php.net/manual/en/book.curl.php), [json](http://php.net/manual/en/book.json.php) & [openssl](http://php.net/manual/en/book.openssl.php) extensions must be enabled

Tests
* phpunit/phpunit: 4.8.*


## Installation

* Via Composer
```sh
composer require PayMaya/PayMaya-SDK:*
```

* Direct Download

Download zip file starting with PayMaya-PHP-SDK-*.zip from Releases Section

## Prerequisites

#### _API Keys_
To use PayMaya PHP SDK, you need to have a different API key for Sandbox and Production environment.
 
##### _Sandbox Environment_
 
Sandbox credentials are useful for testing application integration. All transactions and money flow made in this environment are only simulated and does not reflect your production records. The following sandbox API key can be used for testing purposes:

 ```
Public-facing API Key: pk-iaioBC2pbY6d3BVRSebsJxghSHeJDW4n6navI7tYdrN

Secret API Key: sk-uh4ZFfx9i0rZpKN6CxJ826nVgJ4saGGVAH9Hk7WrY6Q
```
 
##### _Production Environment_
 
Upon successful integration testing, you can then request for production credentials. Upon receipt, just change your SDK initialization to use production environment to start accepting live transactions.

## Usage



## Summary
* These docs in the SDK include an overview of usage, step-by-step integration instructions, and sample code.
* A sample app is included in the sample folder in the project.
* [Checkout API Documentation](https://developers.paymaya.com/blog/entry/paymaya-checkout-api-overview) and [Payments API Documentation](https://developers.paymaya.com/docs/e/payments) are currently available which cover error codes and server-side integration instructions.

## Contribution
   * If you would like to contribute, please fork the repo and send in a pull request.
