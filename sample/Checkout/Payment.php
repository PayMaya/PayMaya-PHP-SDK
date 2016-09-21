<?php

require __DIR__ . "/../autoload.php";

use PayMaya\API\Payments;
use PayMaya\Model\Payment\Card;
use PayMaya\Model\Payment\Amount;
use PayMaya\Model\Payment\Buyer;

$key = '[KEY]';
$secret = '[SECRET]';
$card = new Card();
$card->number = '5123456789012346';
$card->cvc = '111';
$card->expM = '05';
$card->expY = '2017';

$payment = new Payments($key, $secret);
try {
    $payment->createToken($card);
} catch(\Exception $e) {
    die($e->getMessage());
}

$amount = new Amount();
$amount->total = 100;
//$amount->code = 'PHP'; // [ optional ] default value is PHP

$buyer = new Buyer();
$buyer->firstname = 'John';
$buyer->middlename = 'D.';
$buyer->lastname = 'Doe';
$buyer->phone = '639102626010';
$buyer->email = 'jdoe@example.com';
$buyer->address1 = '123 East Village';
//$buyer->address2 = '124 East Village'; // [ optional ]

$buyer->city = 'Makati City';
$buyer->state = 'Metro Manila';
$buyer->zip = '1216';
//$buyer->country = 'PHP' // [ optional ] default value is PHP

try {
    $pay = $payment->pay($buyer, $amount);
    print_r(json_decode($pay, true));
} catch(\Exception $e) {
    die($e->getMessage());
}
