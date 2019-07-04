<?php defined('BASEPATH') OR exit('No direct script access allowed');
 // // Configuration options
$config['stripe_key_test_public']         = 'pk_test_JKTfWhEYh9KIUJhJiD1cI0fo';
$config['stripe_key_test_secret']         = 'sk_test_4Rut0MK1S0WKIHQGs0MTaVDL';
$config['stripe_key_live_public']         = '';
$config['stripe_key_live_secret']         = '';
$config['stripe_test_mode']               = TRUE;
$config['stripe_verify_ssl']              = TRUE;

// Create the library object
$stripe = new Stripe( $config );

// Run the required operations
// echo $stripe->customer_list();