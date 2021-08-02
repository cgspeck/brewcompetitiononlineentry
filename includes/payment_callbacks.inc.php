<?php

use PHPMailer\PHPMailer\PHPMailer;

// support types

abstract class Payment_type
{
    /*
    No first class Enum support
    Simplest implementation according to https://www.geeksforgeeks.org/enumerations-in-php/
    */
    const paypal = 0;
    const stripe = 1;
}

class Payment_info
{
    // Properties
    public array $entry_ids;
    public string $to_email;
    public string $to_recipient;
    public int $payment_type;
    public string $display_payer_email;
    public string $item_name;
    public string $payment_status;
    public $payment_amount;
    public string $payment_currency;
    public string $transaction_id;
    public string $status_message;
    // OPTIONAL;
    public ?string $cc_email = null;
    public ?string $cc_recipient = null;
    public bool $test_mode = false;

    public function __construct(
        array $entry_ids = [],
        string $to_email = "",
        string $to_recipient = "",
        int $payment_type = 0,
        string $display_payer_email = "",
        string $item_name = "",
        string $payment_status = "",
        $payment_amount = 0.0,
        string $payment_currency = "",
        string $transaction_id = "",
        string $status_message = "",
        // OPTIONALS
        string $cc_email = null,
        string $cc_recipient = null,
        bool $test_mode = false
    ) {
        $this->entry_ids = $entry_ids;
        $this->to_email = $to_email;
        $this->to_recipient = $to_recipient;
        $this->payment_type = $payment_type;
        $this->display_payer_email = $display_payer_email;
        $this->item_name = $item_name;
        $this->payment_status = $payment_status;
        $this->payment_amount = $payment_amount;
        $this->payment_currency = $payment_currency;
        $this->transaction_id = $transaction_id;
        $this->status_message = $status_message;
        $this->cc_email = $cc_email;
        $this->cc_recipient = $cc_recipient;
        $this->test_mode = $test_mode;
    }
}

// support functions
function _get_row_logo()
{
    global $connection, $prefix;

    $query_logo = sprintf("SELECT contestName,contestLogo FROM %s WHERE id='1'", $prefix . "contest_info");
    $logo = mysqli_query($connection, $query_logo) or die(mysqli_error($connection));
    $row_logo = mysqli_fetch_assoc($logo);
    $totalRows_logo = mysqli_num_rows($logo);  // what is this count used for?
    return $row_logo;
}

function _make_customer_message_body(Payment_info $payment_info, $row_logo)
{
    global $base_url, $label_amount, $label_entry_numbers, $label_paid, $label_email, $label_payer, $label_name, $label_status, $label_transaction_id, $paypal_response_text_000, $paypal_response_text_001, $paypal_response_text_002, $paypal_response_text_003;

    foreach ($payment_info->entry_ids as $value) {
        $display_entry_no[] = sprintf("%06s", $value);
    }

    $display_entry_numbers = implode(", ", $display_entry_no);
    $display_entry_numbers = rtrim($display_entry_numbers, ", ");

    $message_body = "";

    if ((isset($row_logo['contestLogo'])) && (file_exists(USER_IMAGES . $row_logo['contestLogo']))) $message_body .= "<p><img src='" . $base_url . "/user_images/" . $row_logo['contestLogo'] . "' height='150'></p>";
    $message_body .= "<p>" . $payment_info->to_recipient . ",</p>";
    $message_body .= sprintf("<p>%s</p>", $paypal_response_text_000);
    $message_body .= sprintf("<p><strong>%s</strong></p>", $paypal_response_text_001);
    $message_body .= "<table cellpadding=\"5\" cellspacing=\"0\">";
    $message_body .= sprintf("<tr valign='top'><td nowrap><strong>%s %s:</strong></td><td>" . $payment_info->to_recipient . "<td></tr>", $label_payer, $label_name);
    $message_body .= sprintf("<tr valign='top'><td nowrap><strong>%s %s:</strong></td><td>" . $payment_info->display_payer_email . "<td></tr>", $label_payer, $label_email);
    $message_body .= sprintf("<tr valign='top'><td nowrap><strong>%s:</strong></td><td>" . $payment_info->payment_status . "<td></tr>", $label_status);
    $message_body .= sprintf("<tr valign='top'><td nowrap><strong>%s:</strong></td><td>" . $payment_info->payment_amount . " " . $payment_info->payment_currency . "<td></tr>", $label_amount);
    $message_body .= sprintf("<tr valign='top'><td nowrap><strong>%s:</strong></td><td>" . $payment_info->transaction_id . "<td></tr>", $label_transaction_id);
    $message_body .= sprintf("<tr valign='top'><td nowrap><strong>%s %s:</strong></td><td>" . $display_entry_numbers . "<td></tr>", $label_entry_numbers, $label_paid);
    $message_body .= "</table>";

    $message_body .= sprintf("<p>%s</p>", $paypal_response_text_002);
    $message_body .= sprintf("<p><small>%s</small></p>", $paypal_response_text_003);
    return $message_body;
}

