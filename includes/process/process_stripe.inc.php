<?php

if ($_SESSION['prefsStripeEnabled'] != "Y") {
    header("HTTP/1.1 303 See Other");
    header("Location: /index.php?section=pay");
}
// include(INCLUDES . 'beerXML/input_beer_xml.inc.php');
require_once(ROOT . 'vendor/stripe-php-7.91.0/init.php');
include(INCLUDES . "pay.common.inc.php");


if (TESTING) {
    $stripe_sk = $_SESSION['prefsStripeTestPrivateKey'];
} else {
    $stripe_sk = $_SESSION['prefsStripeLivePrivateKey'];
}


// echo ("TODO: create checkout session");
// echo (calculate_total_to_pay());
\Stripe\Stripe::setApiKey($stripe_sk);
header('Content-Type: application/json');
$YOUR_DOMAIN = 'http://localhost:4242';

$checkout_session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [[
        'name' => "competition entries",
        'amount' => calculate_total_to_pay() * 100,
        'currency' => 'aud',
        'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => $YOUR_DOMAIN . '/success.html',
    'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
]);
header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
// create the stripe checkout session and redirect
// PayPal settings
// $paypal_email = $_POST['business'];
// $return_url = $_POST['return'];
// $cancel_url = $_POST['cancel_return'];
// // $notify_url = $base_url."ppv.php";
// if ((TESTING) || (DEBUG)) $paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
// else $paypal_url = "https://www.paypal.com/cgi-bin/webscr";

// $item_name = sterilize($_POST['item_name']);
// $item_amount = sterilize($_POST['amount']);

// // ---------------------------- Check if paypal request or response  ---------------------------

// // Request payment

// $query_string = "";

// // Append PayPal account to querystring
// $query_string .= "?business=".urlencode($paypal_email)."&";

// // Loop for posted values and append to querystring
// foreach($_POST as $key => $value){
// 	if (($key != "cancel_return") && ($key != "return")) {
// 		$value = urlencode(stripslashes($value));
// 		$query_string .= "$key=$value&";
// 	}
// }

// // Append paypal return addresses
// $query_string .= "return=".urlencode(stripslashes($return_url));
// $query_string .= "&cancel_return=".urlencode(stripslashes($cancel_url));
// // $query_string .= "&notify_url=".urlencode($notify_url);

// // Redirect to PayPal IPN
// $redirect_go_to = sprintf('location:%s%s',$paypal_url,$query_string);
