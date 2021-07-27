<style type="text/css">
  #myaccount .container {
        width: 1200px;
  }
  .content-inner {
    min-width: 99%;
  }
  .package-div {
    color: #fff;
    background: rgba(0, 0, 0, .5);
  }
  .block-heading {
    padding: 15px;
    text-align: center;
    font-size: 18px;
    text-decoration: underline;
    background: #fff;
    color: #111;
  }

  .block-description li {
      border-bottom: 2px solid;
      padding: 5px;
  }

  .block-sub-heading {
      padding: 7px;
      background: rgba(255, 255, 255, 0.7)!important;
      text-align: center;
      font-size: 12px;
      font-weight: bold;
  }

  .block-details td {
      vertical-align: top;
  }

  .block-description {
      min-height: 45px;
      margin: 10px 0px;
  }

  .block-footer .btn {
      border: 1px solid #fff;
  }

  .block-footer {
      margin: 10px 0px;
      text-align: center;
  }

  .block-price {
      font-size: 14px;
      text-align: center;
      margin: 10px 0px;
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
              <?php foreach ($packages as $package) {
                ?>
                <td><div class="block-sub-heading"><?php echo $package->title; ?><?php echo (isset($active_plans[$package->id])) ? '<span class="badge" style="margin-left:10px;background:#5cb85c">Active</span>' : '' ?></div>
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
                    
                  <button type="button" class="btn btn-default" id="checkout-button-<?php echo $package->id;?>" <?php echo ($active_all)?'disabled':''; ?>>Subscribe</button>
                  <script type="text/javascript">
                    var stripe = Stripe('<?php echo getStripeKey(); ?>');
                    var checkoutButton = document.querySelector('#checkout-button-<?php echo $package->id;?>');
                    checkoutButton.addEventListener('click', function () {
                      stripe.redirectToCheckout({
                        lineItems: [{
                          price: '<?php echo $package->stripe_price_id;?>',
                          quantity: 1
                        }],
                        customerEmail: '<?php echo $agentInfo->email; ?>',
                        clientReferenceId: '<?php echo $this->session->userdata("userid")."_".$package->id;?>',
                        mode: 'subscription',
                        successUrl: '<?php echo base_url("user/myaccount?payment=success") ?>',
                        cancelUrl: '<?php echo base_url("user/myaccount?payment=cancel") ?>'
                      });
                    });
                  </script>
                    <?php endif; ?>
                  </div>
                </td>
              <?php } ?>
            </tr>
          </table>
          
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
  });
</script>