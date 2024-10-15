<div class="membership_box">
  <h2 class="mini_title">Membership Plan</h2>
  <div class="package-div">
    <div class="monthly_subscription"><span>Monthly Subscription</span></div>
    <script src="https://js.stripe.com/v3"></script>
    <div class="row justify-content-center">
      <?php
$active_lable = false;
foreach ($packages as $package) {?>
          <div class="col-lg-4 col-md-6 <?php if (!in_array($package->package, ['seller', 'all'])) {echo 'hidden';}?> ">
            <div class="pricing_box">
              <h4><?php echo $package->title; ?></h4>
              <?php
if (isset($active_plans[$package->id])) {
    echo '<span class="active_plan_badge">Active</span>';
    $active_lable = true;
}
    ?>
              <p><?php echo $package->description; ?></p>
              <h4 class="block-price">$<?php echo number_format($package->price_per_month, 2); ?>/month</h4>
              <div class="block-footer">
                <?php if (isset($active_plans[$package->id])): ?>
                  <?php if (isset($cancel_plans[$package->id])): ?>
                        <div class="label-info" >Active untill : <?php echo $cancel_plans[$package->id]; ?></div>
                  <?php else: ?>
                        <form action="<?php echo base_url('user/cancel_subscribe') ?>" method="post">
                          <input type="hidden" name="sub_id" value="<?php echo $active_plans[$package->id]->id; ?>">
                          <button  type="button" class="btn btn-danger  cancel_subscription"><span>Cancel Subscription</span></button>
                        </form>
                  <?php endif;?>
                <?php else: ?>
                  <button type="button" class="btn btn-default subscription_select" id="checkout-button-<?php echo $package->id; ?>" <?php echo ($active_all) ? 'disabled' : ''; ?> data-price-id="<?php echo $package->stripe_price_id; ?>" data-plan-name="<?php echo $package->title; ?>" data-plan-price="<?php echo number_format($package->price_per_month, 2); ?>">Subscribe</button>
                  <script type="text/javascript">
                    // var stripe = Stripe('<?php echo getStripeKey(); ?>');
                    // var checkoutButton = document.querySelector('#checkout-button-<?php echo $package->id; ?>');
                    // checkoutButton.addEventListener('click', function () {
                    //   stripe.redirectToCheckout({
                    //     lineItems: [{
                    //       price: '<?php echo $package->stripe_price_id; ?>',
                    //       quantity: 1
                    //     }],
                    //     customerEmail: '<?php echo $agentInfo->email; ?>',
                    //     clientReferenceId: '<?php echo $this->session->userdata("userid") . "_" . $package->id; ?>',
                    //     mode: 'subscription',
                    //     successUrl: '<?php echo base_url("user/myaccount?payment=success") ?>',
                    //     cancelUrl: '<?php echo base_url("user/myaccount?payment=cancel") ?>'
                    //   });
                    // });
                  </script>
                <?php endif;?>
              </div>
            </div>
          </div>
        <?php }?>
    </div>
  </div>

  <div class="stripe-div" style="display: none;">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/stripe.css') ?>">
    <div class="stripe-container">
      <div class="row row justify-content-center">
        <div class="col-sm-12">
          <div class="payment-info-table">
            <div class="row">
              <div class="col-sm-12 text-center">
                <h2 class="text-decoration-underline">Payment Information</h2>
              </div>
            </div>
            <div class="row payment-info-table-row">
              <div class="col-sm-6 text-end">Selected Plan : </div>
              <div class="col-sm-6"><span id="selected_plan_title"></span></div>
            </div>
            <div class="row payment-info-table-row">
              <div class="col-sm-6 text-end">Subscription Value : </div>
              <div class="col-sm-6">$ <span id="selected_plan_value"></span> / month </div>
            </div>
          </div>

          <form id="subscription-form">
            <input type="hidden" name="stripe_price_id" id="stripe_price_id">
            <div id="card-element">
              <!-- Elements will create input elements here -->
            </div>
            <button id="stripe-submit">
              <div class="spinner hidden" id="spinner"></div>
              <span id="button-text">Pay now</span>
            </button>
            <!-- We'll put the error messages in this element -->
            <p id="card-error" class="alert alert-danger" role="alert" style="display: none;"></p>
            <p id="payment-success" class="alert alert-success" role="alert" style="display: none;"></p>

            <a href="javascript:void(0);" class="back-subscribe text-end">Back to select Subscription</a>

          </form>
        </div>
      </div>



    </div>
  </div>

