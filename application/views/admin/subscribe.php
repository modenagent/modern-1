<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    //Stripe.setPublishableKey("pk_live_kWtXKplBdNqXQMeBWHuHYZDx");
    Stripe.setPublishableKey("pk_test_JKTfWhEYh9KIUJhJiD1cI0fo");
  // ...
</script>
<div class="breadLine">
  <ul class="breadcrumb">
    <li><a href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a></li>
    <li class="active">Pay Subscription</li>
  </ul>
</div>
<div class="clearfix"></div>
<div class="panel panel-info">
  <div class="panel-heading">
    <h4 class="panel-title">Payment</h4>
  </div>
  <div class="panel-body">
    <div class="row">
        
        <div class="col-md-8">

            <div class="panel panel-default user-form payment-form">    
                <div class="panel-heading">
                    <h4 class="">Payment Information</h4>
                </div>
                <div class="panel-body">
                    <form action="<?php echo site_url('admin/pay_subscription'); ?>" method="POST" id="subscribe-form" class="form-horizontal" role="form">
                        <span class="payment-errors"></span>
                        <span class="payment-success"><?php $success ?></span>
                        <input type="hidden"  name="user_id" value="<?php echo $user_id; ?>" /> 
                        <input type="hidden"  data-stripe="email" name="email" value="<?php echo $user->email; ?>" /> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="plan_id">Select Plan</label>
                            <div class="col-sm-9">
                                <select class="form-control"  data-stripe="plan_id" name="plan_id" id="select-plan-id">
                                    <?php foreach($plans as $plan): ?>
                                    <option value="<?php echo $plan['id'] ?>" data-amount="<?php echo $plan['amount'] ?>" data-interval="<?php echo $plan['interval'] ?>"><?php echo $plan['name'] ?></option>
                                    <?php endforeach; ?>
                                </select> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="card-holder-name">Name on Card</label>
                            <div class="col-sm-9">
                                <input type="text" size="80" data-stripe="name" class="form-control" placeholder="Card Holder's Name" />                                            
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="card-number">Card Number</label>
                            <div class="col-sm-9">
                                <input type="text" size="20" data-stripe="number" class="form-control" placeholder="Card Number." />
                            </div>
                         </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="cvv">Card CVV</label>
                            <div class="col-sm-2">
                                <input type="text" size="4" data-stripe="cvc" class="form-control" placeholder="CVV" />
                            </div>
                        </div>  

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="expiry-month">Expiration Date</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-xs-6">

                                          <input type="text" size="2" data-stripe="exp-month" class="form-control" placeholder="Month"/>

                                    </div>
                                    <div class="col-xs-6">

                                          <input type="text" size="4" data-stripe="exp-year" class="form-control" placeholder="Year"/>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">                                            
                                <button type="submit" class="btn btn-success">Pay Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default panel-sidebar-1">
                <div class="panel-heading">
                    <h4 class="">Subscription summary</h4>
                </div>                                  
                 <div class="panel-body bb" >
                     <p>Plan: <span id="plan-name"></span></p>
                     <p>Amount payable: <span id="plan-amt"></span></p>
                     <p>Interval : <span id="plan-interval"></span></p>
                </div>

            </div>
        </div>
    </div>
  </div>
</div>
</div>
<!-- page end-->
</div>
</div>
<script type="text/javascript">
    // stripe
        function stripeResponseHandler(status, response) {
          var $form = $('#subscribe-form');

          if (response.error) {
            // Show the errors on the form
            $form.find('.payment-errors').text(response.error.message);
            $form.find('button').prop('disabled', false);
          } else {
            // response contains id and card, which contains additional card details
            var token = response.id;
            // Insert the token into the form so it gets submitted to the server
            $form.append($('<input type="hidden" name="stripeToken" />').val(token));
            // blank out the form
            // and submit
            $form.get(0).submit();
          }
        }
        // stripe form submit
        jQuery(function($) {
          $('#subscribe-form').submit(function(event) {
            var $form = $(this);

            // Disable the submit button to prevent repeated clicks
            $form.find('button').prop('disabled', true);

            Stripe.card.createToken($form, stripeResponseHandler);

            // Prevent the form from submitting with the default action
            return false;
          });
          showSelectedPlan();
          $('#select-plan-id').change(function(){
              showSelectedPlan();
          });
        });
    function showSelectedPlan(){
        var selectedOption = $('#select-plan-id').find(":selected");
        var text = $(selectedOption).text();
        var amount = $(selectedOption).data('amount');
        var interval = $(selectedOption).data('interval');
        $("#plan-name").html(text);
        $("#plan-amt").html("$"+amount);
        $("#plan-interval").html(interval);
    }
</script>