function _make_from_email()
{
    global $mail_default_from;

    $url = str_replace("www.", "", $_SERVER['SERVER_NAME']);
    return (!isset($mail_default_from) || trim($mail_default_from) === '') ? "noreply@" . $url : $mail_default_from;
}

// substantive functions
function mark_entries_paid(array $entry_ids)
{
    global $connection, $prefix;

    foreach ($entry_ids as $entry_id) {
        // TODO: use a prepared statement
        $updateSQL = sprintf("UPDATE %s SET brewPaid='1', brewUpdated=NOW( ) WHERE id='%s'", $prefix . "brewing", $entry_id);
        mysqli_real_escape_string($connection, $updateSQL);
        mysqli_query($connection, $updateSQL) or die(mysqli_error($connection));
    }
}

function save_payment_log(
    int $brewer_id,
    string $first_name,
    string $last_name,
    Payment_info $payment_info
) {
    global $connection, $prefix;
    // TODO: use a prepared statement
    $insertSQL = sprintf("INSERT INTO %s (uid, first_name, last_name, item_name, txn_id, payment_gross, currency_code, payment_status, payment_entries, payment_time) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')", $prefix . "payments", $brewer_id, $first_name, $last_name, $payment_info->item_name, $payment_info->transaction_id, $payment_info->payment_amount, $payment_info->payment_currency, $payment_info->status_message, $payment_info->entry_ids, time());
    mysqli_real_escape_string($connection, $insertSQL);
    mysqli_query($connection, $insertSQL) or die(mysqli_error($connection));
}

function send_customer_email(Payment_info $payment_info)
{
    global $paypal_response_text_009, $mail_use_smtp;

    $from_email = _make_from_email();
    $row_logo = _get_row_logo();

    $headers  = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
    $headers .= "To: " . $payment_info->to_recipient . " <" . $payment_info->to_email . ">, " . "\r\n";

    if (!empty($payment_info->cc_email) && ($payment_info->cc_email !== $payment_info->to_email)) {
        $headers .= "Bcc: " . $payment_info->cc_recipient . " <" . $payment_info->cc_email . ">, " . "\r\n";
    }

    $headers .= "From: " . $row_logo['contestName'] . " Server <" . $from_email . ">\r\n";

    $message_top = "";
    $message_bottom = "";

    $message_top .= "<body>";
    $message_top .= "<html>";
    $message_body = _make_customer_message_body($payment_info, $row_logo);
    $message_bottom .= "</body>";
    $message_bottom .= "</html>";

    $message_all = $message_top . $message_body . $message_bottom;

    $test_text = "";
    if ($payment_info->test_mode) {
        $test_text = "Test: ";
    }

    // Send the email message
    $subject = $test_text . " " . $payment_info->item_name . " - " . ucwords($paypal_response_text_009);

    if ($mail_use_smtp) {
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->addAddress($payment_info->to_email, $payment_info->to_recipient);
        $mail->addCC($payment_info->cc_email, $payment_info->cc_recipient);
        $mail->setFrom($from_email, $row_logo['contestName']);
        $mail->Subject = $subject;
        $mail->Body = $message_all;
        sendPHPMailerMessage($mail);
    } else {
        mail($payment_info->to_email, $subject, $message_all, $headers);
    }
}

