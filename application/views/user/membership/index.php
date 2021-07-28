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