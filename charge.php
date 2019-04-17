<?php 
    require_once('vendor/autoload.php');

    \Stripe\Stripe::setApiKey("Your secret stripe api key");

    //Sanitize POST array
    $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

    $first_name = $POST['first_name'];
    $last_name = $POST['last_name'];
    $email = $POST['email'];
    $token = $POST['stripeToken'];

    //Create customer in stripe
    $customer = \Stripe\Customer::create([
        'email' => $email,
        'source' => $token,
    ]);

    //Charge customer
    $charge = \Stripe\Charge::create([
        'amount' => 999,
        'currency' => 'cad',
        'description' => 'Cake charge',
        'source' => $token,
        'customer' => $customer -> id,
    ]);   
    
    print_r($charge);

    //Redirect to success page
    header('Location: success.php?tid='. $charge->id. '&product='. $charge->description);
?>