<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../../briapi-sdk/autoload.php';

Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/..')->load();

use BRI\Brizzi\Brizzi;
use BRI\Util\GetAccessToken;

$clientId = $_ENV['CONSUMER_KEY'] ?? null; // customer key
$clientSecret = $_ENV['CONSUMER_SECRET'] ?? null; // customer secret

if (!$clientId || !$clientSecret) {
  die('Missing client credentials in environment variables.');
}

// url path values
$baseUrl = 'https://sandbox.partner.api.bri.co.id'; //base url

try {
  $getAccessToken = new GetAccessToken();

  $accessToken = $getAccessToken->getBRIAPI(
    $clientId,
    $clientSecret,
    $baseUrl
  );

  if (!$accessToken) {
    throw new Exception('Failed to retrieve access token.');
  }

  $date = new DateTime("now", new DateTimeZone("UTC"));

  $timestamp = $date->format('Y-m-d\TH:i:s') . '.' . substr($date->format('u'), 0, 3) . 'Z';

  $username = filter_var('', FILTER_SANITIZE_STRING);
  $brizziCardNo = filter_var('', FILTER_SANITIZE_STRING);
  $amount = filter_var('', FILTER_SANITIZE_STRING);
  $reff = filter_var('', FILTER_SANITIZE_STRING);

  if (
    empty($username) || 
    empty($brizziCardNo) || 
    empty($amount) || 
    empty($reff)) {
    throw new Exception('Invalid input parameter variables');
  }

  $body = [
    'username' => $username,
    'brizziCardNo' => $brizziCardNo,
    'amount' => $amount,
    'reff' => $reff
  ];

  $directDebit = new Brizzi();

  $response = $directDebit->checkTopupStatus(
    $clientSecret, 
    $baseUrl,
    $accessToken,
    $timestamp,
    $body
  );

  echo $response;
} catch (Exception $e) {
  echo 'Error: ' . $e->getMessage();
  exit(1);
}
