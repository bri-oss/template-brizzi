<?php

require __DIR__ . '/../vendor/autoload.php';

Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/..' . '')->load();

require __DIR__ . '/../../briapi-sdk/autoload.php';

use BRI\Brizzi\Brizzi;
use BRI\Util\GetAccessToken;

$clientId = $_ENV['CONSUMER_KEY']; // customer key
$clientSecret = $_ENV['CONSUMER_SECRET']; // customer secret

// url path values
$baseUrl = 'https://sandbox.partner.api.bri.co.id'; //base url

$getAccessToken = new GetAccessToken();

$accessToken = $getAccessToken->getBRIAPI(
  $clientId,
  $clientSecret,
  $baseUrl
);

$date = new DateTime("now", new DateTimeZone("UTC"));

$timestamp = $date->format('Y-m-d\TH:i:s') . '.' . substr($date->format('u'), 0, 3) . 'Z';

$username = 'test';
$brizziCardNo = '6013500601496673';
$amount = '1000.00';
$reff = '279424"';

$body = [
  'username' => $username,
  'brizziCardNo' => $brizziCardNo,
  'amount' => $amount,
  'reff' => $reff
];

$directDebit = new Brizzi();

$response = $directDebit->checkTopupStatus(
  $clientSecret = $clientSecret, 
  $baseUrl,
  $accessToken,
  $timestamp,
  $body
);

echo $response;
