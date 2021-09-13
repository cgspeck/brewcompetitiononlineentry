<?php
require_once(ROOT . 'vendor/stripe-php-7.91.0/init.php');
include(DB . 'entries.db.php');
include(INCLUDES . "constants.inc.php");
include(INCLUDES . "pay.common.inc.php");

// guards
if ($disable_pay) {
    header("HTTP/1.1 303 See Other");
    header("Location: /index.php?section=pay");
}

if ($_SESSION['prefsStripeEnabled'] != "Y") {
    header("HTTP/1.1 303 See Other");
    header("Location: /index.php?section=pay");
}

$return_entries = "";
do {
    if ($row_log_confirmed['brewPaid'] != "1") {
        $return_entries .= "-" . $row_log_confirmed['id'];
    }
} while ($row_log_confirmed = mysqli_fetch_assoc($log_confirmed));

$return_entries = ltrim($return_entries, '-');

if (empty($return_entries)) {
    header("HTTP/1.1 303 See Other");
    header("Location: /index.php?section=pay");
}

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
    'client_reference_id' => sprintf("%s|%s", $_SESSION['brewerID'], $return_entries)
]);
header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
