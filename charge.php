<?php 
    require_once('vendor/autoload.php');
    require_once('models/Customers.php');
    require_once('models/Transactions.php');

    \Stripe\Stripe::setApiKey("sk_test_StOCQCS1aYn7rERAkkJHZlhM00mRI9olip");

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
        'description' => 'Banana Cake',
        'customer' => $customer->id,
    ]);   
    
    //print_r($charge);

    $customerData = [
        'id' => $charge->customer,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'email' => $email
    ];

    //Instantiate Customer
    $customer = new Customer();

    //Add customer to DB
    $customer->addCustomer($customerData);

    $transactionData = [
        'id' => $charge->id,
        'customer_id' => $charge->customer,
        'product' => $charge->description,
        'amount' => $charge->amount,
        'currency' => $charge->currency,
        'status' => $charge->status
    ];

    //Instantiate Transaction
    $transaction = new Transaction();

    //Add transaction to DB
    $transaction->addTransaction($transactionData);


    //Redirect to sucess page
    header('Location: success.php?tid='. $charge->id. '&product='. $charge->description);
?>