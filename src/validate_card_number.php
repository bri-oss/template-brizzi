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

  $validateInputs = sanitizeInput([
    'username' => $username,
    'brizziCardNo' => $brizziCardNo
  ]);

  // body
  $body = [
    'username' => $validateInputs['username'],
    'brizziCardNo' => $validateInputs['brizziCardNo']
  ];

  $response = fetchValidateCardNumber(
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
