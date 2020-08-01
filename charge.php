<?php
require_once('vendor/autoload.php');
require_once('config/db.php');
require_once('lib/pdo_db.php');
require_once('models/Customer.php');
require_once('models/Transaction.php');


\Stripe\Stripe::setApiKey('');

$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

$first_name = $POST['first_name'];
$last_name = $POST['last_name'];
$email = $POST['email'];
$account_name = $POST['account_name'];
$token = $POST['stripeToken'];



//Create Customer In Stripe
$customer = \Stripe\Customer::create(array(
 "email" => $email,
 "source" => $token,

));

//Charge
$charge = \Stripe\Charge::create(array(
 "amount" => 5000,
 "currency" => "usd",
 "description" => "Amazon Gift Card",
 "customer" =>$customer->id
));
//Customer data
$customerData = [
  'id' => $charge->customer,
  'first_name' => $first_name,
  'last_name' => $last_name,
  'account_name' => $account_name,
  'email' => $email,
  
];

$customer = new Customer();
$customer->addCustomer($customerData);

//Transaction Data
$transactionData = [
  'id' => $charge->id,
  'customer_id' => $charge->customer,
  'product' => $charge->description,
  'amount' => $charge->amount,
  'currency' => $charge->currency,
  'status' => $charge->status,
  
];

//Instantiate Transaction
$transaction = new Transaction();
$transaction->addTransaction($transactionData);

header('Location: success.php?tid='.$charge->id. '&product=' .$charge->description);

?>