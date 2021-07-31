<?php

if ($_SESSION['prefsStripeEnabled'] != "Y") {
    header("HTTP/1.1 303 See Other");
    header("Location: /index.php?section=pay");
}
require_once(ROOT . 'vendor/stripe-php-7.91.0/init.php');
include(DB . 'entries.db.php');
include(INCLUDES . "constants.inc.php");
include(INCLUDES . "pay.common.inc.php");

if (TESTING) {
    $stripe_sk = $_SESSION['prefsStripeTestPrivateKey'];
} else {
    $stripe_sk = $_SESSION['prefsStripeLivePrivateKey'];
}

if ($_SESSION['prefsProEdition'] == 1) {
    $item_name = sprintf(
        "%s - %s",
        $_SESSION['brewerBreweryName'],
        remove_accents($_SESSION['contestName'])
    );
} else {
    $item_name = sprintf(
        "%s, %s - %s",
        $_SESSION['brewerLastName'],
        $_SESSION['brewerFirstName'],
        remove_accents($_SESSION['contestName'])
    );
}

\Stripe\Stripe::setApiKey($stripe_sk);
header('Content-Type: application/json');

$cancel_url = $base_url . "index.php?section=pay&msg=11";
$success_url = $base_url . "index.php?section=pay&msg=10";

$checkout_session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [[
        'name' => $item_name,
        'amount' => calculate_total_to_pay() * 100,
        'currency' => 'aud',
        'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => $success_url,
    'cancel_url' => $cancel_url,
    'customer_email' => $_SESSION['brewerEmail'],
    'client_reference_id' => $_SESSION['brewerID']
]);
header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
