$(document).ready(function () {
  const selection = window.getSelection();
  const range = document.createRange();
  const textToCopy = document.getElementById('textToCopy');

  $('.method .method_box').each(function () {
    $(this)
      .find('.checkmark')
      .click(function () {
        if ($(this).hasClass('payment_method_visa')) {
          $('.card_info_form').slideDown();
          $('.paypal_button').slideUp();
          $('.apple_btn').slideUp();
          // apple_btn
        } else if ($(this).hasClass('payment_method_paypal')) {
          $('.paypal_button').slideDown();
          $('.card_info_form').slideUp();
          $('.apple_btn').slideUp();
        } else {
          $('.apple_btn').slideDown();
          $('.card_info_form').slideUp();
          $('.paypal_button').slideUp();
        }
      });
  });

  $('.reffral_link_clipboard').click(function (e) {
    range.selectNodeContents(textToCopy);
    selection.removeAllRanges();
    selection.addRange(range);
    const successful = document.execCommand('copy');
    if (successful) {
      console.log('Copied');
    }
  });
  $('.reffral_link_clipboard').mouseover(function () {
    $(this).tooltip('toggle');
  });

  // Paypal Payment
  function initPayPalButton() {
    paypal
      .Buttons({
        style: {
          shape: 'pill',
          color: 'blue',
          layout: 'horizontal',
          label: 'pay',
        },

        createOrder: function (data, actions) {
          return actions.order.create({
            purchase_units: [
              {
                amount: {
                  currency_code: 'USD',
                  value: 1000,
                },
              },
            ],
          });
        },

        onApprove: function (data, actions) {
          return actions.order.capture().then(function (orderData) {
            let rank = $('#user_rank').data('rank');
            let fname = orderData.payer.name.given_name;
            let lname = orderData.payer.name.surname;
            let payment_status = orderData.status;
            let payment_id = orderData.payer.payer_id;
            let payment_amount = orderData.purchase_units[0].amount.value;

            $.ajax({
              url: 'server.php',
              type: 'POST',
              data: {
                action: 'pay',
                rank: rank,
                payment_method: 'paypal',
                fname: fname,
                lname: lname,
                payment_status: payment_status,
                payment_id: payment_id,
                payment_amount: payment_amount * 100,
              },
              success: function (res) {
                swal(
                  {
                    title: 'Good job!',
                    text: 'Successfully submitted!',
                    type: 'success',
                    confirmButtonColor: '#65DFDE',
                    confirmButtonText: 'OK!',
                  },
                  function (isConfirm) {
                    if (isConfirm) {
                      window.location.href = `index3.php?id=${res}`;
                    }
                  }
                );
              },
            });
          });
        },

        onError: function (err) {
          console.log(err);
        },
      })
      .render('#paypal-button-container');
  }
  initPayPalButton();
});
