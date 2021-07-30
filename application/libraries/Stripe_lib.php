<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Stripe_lib
{ 
    private $stripe;
	public function __construct() 
    {
        $stripe_api_key = getStripeSecret();
        // $stripe_api_key = getStripeKey();
        \Stripe\Stripe::setApiKey($stripe_api_key);
        $this->stripe = new \Stripe\StripeClient(
          $stripe_api_key
        );
    }

    /**
     * Validate Price Object 
     * 
     * @param  string      Price Id
    */
    public function getSubscriptionPrice($priceId)
    {
        try{
            $token_obj = $this->stripe->prices->retrieve(
              $priceId,
              []
            );
            return $token_obj; 
        } catch(Exception $ex) {
            return false;
        }
    }

    /**
     * Validate Product Object 
     * 
     * @param  string      Product Id
    */
    public function getSubscriptionProduct($productId)
    {
        try{
            $token_obj = $this->stripe->products->retrieve(
              $productId,
              []
            );
            return $token_obj; 
        } catch(Exception $ex) {
            return false;
        }
    }

    /**
     * Update Product Object for Subscription 
     * 
     * @param  string       Product Id
     * @param  string       Product Name
    */
    public function updateSubscriptionProduct($productId,$productName)
    {
        
        
        $product = $this->stripe->products->update(
            $productId,
            ['name' => $productName]
          );
        return $product;
    }

    /**
     * Create Price Object for Subscription 
     * 
     * @param  string       Product title
     * @param  float        Subscription price
    */
    public function createSubscriptionPrice($name,$price)
    {
        $product = $this->stripe->products->create([
            'name' => $name,
        ]);
        
        $price = $this->stripe->prices->create([
            'product' => $product->id,
            'unit_amount' => (($price)*100),
            'currency' => 'usd',
            'recurring' => [
              'interval' => 'month',
            ],
        ]);
        return ['product_id'=>$product->id,'price_id'=>$price->id];
    }

    /**
     * Update Price (amount) Object for Subscription 
     * 
     * @param  string       Product Id
     * @param  float        Subscription price
    */
    public function updateSubscriptionPrice($productId,$price)
    {
        
        
        $price = $this->stripe->prices->create([
            'product' => $productId,
            'unit_amount' => (($price)*100),
            'currency' => 'usd',
            'recurring' => [
              'interval' => 'month',
            ],
        ]);
        return ['price_id'=>$price->id];
    }


    /**
     * Validate Token 
     * 
     * @param  string      Stripe Token
    */
    public function getToken($token)
    {
        try{
            $token_obj = $this->stripe->tokens->retrieve(
              $token,
              []
            );
            return $token_obj; 
        } catch(Exception $ex) {
            return false;
        }
    }

    /**
     * Validate Customer 
     * 
     * @param  string      Customer Id
    */
    public function getCustomer($customer_id)
    {
        try{
            $customer_obj = $this->stripe->customers->retrieve(
              $customer_id,
              []
            );
            return $customer_obj; 
        } catch(Exception $ex) {
            return false;
        }
    }
    
    /**
     * Create Customer Object for Subscription 
     * 
     * @param  mixed       Customer data
     * @param  string      Stripe Token
    */
    public function createCustomer($customer_data,$token = null)
    {
      $customer_array = [
          'email' => $customer_data['email'],
          'name' => $customer_data['name'],
          'address' => [
            'line1' => '510 Townsend St',
            'postal_code' => '98140',
            'city' => 'San Francisco',
            'state' => 'CA',
            'country' => 'US',
          ]
        ];
        if($token) {
          $customer_array['source'] = $token;
        }
        $customer = $this->stripe->customers->create($customer_array);


        return $customer;
    }

    /**
     * Create Session for checkout
     * 
     * @param  string      Product Id
     * @param  float      Price
    */
    public function createSession($product_id,$price,$ref_id,$url)
    {
       $session = $this->stripe->checkout->sessions->create([
          'payment_method_types' => ['card'],
          'line_items' => [[
            'price_data' => [
              'product' => $product_id,
              'unit_amount' => ($price*100),
              'currency' => 'usd',
            ],
            'quantity' => 1,
          ]],
          'mode' => 'payment',
          'success_url' => $url.'&status=success',
          'cancel_url' => $url.'&status=fail',
          'client_reference_id' => $ref_id,
        ]);
       return $session;
    }

    /**
     * Create Payment Intent
     * 
     * @param  float      Price
     * @param  string     description
    */
    public function createPaymentIntent($price,$description)
    {
       $paymentObj = $this->stripe->paymentIntents->create([
          'amount' => ($price*100),
          'currency' => 'usd',
          'description' =>$description
        ]);
       return $paymentObj;
    }

    /**
     * Retrive Payment Intent
     * 
     * @param  string     payment id
    */
    public function getPaymentIntent($payment_id)
    {
       $paymentObj = $this->stripe->paymentIntents->retrieve(
          $payment_id,
          []
        );
       return $paymentObj;
    }

    /**
     * Set Payment Id
     * 
     * @param  string      Customer Id
     * @param  string      Payment Id
    */
    public function setPaymentMethod($customer_id,$payment_id)
    {
        
        try {
          $payment_method = $this->stripe->paymentMethods->retrieve(
            $payment_id
          );
          $payment_method->attach([
            'customer' => $customer_id,
          ]);
        } catch (Exception $e) {
          return json_encode($e->jsonBody);
        }


        // Set the default payment method on the customer
        $this->stripe->customers->update($customer_id, [
          'invoice_settings' => [
            'default_payment_method' => $payment_id
          ]
        ]);
        return true;
    }



    /**
     * Create Subscription
     * 
     * @param  string      Customer Id
     * @param  string      Price Id
    */
    public function createSubscription($customer_id,$price_id)
    {
        

        $subscription = $this->stripe->subscriptions->create([
          'customer' => $customer_id,
          'items' => [[
            'price' => $price_id,
          ]],
          'payment_behavior' => 'default_incomplete',
          'expand' => ['latest_invoice.payment_intent'],
        ]);

        return $subscription;
    }

    /**
     * Validate Subscription 
     * 
     * @param  string      Subscription Id
    */
    public function getSubscription($subscription_id)
    {
        try{
            $subscription_obj = $this->stripe->subscriptions->retrieve(
              $subscription_id,
              []
            );
            return $subscription_obj; 
        } catch(Exception $ex) {
            return false;
        }
    }

    /**
     * Cancel Subscription 
     * 
     * @param  string      Subscription Id
    */
    public function cancelSubscription($subscription_id)
    {
        try{
            $subscription_obj = $this->stripe->subscriptions->update($subscription_id,
                [
                    'cancel_at_period_end' => true,
                ]
            );
            return $subscription_obj; 
        } catch(Exception $ex) {
            // echo $ex->getMessage();
            return false;
        }
    }

    /**
     * Check Webhook 
     * 
     * 
    */
    public function checkWebhook()
    {
        $endpoint_secret = $_ENV['STRIPE_WEBHOOK_SECRET'];

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
          $event = \Stripe\Webhook::constructEvent(
            $payload, $sig_header, $endpoint_secret
          );
        } catch(\UnexpectedValueException $e) {
          // Invalid payload
          http_response_code(400);
          exit();
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
          // Invalid signature
          http_response_code(400);
          exit();
        }

        if ($event->type == 'checkout.session.completed') {
          return $event->data->object;
        }
    }
}