function send_admin_confirmation_email(Payment_info $payment_info, string $data_text)
{
    global $connection, $prefix, $mail_use_smtp;
    $current_date_time_display = getTimeZoneDateTime($_SESSION['prefsTimeZone'], time(), $_SESSION['prefsDateFormat'], $_SESSION['prefsTimeFormat'], "long", "date-time");
    $from_email = _make_from_email();
    $row_logo = _get_row_logo();

    $message_body = _make_customer_message_body($payment_info, $row_logo);

    $query_prefs = sprintf("SELECT prefsPayPalAccount FROM %s WHERE id='1'", $prefix . "preferences");
    $prefs = mysqli_query($connection, $query_prefs) or die(mysqli_error($connection));
    $row_prefs = mysqli_fetch_assoc($prefs);
    $totalRows_prefs = mysqli_num_rows($prefs);  // what is this count used for?

    $paypal_email_address = filter_var($row_prefs['prefsPayPalAccount'], FILTER_SANITIZE_EMAIL);
    $confirm_to_email_address = "PayPal IPN Confirmation <" . $paypal_email_address . ">";
    $confirm_from_email_address = $row_logo['contestName'] . " Server <" . $from_email . ">";

    $headers_confirm  = "MIME-Version: 1.0" . "\r\n";
    $headers_confirm .= "Content-type: text/html; charset=utf-8" . "\r\n";
    $headers_confirm .= "To: " . $confirm_to_email_address . ", " . "\r\n";
    $headers_confirm .= "From: " . $confirm_from_email_address . "\r\n";

    $message_top_confirm = "";
    $message_body_confirm = "";
    $message_bottom_confirm = "";

    $message_top_confirm .= "<body>";
    $message_top_confirm .= "<html>";

    // this is a copy of email sent to competitor
    if (!empty($payment_info->to_email)) {
        $message_body_confirm .= "<p>To: " . $payment_info->to_recipient . "<br>" . "To Email: " . $payment_info->to_email . "<br>" . "CC: " . $payment_info->cc_recipient . "<br>" . "BCC Email: " . $payment_info->cc_email . "</p>";
        $message_body_confirm .= $message_body;
        $message_body_confirm .= "<br>-----------------------------------</p>";
    }
    // end copy email

    $message_body_confirm .= "<table border=\"0\" cellpadding=\"5\" cellspacing=\"0\">";
    $message_body_confirm .= "<tr><th>Variable</th><th>Value</th></tr>";
    $message_body_confirm .= "<tr><td width=\"150\">paypal_ipn_status</td><td>" . $payment_info->status_message . "</td></tr>";
    $message_body_confirm .= "<tr><td width=\"150\">paypal_ipn_date</td><td>" . $current_date_time_display . "</td></tr>";
    if (!empty($data_text))    $message_body_confirm .= $data_text;
    $message_body_confirm .= "</table>";

    $message_bottom_confirm .= "</body>";
    $message_bottom_confirm .= "</html>";

    $message_all_confirm = $message_top_confirm . $message_body_confirm . $message_bottom_confirm;

    $subject_confirm = "PayPal IPN: " . $payment_info->status_message;

    if ($mail_use_smtp) {
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->addAddress($paypal_email_address, "PayPal IPN Confirmation");
        $mail->setFrom($from_email, $row_logo['contestName'] . " Server");
        $mail->Subject = $subject_confirm;
        $mail->Body = $message_all_confirm;
        sendPHPMailerMessage($mail);
    } else {
        mail($confirm_to_email_address, $subject_confirm, $message_all_confirm, $headers_confirm);
    }
}
