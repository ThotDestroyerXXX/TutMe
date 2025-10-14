<?php
require_once('vendor/autoload.php');

$client = new \GuzzleHttp\Client();

$response = $client->request('POST', 'https://app.sandbox.midtrans.com/snap/v1/transactions', [
  'body' => '{"transaction_details":{"order_id":"order-id","gross_amount":10000},"credit_card":{"secure":true}}',
  'headers' => [
    'accept' => 'application/json',
    'authorization' => 'Basic TWlkLXNlcnZlci1tM3JtM2VYRDNPZmlkeEd2Q0hiNU1Zako6',
    'content-type' => 'application/json',
  ],
]);

echo $response->getBody();