<?php

require 'utils.php';

// url path values
$baseUrl = 'https://sandbox.partner.api.bri.co.id'; //base url

try {
  list($clientId, $clientSecret) = getCredentials();

  $accessToken = getAccessToken(
    $clientId,
    $clientSecret,
    $baseUrl
  );

  $timestamp = getTimestamp();

  $username = filter_var('', FILTER_SANITIZE_STRING);
  $brizziCardNo = filter_var('', FILTER_SANITIZE_STRING);
  $amount = filter_var('', FILTER_SANITIZE_STRING); //eg: '1000.00'

  $validateInputs = sanitizeInput([
    'username' => $username,
    'brizziCardNo' => $brizziCardNo,
    'amount' => $amount
  ]);

  $body = [
    'username' => $validateInputs['username'],
    'brizziCardNo' => $validateInputs['brizziCardNo'],
    'amount' => $validateInputs['amount']
  ];

  $response = fetchTopupDeposit(
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
