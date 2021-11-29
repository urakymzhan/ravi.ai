$(document).ready(function() {
    const stripe = Stripe("pk_test_51J5AfnJLX2O2x8S9euFdx7ZxhC09d7YwTGoWXZdpLGkawzyszY9FKgIpdRevK5nFvh2qdywRgFJxBc7czmq1DoWt00HSX3GSBd");
    var fname, lname, rank;

    fetch("create.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },

        })
        .then(function(result) {
            return result.json();
        })
        .then(function(data) {
            var elements = stripe.elements();

            var style = {
                base: {
                    color: "#32325d",
                    fontFamily: 'Arial, sans-serif',
                    fontSmoothing: "antialiased",
                    height: '100px',
                    "::placeholder": {
                        color: "#32325d"
                    }
                },
                invalid: {
                    fontFamily: 'Arial, sans-serif',
                    color: "#fa755a",
                    iconColor: "#fa755a"
                }
            };

            var card = elements.create("cardNumber", { style: style });
            card.mount("#card-number");
            card.on("change", function(event) {
                document.querySelector("#card-error").textContent = event.error ? event.error.message : "";
            });

            var cardExp = elements.create("cardExpiry", { style: style });
            cardExp.mount("#card-expiry");

            cardExp.on("change", function(event) {
                document.querySelector("#card-error").textContent = event.error ? event.error.message : "";
            });

            var cardCvc = elements.create("cardCvc", { style: style });
            cardCvc.mount("#card-cvc");

            cardCvc.on("change", function(event) {
                document.querySelector("#card-error").textContent = event.error ? event.error.message : "";
            });

            $('.submit').click(function() {
                fname = $('.fname').val();
                lname = $('.lname').val();
                rank = $(this).data('rank');

                if (fname != "" && lname != "") {
                    payWithCard(stripe, card, data.clientSecret);
                } else {
                    $('#card-error').html('All fields are required');
                }
            });
        });

    var payWithCard = function(stripe, card, clientSecret) {
        stripe.confirmCardPayment(clientSecret, {
                payment_method: {
                    card: card
                },

            })
            .then(function(result) {
                if (result.error) {
                    showError(result.error.message);
                } else {
                    orderComplete(result);
                }
            });
    };


    var orderComplete = function(result) {

        let payment_status = result.paymentIntent.status;
        console.log(result);
        if (payment_status == "succeeded") {
            $.ajax({
                url: 'server.php',
                type: 'POST',
                data: {
                    action: 'pay',
                    rank: rank,
                    payment_method: 'visa',
                    fname: fname,
                    lname: lname,
                    payment_status: payment_status,
                    payment_id: result.paymentIntent.id,
                    payment_amount: result.paymentIntent.amount
                },
                success: function(res) {
                    swal({
                        title: "Good job!",
                        text: "Successfully submitted!",
                        type: "success",
                        confirmButtonColor: '#65DFDE',
                        confirmButtonText: 'OK!',
                    }, function(isConfirm) {
                        if (isConfirm) {
                            window.location.href = `index3.php`;
                        }
                    });
                }
            });
        } else {
            console.log(result.paymentIntent.status);
        }
    };

    var showError = function(errorMsgText) {
        var errorMsg = document.querySelector("#card-error");
        errorMsg.textContent = errorMsgText;
        setTimeout(function() {
            errorMsg.textContent = "";
        }, 4000);
    };
    // Apple Pay 
    fetch("create.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },

        })
        .then(function(result) {
            return result.json();
        })
        .then(function(data) {
            // 
            // 1. Initialize Stripe

            // 2. Create a payment request object
            var paymentRequest = stripe.paymentRequest({
                currency: 'usd',
                country: 'US',
                requestPayerName: true,
                requestPayerEmail: true,
                total: {
                    label: 'Demo total',
                    amount: 100,
                },
            });

            // 3. Create a PaymentRequestButton element
            const elements = stripe.elements();
            const prButton = elements.create('paymentRequestButton', {
                paymentRequest: paymentRequest,
            });

            // Check the availability of the Payment Request API,
            // then mount the PaymentRequestButton
            paymentRequest.canMakePayment().then(function(result) {
                if (result) {
                    prButton.mount('#payment-request-button');
                } else {
                    document.getElementById('payment-request-button').style.display = 'none';
                    $('.apple_btn').append("<p>Your browser does not support Apple Pay / Wallet not connected</p>");
                    console.log('Apple Pay support not found. Check the pre-requisites above and ensure you are testing in a supported browser.');
                }
            });

            paymentRequest.on('paymentmethod', async(e) => {
                // Make a call to the server to create a new
                // payment intent and store its client_secret.
                console.log(`Client secret returned.`);
                let clientSecret = data.clientSecret;

                // Confirm the PaymentIntent without handling potential next actions (yet).
                let { error, paymentIntent } = await stripe.confirmCardPayment(
                    clientSecret, {
                        payment_method: e.paymentMethod.id,
                    }, {
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
                    let { error, paymentIntent } = await stripe.confirmCardPayment(
                        clientSecret
                    );
                    if (error) {
                        // The payment failed -- ask your customer for a new payment method.
                        console.log("sdf " + error.message);
                        return;
                    }
                    console.log(`Payment ${paymentIntent.status}: ${paymentIntent.id}`);
                }
                // 
                fname = $('.fname').val();
                lname = $('.lname').val();
                rank = $('.data_rank').data('rank');
                $.ajax({
                    url: 'server.php',
                    type: 'POST',
                    data: {
                        action: 'pay',
                        rank: rank,
                        payment_method: 'apple_pay',
                        fname: fname,
                        lname: lname,
                        payment_status: paymentIntent.status,
                        payment_id: paymentIntent.id,
                        payment_amount: paymentIntent.id.amount
                    },
                    success: function(res) {
                        swal({
                            title: "Good job!",
                            text: "Successfully submitted!",
                            type: "success",
                            confirmButtonColor: '#65DFDE',
                            confirmButtonText: 'OK!',
                        }, function(isConfirm) {
                            if (isConfirm) {
                                window.location.href = `index3.php`;
                            }
                        });
                    }
                });
                // 

                console.log(`Payment ${paymentIntent.status}: ${paymentIntent.id}`);
            });


            // 

        });





});