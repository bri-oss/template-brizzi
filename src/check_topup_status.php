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

// change variables accordingly
$partnerId = 'feedloop'; //partner id
$channelId = '12345'; // channel id

$getAccessToken = new GetAccessToken();

$accessToken = $getAccessToken->getBRIAPI(
  $clientId,
  $clientSecret,
  $baseUrl
);

$timestamp = (new DateTime('now', new DateTimeZone('Asia/Jakarta')))->format('Y-m-d\TH:i:s.000P');

$directDebit = new Brizzi();

$response = $directDebit->checkTopupStatus(
  $clientSecret = $clientSecret, 
  $partnerId = $partnerId,
  $baseUrl,
  $accessToken, 
  $channelId,
  $timestamp
);

echo $response;
