<style type="text/css">
  #myaccount .container {
        width: 1200px;
  }
  .content-inner {
    min-width: 99%;
  }
  .package-div {
    color: #fff;
  }
  .block-heading {
    padding: 15px;
    text-align: center;
    font-size: 22px;
  }

  .block-description li {
      border-bottom: 2px solid;
      padding: 5px;
  }

  .block-sub-heading {
      padding: 7px;
      text-align: center;
      font-size: 17px;
      font-weight: bold;
  }

  .block-details td {
      vertical-align: top;
  }

  .block-description {
      min-height: 45px;
      margin: 30px 0px;
      font-size: 16px;
      text-align: center;
  }

  .block-footer .btn {
      border: 1px solid #fff;
  }

  .block-footer {
      margin: 10px 0px;
      text-align: center;
  }

  .block-price {
      font-size: 17px;
      text-align: center;
      margin: 20px 0px;
      font-weight: 700;
  }
  .block-description ul {
    padding-inline-start: 10px;
  }
  .stripe-button-el span {
    background: none;
    box-shadow: none;
  }

  button.stripe-button-el {
      background: none;
      border: 1px solid #fff;
      box-shadow: none;
  }
  .package-div table {
    background: none;
  }
  .package-div table td {
      border-right: 1px solid;
      width: 20%;
      vertical-align: middle;
  }
  .package-div table td:last-child {
       border-right: 0px;
  }
  .payment-info-table {
    background: none;
    border: 1px solid;
  }
  .payment-info-table tr:nth-child(2n) td {
    background: none;
  }
  .payment-info-table thead th {
    text-align: center;
    font-size: 18px;
    border-bottom: 1px solid;
  }
  .payment-info-table tbody th {
    text-align: right;
  }
  .payment-info-table tbody th,.payment-info-table tbody td {
    padding: 10px 25px;
    font-size: 16px;
    font-weight: 700;
  }
  a.back-subscribe {
    text-decoration: underline !important;
    color: #fff;
    margin-top: 10px;
    font-size: 16px;
    display: block;
  }
  .stContainer {
    overflow-y: auto;
  }
</style>
<div class="content-inner clearfix" style="vertical-align:top;">
  <div class="row">
    <div class="col-md-12">
        <h4 style="margin-bottom:10px; padding-top:25px;">Membership Plan</h4>
    </div>
  </div>
  <div class="package-div">
    <div class="row">
      <script src="https://js.stripe.com/v3"></script>
      <div class="col-md-12">
        <div class="block-heading">Monthly Subscription</div>
        <div class="block-details">
          <table>
            <tr>
              <?php 
                $active_lable = false;
                foreach ($packages as $package) {
                ?>
                <td><div class="block-sub-heading"><div><?php echo $package->title; ?></div>
                  <?php
                    if(isset($active_plans[$package->id])) {
                      echo '<span class="badge" style="margin-left:10px;background:#5cb85c">Active</span>';
                      $active_lable = true;
                    }
                  ?>
                  </div>
                  <div class="block-description">
                    <?php echo $package->description; ?>
                  </div>
                  <div class="block-price">
                    $<?php echo number_format($package->price_per_month,2); ?>/month
                  </div>
                  <div class="block-footer">

                    <?php if(isset($active_plans[$package->id])): ?>
                      <?php if(isset($cancel_plans[$package->id])): ?>
                        <h5 class="label-info" style="padding: 8px;">Active untill : <?php echo $cancel_plans[$package->id]; ?></h5>
                      <?php else: ?>
                      <form action="<?php echo base_url('user/cancel_subscribe') ?>" method="post">
                        <input type="hidden" name="sub_id" value="<?php echo $active_plans[$package->id]->id; ?>">
                        <button  type="button" class="btn btn-danger  cancel_subscription"><span>Cancel Subscription</span></button>
                      </form>
                      <?php endif; ?>
                    <?php else : ?>
                    
                  <button type="button" class="btn btn-default subscription_select" id="checkout-button-<?php echo $package->id;?>" <?php echo ($active_all)?'disabled':''; ?> data-price-id="<?php echo $package->stripe_price_id;?>" data-plan-name="<?php echo $package->title;?>" data-plan-price="<?php echo number_format($package->price_per_month,2);?>">Subscribe</button>
                  <script type="text/javascript">
                    // var stripe = Stripe('<?php echo getStripeKey(); ?>');
                    // var checkoutButton = document.querySelector('#checkout-button-<?php echo $package->id;?>');
                    // checkoutButton.addEventListener('click', function () {
                    //   stripe.redirectToCheckout({
                    //     lineItems: [{
                    //       price: '<?php echo $package->stripe_price_id;?>',
                    //       quantity: 1
                    //     }],
                    //     customerEmail: '<?php echo $agentInfo->email; ?>',
                    //     clientReferenceId: '<?php echo $this->session->userdata("userid")."_".$package->id;?>',
                    //     mode: 'subscription',
                    //     successUrl: '<?php echo base_url("user/myaccount?payment=success") ?>',
                    //     cancelUrl: '<?php echo base_url("user/myaccount?payment=cancel") ?>'
                    //   });
                    // });
                  </script>
                    <?php endif; ?>
                  </div>
                </td>
              <?php } ?>

            </tr>
          </table>

          <?php
            if($active_lable) {
              ?>
              <style type="text/css">
                .block-sub-heading {
                  min-height: 55px;
                }
              </style>
            <?php }?>
          
        </div>
      </div>
    </div>
    
  </div>
  <div class="stripe-div" style="display: none;">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/stripe.css') ?>">
    <div class="stripe-container">
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
          <table class="payment-info-table">
            <thead>
              <tr>
                <th colspan="2">
                  Payment Information
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>Selected Plan : </th>
                <td><span id="selected_plan_title"></span> </td>
              </tr>
              <tr>
                <th>Subscription Value : </th>
                <td>$ <span id="selected_plan_value"></span> / month </td>
              </tr>
            </tbody>
          </table>
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

            <a href="javascript:void(0);" class="back-subscribe">Back to select Subscription</a>

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
      $('.package-div').hide();
    });
    $('.back-subscribe').click(function(){
      $('.stripe-div').hide();
      $('.package-div').show();
    });


    });

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
        const nameInput = '<?php echo $this->session->userdata('username')?>';
        let priceId = document.getElementById('stripe_price_id').value;
        const customerId = '<?php echo $customer_id ?>';

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
                $("#payment-success").html("You have sucessfully Subscribed");
                location.reload();
                // Successful subscription payment
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