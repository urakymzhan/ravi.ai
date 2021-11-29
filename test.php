<?php
require 'vendor/autoload.php';

\Stripe\Stripe::setApiKey('sk_test_51J5AfnJLX2O2x8S9L6mqe6GoOVO61uUb7QlIDEuWbbIAOA12S4hfrPdVthxsxap89Kq6hrpOWCWhVzvZXI75Vjpg002EKYxAjO');


$total = 10000;


try {
  $paymentIntent = \Stripe\PaymentIntent::create([
   'payment_method_types' => ['card'],
    'amount' => 1999,
    'currency' => 'usd',
  ]);

} catch (Error $e) {
  http_response_code(500);
 
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Apple Pay</title>
    <!--<link rel="stylesheet" href="css/base.css" />-->
    <script src="https://js.stripe.com/v3/"></script>
    <!--<script src="./utils.js"></script>-->
    <script>
      document.addEventListener('DOMContentLoaded', async () => {
        // 1. Initialize Stripe
        const stripe = Stripe('pk_test_51J5AfnJLX2O2x8S9euFdx7ZxhC09d7YwTGoWXZdpLGkawzyszY9FKgIpdRevK5nFvh2qdywRgFJxBc7czmq1DoWt00HSX3GSBd');

        // 2. Create a payment request object
        var paymentRequest = stripe.paymentRequest({
          currency: 'usd',
          country: 'US',
          requestPayerName: true,
          requestPayerEmail: true,
          total: {
            label: 'Demo total',
            amount: 1999,
          },
        });

        // 3. Create a PaymentRequestButton element
        const elements = stripe.elements();
        const prButton = elements.create('paymentRequestButton', {
          paymentRequest: paymentRequest,
        });

        // Check the availability of the Payment Request API,
        // then mount the PaymentRequestButton
        paymentRequest.canMakePayment().then(function (result) {
          if (result) {
            prButton.mount('#payment-request-button');
          } else {
            document.getElementById('payment-request-button').style.display = 'none';
            console.log('Apple Pay support not found. Check the pre-requisites above and ensure you are testing in a supported browser.');
          }
        });

        paymentRequest.on('paymentmethod', async (e) => {
          // Make a call to the server to create a new
          // payment intent and store its client_secret.
          console.log(`Client secret returned.`);
          let clientSecret = '<?= $paymentIntent->client_secret; ?>';

          // Confirm the PaymentIntent without handling potential next actions (yet).
          let {error, paymentIntent} = await stripe.confirmCardPayment(
            clientSecret,
            {
              payment_method: e.paymentMethod.id,
            },
            {
              handleActions: false,
            }
          );

          if (error) {
            console.log(error.message);

            // Report to the browser that the payment failed, prompting it to
            // re-show the payment interface, or show an error message and close
            // the payment interface.
            e.complete('fail');
            return;
          }
          // Report to the browser that the confirmation was successful, prompting
          // it to close the browser payment method collection interface.
          e.complete('success');

          // Check if the PaymentIntent requires any actions and if so let Stripe.js
          // handle the flow. If using an API version older than "2019-02-11" instead
          // instead check for: `paymentIntent.status === "requires_source_action"`.
          if (paymentIntent.status === 'requires_action') {
            // Let Stripe.js handle the rest of the payment flow.
            let {error, paymentIntent} = await stripe.confirmCardPayment(
              clientSecret
            );
            if (error) {
              // The payment failed -- ask your customer for a new payment method.
              console.log("sdf "+error.message);
              return;
            }
            console.log(`Payment ${paymentIntent.status}: ${paymentIntent.id}`);
          }

          console.log(`Payment ${paymentIntent.status}: ${paymentIntent.id}`);
        });

      });
    </script>
  </head>
  <body>
    <main>
      <a href="/">home</a>
      <h1>Apple Pay</h1>

      <p>
        Before you start, you need to:
        <ul>
          <li><a href="https://stripe.com/docs/stripe-js/elements/payment-request-button#html-js-testing" target="_blank">Add a payment method to your browser.</a> For example, add a card to your Wallet for Safari.</li>
          <li>Serve your application over HTTPS. This is a requirement both in development and in production. One way to get up and running is to use a service like <a href="https://ngrok.com/" target="_blank">ngrok</a>.</li>
          <li><a href="https://stripe.com/docs/stripe-js/elements/payment-request-button#verifying-your-domain-with-apple-pay" target="_blank">Verify your domain with Apple Pay</a>, both in development and production.</li>
        </ul>
      </p>

      <a href="https://stripe.com/docs/stripe-js/elements/payment-request-button" target="_blank">Stripe Documentation</a>

      <div id="payment-request-button">
        <!-- A Stripe Element will be inserted here if the browser supports this type of payment method. -->
      </div>

      <div id="messages" role="alert" style="display: none;"></div>
    </main>
  </body>
</html>
