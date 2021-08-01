<?php
/*

https://developer.paypal.com/docs/classic/ipn/integration-guide/IPNSetup/
http://www.evoluted.net/thinktank/web-development/paypal-php-integration

To implement:
1. Users will need to enable Auto Return for Website Payments in PayPal to $base_url."index.php?section=pay&msg=10";
	-- Must have a business account
	-- Login > Profile > My Selling Tools > Website Preferences

2. Users will need to enable Instant Payment Notification (IPN)
	-- Must have a business account
	-- Login > Profile > My Selling Tools > Instant payment notifications
	-- Notification URL should be $base_url."ppv.php";

*/

use PHPMailer\PHPMailer\PHPMailer;
require('paths.php');
require(CONFIG . 'bootstrap.php');
require(INCLUDES . 'url_variables.inc.php');
include(INCLUDES . 'scrubber.inc.php');
require(LANG . 'language.lang.php');
require(LIB . 'email.lib.php');
require(INCLUDES . 'process_paypal.inc.php');





$current_date = getTimeZoneDateTime($_SESSION['prefsTimeZone'], time(), $_SESSION['prefsDateFormat'], $_SESSION['prefsTimeFormat'], "system", "date");
$current_date_time_display = getTimeZoneDateTime($_SESSION['prefsTimeZone'], time(), $_SESSION['prefsDateFormat'], $_SESSION['prefsTimeFormat'], "long", "date-time");
$current_time = getTimeZoneDateTime($_SESSION['prefsTimeZone'], time(), $_SESSION['prefsDateFormat'], $_SESSION['prefsTimeFormat'], "system", "time");

$custom_parts = explode("|", $_POST['custom']);

// Assign posted variables to local variables
$data['payment_status'] = filter_var($_POST['payment_status'], FILTER_SANITIZE_STRING);
$data['item_name'] = filter_var($_POST['item_name'], FILTER_SANITIZE_STRING);
$data['item_number'] = filter_var($_POST['item_number'], FILTER_SANITIZE_STRING);
$data['payment_status'] = filter_var($_POST['payment_status'], FILTER_SANITIZE_STRING);
$data['payment_amount'] = filter_var($_POST['mc_gross'], FILTER_SANITIZE_STRING);
$data['payment_currency'] = filter_var($_POST['mc_currency'], FILTER_SANITIZE_STRING);
$data['txn_id'] = filter_var($_POST['txn_id'], FILTER_SANITIZE_STRING);
$data['receiver_email'] = filter_var($_POST['receiver_email'], FILTER_SANITIZE_EMAIL);
$data['first_name'] = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
$data['last_name'] = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);
$data['payer_email'] = filter_var($_POST['payer_email'], FILTER_SANITIZE_EMAIL);
$data['custom'] = filter_var($_POST['custom'], FILTER_SANITIZE_STRING);

$query_user_info = sprintf("SELECT brewerFirstName,brewerLastName,brewerEmail FROM %s WHERE uid='%s'", $prefix . "brewer", $custom_parts[0]);
$user_info = mysqli_query($connection, $query_user_info) or die(mysqli_error($connection));
$row_user_info = mysqli_fetch_assoc($user_info);
$totalRows_user_info = mysqli_num_rows($user_info);

// Set this to true to use the sandbox endpoint during testing:
if ((DEBUG) || (TESTING)) {
	$enable_sandbox = TRUE;
	$send_confirmation_email = TRUE;
} else {
	$enable_sandbox = FALSE;
	$send_confirmation_email = FALSE;
}

// $url = str_replace("www.", "", $_SERVER['SERVER_NAME']);

$paypal_email_address = filter_var($row_prefs['prefsPayPalAccount'],FILTER_SANITIZE_EMAIL);

// $from_email = (!isset($mail_default_from) || trim($mail_default_from) === '') ? "noreply@" . $url : $mail_default_from;

// $confirm_to_email_address = "PayPal IPN Confirmation <" . $paypal_email_address . ">";
// $confirm_from_email_address = $row_logo['contestName'] . " Server <" . $from_email . ">";

$to_email = "";
$to_recipient = "";
$cc_email = "";
$cc_recipient = "";

$test_text = "";
$data_text = "";

// Instantiate the PayPal IPN Class
require(CLASSES . 'paypal/paypalIPN.php');

$ipn = new PaypalIPN();

if ($enable_sandbox) {
	$ipn->useSandbox();
}

$verified = $ipn->verifyIPN();

if ($send_confirmation_email) {
	foreach ($_POST as $key => $value) {
		$data_text .= "<tr><td width=\"150\">" . $key . "</td><td>" . $value . "</td></tr>";
	}
}

if ((isset($_POST['test_ipn'])) && ($_POST['test_ipn'] == 1)) {
	$test_text = "Test: ";
}

// Check the receiver email to see if it matches
$receiver_email_found = FALSE;

if (strtolower($data['receiver_email']) == strtolower($paypal_email_address)) {
	$receiver_email_found = TRUE;
}

$paypal_ipn_status = "Payment Verification Failed";

if ($verified) {

	$paypal_ipn_status = "Receiver Email Mismatch - Check PayPal Payment Email Address in Preferences";

	if ($receiver_email_found) {

		$paypal_ipn_status = "Completed Successfully";

		// Process IPN
		// A list of variables are available here:
		// https://developer.paypal.com/webapps/developer/docs/classic/ipn/integration-guide/IPNandPDTVariables/

		// If payment completed, update the brewing table rows for each paid entry

		if (strpos($custom_parts[1], "-")) $b = explode("-", $custom_parts[1]);
		else $b = array($custom_parts[1]);
		$queries = "";
		$display_entry_no = array();
		markEntriesPaid($b);
		$to_email = 	$row_user_info['brewerEmail'];
		$to_recipient = $row_user_info['brewerFirstName'] . " " . $row_user_info['brewerLastName'];

		$cc_email = 	$data['payer_email'];
		$cc_recipient = $data['first_name'] . " " . $data['last_name'];
		sendCustomerEmail(
			entry_ids: $b,
			to_email: $to_email,
			to_recipient: $to_recipient,
			payment_type: Payment_type::paypal,
			display_payer_email: $data['payer_email'],
			item_name: $data['item_name'],
			payment_status: $data['payment_status'],
			payment_amount: $data['payment_amount'],
			payment_currency: $data['payment_currency'],
			transaction_id: $data['txn_id'],
			cc_email: $cc_email,
			cc_recipient: $cc_recipient
		);
	}
} elseif ($enable_sandbox) {
	if ($_POST['test_ipn'] != 1) $paypal_ipn_status = "Received from Live While Sandboxed";
} elseif ($_POST['test_ipn'] == 1) {
	$paypal_ipn_status = "Received from Sandbox While Live";
}

// saving log
$insertSQL = sprintf("INSERT INTO %s (uid, first_name, last_name, item_name, txn_id, payment_gross, currency_code, payment_status, payment_entries, payment_time) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')", $prefix . "payments", $custom_parts[0], $data['first_name'], $data['last_name'], $data['item_name'], $data['txn_id'], $data['payment_amount'], $data['payment_currency'], $paypal_ipn_status, $custom_parts[1], time());
mysqli_real_escape_string($connection, $insertSQL);
$result = mysqli_query($connection, $insertSQL) or die(mysqli_error($connection));

if ($send_confirmation_email) {
	// Send confirmation email
	sendAdminConfirmationEmail();
}

// Reply with an empty 200 response to indicate to paypal the IPN was received correctly
header("HTTP/1.1 200 OK");
