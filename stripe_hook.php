<?php
/*

To use:
1. create a Stripe account
2. configure Access Keys
3. set Stripe webhook to call $base_url."stripe_hook.php";

*/
function print_log($val)
{
	return file_put_contents('php://stderr', print_r($val, TRUE));
}

require('paths.php');
require(CONFIG . 'bootstrap.php');
require(INCLUDES . 'url_variables.inc.php');
include(INCLUDES . 'scrubber.inc.php');
require(LANG . 'language.lang.php');
require(LIB . 'email.lib.php');
// Instantiate Stripe
require_once(ROOT . 'vendor/stripe-php-7.91.0/init.php');
include(DB . 'entries.db.php');
include(INCLUDES . "constants.inc.php");
include(INCLUDES . "pay.common.inc.php");

// Set this to true to use the sandbox endpoint during testing:
if ((DEBUG) || (TESTING)) {
	$enable_sandbox = TRUE;
	$send_confirmation_email = TRUE;
} else {
	$enable_sandbox = FALSE;
	$send_confirmation_email = FALSE;
}



if (TESTING) {
	$stripe_sk = $_SESSION['prefsStripeTestPrivateKey'];
} else {
	$stripe_sk = $_SESSION['prefsStripeLivePrivateKey'];
}

\Stripe\Stripe::setApiKey($stripe_sk);

$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
$event = null;

try {
	$event = \Stripe\Webhook::constructEvent(
		$payload,
		$sig_header,
		$endpoint_secret
	);
} catch (\UnexpectedValueException $e) {
	// Invalid payload
	http_response_code(400);
	exit();
} catch (\Stripe\Exception\SignatureVerificationException $e) {
	// Invalid signature
	http_response_code(400);
	exit();
}

function fulfill_order($session)
{
	global $connection, $prefix, $send_confirmation_email, $enable_sandbox;

	print_log("Fulfilling order...");
	print_log($session);

	$client_reference_id_parts = explode("|", $session->client_reference_id);
	$brewer_id = $client_reference_id_parts[0];
	if (strpos($client_reference_id_parts[1], "-")) $entry_ids = explode("-", $client_reference_id_parts[1]);
	else $entry_ids = array($client_reference_id_parts[1]);

	$query_user_info = sprintf("SELECT brewerFirstName,brewerLastName,brewerEmail FROM %s WHERE uid='%s'", $prefix . "brewer", $brewer_id);
	$user_info = mysqli_query($connection, $query_user_info) or die(mysqli_error($connection));
	$row_user_info = mysqli_fetch_assoc($user_info);
	$totalRows_user_info = mysqli_num_rows($user_info);

	$payment_info = new Payment_info();
	$payment_info->payment_type = Payment_type::stripe;


	$to_email = 	$row_user_info['brewerEmail'];
	$to_recipient = $row_user_info['brewerFirstName'] . " " . $row_user_info['brewerLastName'];

	$cc_email = $session->customer_email;

	// returned from Stripe and verified
	$payment_info->entry_ids = $entry_ids;
	$payment_info->item_name = $session->line_items->data[0]->description;
	$payment_info->payment_status = $session->payment_status;
	$payment_info->payment_amount = $session->amount_total;
	$payment_info->payment_currency = $session->currency;
	$payment_info->transaction_id = "TODO";
	//
	// $payment_info->transaction_id = $session->payment_intent;
	// https://stripe.com/docs/api/payment_intents/retrieve
	//
	// exchange the payment intent_id for the payment intent
	// dig through for successful charges on payment intent
	// collect receipt_ids
	//
	$payment_info->cc_email = $cc_email;

	// from the DB
	$payment_info->to_email = $to_email;
	$payment_info->$to_recipient;

	// TODO: if possible, additional warning if not sandbox but am using test keys
	if ($enable_sandbox) {
		$payment_info->status_message = "SANDBOX: Completed Successfully";
	} else {
		$payment_info->status_message = "Completed Successfully";
	}


	/*
	 TODO: capture stripe payment information:
		$brewer_id
		$session->id
		$session->client_reference_id
		$session->currency
		$session->amount_total
		$session->customer (id)
		$session->customer_email
		$session->customer_email
		$session->payment_intent (id)
		collected reciept ids as above

	*/

	// mark as paid and email the customer
	mark_entries_paid($payment_info->entry_ids);
	send_customer_email($payment_info);
	// email admin
	$data_text = "";
	foreach ($_POST as $key => $value) {
		$data_text .= "<tr><td width=\"150\">" . $key . "</td><td>" . $value . "</td></tr>";
	}

	if ($send_confirmation_email) {
		// Send confirmation email
		send_admin_confirmation_email($payment_info, $data_text);
	}
}

// Handle the checkout.session.completed event
if ($event->type == 'checkout.session.completed') {
	$session = $event->data->object;

	// Fulfill the purchase...
	fulfill_order($session);
}

// Reply with an empty 200 response to indicate to paypal the IPN was received correctly
header("HTTP/1.1 200 OK");
