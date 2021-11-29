<?php
require 'vendor/autoload.php';
\Stripe\Stripe::setApiKey('sk_test_51J5AfnJLX2O2x8S9L6mqe6GoOVO61uUb7QlIDEuWbbIAOA12S4hfrPdVthxsxap89Kq6hrpOWCWhVzvZXI75Vjpg002EKYxAjO');


$total = 10000;

// This is your real test secret API key.


// function calculateOrderAmount(array $items): int {

//   // return $total;
// }

header('Content-Type: application/json');

try {
  // retrieve JSON from POST body
//   $json_str = file_get_contents('php://input');
//   $json_obj = json_decode($json_str);

  $paymentIntent = \Stripe\PaymentIntent::create([
    // 'amount' => calculateOrderAmount($json_obj->items),
    'amount' => $total,
    'currency' => 'usd',
  ]);

  $output = [
    'clientSecret' => $paymentIntent->client_secret,
  ];

  echo json_encode($output);
} catch (Error $e) {
  http_response_code(500);
  echo json_encode(['error' => $e->getMessage()]);
}