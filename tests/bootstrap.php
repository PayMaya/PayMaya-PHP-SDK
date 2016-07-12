<?php

$loader = require dirname(__DIR__) . '/vendor/autoload.php';
$loader->add('PayMaya\\Test', __DIR__);

require __DIR__ . "/../sample/autoload.php";

use PayMaya\PayMayaSDK;

PayMayaSDK::getInstance()->initCheckout("pk-iaioBC2pbY6d3BVRSebsJxghSHeJDW4n6navI7tYdrN", 
										"sk-uh4ZFfx9i0rZpKN6CxJ826nVgJ4saGGVAH9Hk7WrY6Q", 
										"SANDBOX");

error_reporting(E_ALL);
ini_set('display_errors', '1');