</div>

<script type="text/javascript">
  $(document).ready(function(){
    $('.cancel_subscription').click(function(){
      var cancel_form = $(this).parent();
      if(confirm('Are you sure? You want to cancel subscription?')) {
        $(cancel_form).trigger("submit");
      }
    });

    $('.subscription_select').click(function(){
      var price_id_val = $(this).attr('data-price-id');
      var plan_title = $(this).attr('data-plan-name');
      var plan_price = $(this).attr('data-plan-price');
      $("#stripe_price_id").val(price_id_val);
      $("#selected_plan_title").html(plan_title);
      $("#selected_plan_value").html(plan_price);
      $('.stripe-div').show();
      $('.membership_box').addClass('tab_white_box');
      $('.package-div').hide();
    });

    $('.back-subscribe').click(function(){
      $('.stripe-div').hide();
      $('.membership_box').removeClass('tab_white_box');
      $('.package-div').show();
    });


    });

    var stripe_secret_key = '<?php echo getStripeKey(); ?>';
    var stripe = Stripe('<?php echo getStripeKey(); ?>');
    let elements = stripe.elements();

    var style = {
      base: {
        color: "#32325d",
        fontFamily: 'Arial, sans-serif',
        fontSmoothing: "antialiased",
        fontSize: "16px",
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

    $(document).ready(function(){
      let card = elements.create('card', { style: style });
      card.mount('#card-element');

      card.on('change', function (event) {
        document.querySelector("#stripe-submit").disabled = event.empty;
        document.querySelector("#card-error").textContent = event.error ? event.error.message : "";
        if(event.error) {
          $("#card-error").show();
        }
        else {
          $("#card-error").hide();
        }
      });


      document.getElementById("stripe-submit").disabled = true;

      const btn = document.querySelector('#stripe-submit');
      btn.addEventListener('click', async (e) => {
        e.preventDefault();
        loading(true);
        const nameInput = '<?php echo $this->session->userdata('username') ?>';
        let priceId = document.getElementById('stripe_price_id').value;
        const customerId = '<?php echo $customer_id ?>';
        var id = "ctl03_Tabs1";
        var lastFive = id.substr(id.length - 5);
        fetch('<?php echo base_url("user/createSubscription"); ?>', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            priceId: priceId,
            customerId: customerId,
          }),
        })
        .then(response => response.json())
        .then(data => {
          console.log('data =====', data);

          if(data.status == true) {
            stripe.confirmCardPayment(data.clientSecret, {
              payment_method: {
                card: card,
                billing_details: {
                  name: nameInput,
                },
              }
            }).then((result) => {

              if(result.error) {
                showError(result.error.message);
              } else {
                const paymentMethodId = result.paymentIntent.payment_method;
                // Fetch the payment method details from Stripe
                fetch('<?php echo base_url("user/fetchCardDetails"); ?>', {
                  method: 'POST',
                  headers: {
                    'Content-Type': 'application/json',
                  },
                  body: JSON.stringify({
                    paymentMethodId: paymentMethodId,
                    subscriptionId: data.subscriptionId,
                    priceId: priceId,
                  }),
                })
                .then(response => response.json())
                .then(data => {
                  console.log('data ==', data);
                  if (data.status === true) {
                    $("#payment-success").html("You have successfully subscribed");
                    location.replace('<?php echo base_url("user/myaccount/membership"); ?>');
                  } else {
                    showError(data.message);
                  }
                  // Successful subscription payment
                })
                .catch((error) => {
                  console.error('Error:', error);
                });
              }
            });
          }
          else {
            showError(data.message);
          }
        })
        .catch((error) => {
          console.error('Error:', error);
        });

      });
    });

    // Show the customer the error from Stripe if their card fails to charge
    var showError = function(errorMsgText) {
      loading(false);
      var errorMsg = document.querySelector("#card-error");
      $("#card-error").show();
      errorMsg.textContent = errorMsgText;
    };

    // Show a spinner on payment submission
    var loading = function(isLoading) {
      if (isLoading) {
        $("#card-error").html('');
        $("#card-error").hide();
        // Disable the button and show a spinner
        document.querySelector("#stripe-submit").disabled = true;
        document.querySelector("#spinner").classList.remove("hidden");
        document.querySelector("#button-text").classList.add("hidden");
      } else {
        document.querySelector("#stripe-submit").disabled = false;
        document.querySelector("#spinner").classList.add("hidden");
        document.querySelector("#button-text").classList.remove("hidden");
      }
    };

</script>