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

// body
$body = [
  'username' => $username,
  'brizziCardNo' => $brizziCardNo
];

$directDebit = new Brizzi();

$response = $directDebit->validateCardNumber(
  $clientSecret = $clientSecret, 
  $baseUrl,
  $accessToken,
  $timestamp,
  $body
);

echo $response;
