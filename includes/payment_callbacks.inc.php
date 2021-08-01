<?php

// function calculate_total_entry_fees()
// {
//     global $bid, $filter;
//     return total_fees($_SESSION['contestEntryFee'], $_SESSION['contestEntryFee2'], $_SESSION['contestEntryFeeDiscount'], $_SESSION['contestEntryFeeDiscountNum'], $_SESSION['contestEntryCap'], $_SESSION['contestEntryFeePasswordNum'], $bid, $filter, $_SESSION['comp_id']);
// }
use PHPMailer\PHPMailer\PHPMailer;

/*
No first class Enum support
Simplest implementation according to https://www.geeksforgeeks.org/enumerations-in-php/
*/

abstract class Payment_type
{
    const paypal = 0;
    const stripe = 1;
}

function markEntriesPaid(array $entry_ids)
{
    global $connection, $prefix;

    foreach ($entry_ids as $entry_id) {
        // TODO: use a prepared statement
        $updateSQL = sprintf("UPDATE %s SET brewPaid='1', brewUpdated=NOW( ) WHERE id='%s'", $prefix . "brewing", $entry_id);
        mysqli_real_escape_string($connection, $updateSQL);
        mysqli_query($connection, $updateSQL) or die(mysqli_error($connection));
    }
}

function sendCustomerEmail(
    array $entry_ids,
    string $to_email,
    string $to_recipient,
    int $payment_type,
    string $display_payer_email,
    string $item_name,
    string $payment_status,
    $payment_amount,
    string $payment_currency,
    string $transaction_id,
    // OPTIONALS
    string $cc_email = null,
    string $cc_recipient = null,
    bool $test_mode = false
) {
    global $base_url, $prefix, $connection, $mail_default_from, $label_amount, $label_entry_numbers, $label_paid, $label_email, $label_payer, $label_name, $label_status, $label_transaction_id, $paypal_response_text_000, $paypal_response_text_001, $paypal_response_text_002, $paypal_response_text_003, $paypal_response_text_009, $mail_use_smtp;

    // TODO: refactor out when needed for admin method below
    // TODO: use a prepared statement
    $query_logo = sprintf("SELECT contestName,contestLogo FROM %s WHERE id='1'", $prefix . "contest_info");
    $logo = mysqli_query($connection, $query_logo) or die(mysqli_error($connection));
    $row_logo = mysqli_fetch_assoc($logo);
    $totalRows_logo = mysqli_num_rows($logo);  // what is this count used for?


    foreach ($entry_ids as $value) {
        $display_entry_no[] = sprintf("%06s", $value);
    }

    $display_entry_numbers = implode(", ", $display_entry_no);
    $display_entry_numbers = rtrim($display_entry_numbers, ", ");

    $url = str_replace("www.", "", $_SERVER['SERVER_NAME']);
    $from_email = (!isset($mail_default_from) || trim($mail_default_from) === '') ? "noreply@" . $url : $mail_default_from;

    $headers  = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
    $headers .= "To: " . $to_recipient . " <" . $to_email . ">, " . "\r\n";
    $headers .= "Bcc: " . $cc_recipient . " <" . $cc_email . ">, " . "\r\n";
    $headers .= "From: " . $row_logo['contestName'] . " Server <" . $from_email . ">\r\n";

    $message_top = "";
    $message_body = "";
    $message_bottom = "";

    $message_top .= "<body>";
    $message_top .= "<html>";
    if ((isset($row_logo['contestLogo'])) && (file_exists(USER_IMAGES . $row_logo['contestLogo']))) $message_body .= "<p><img src='" . $base_url . "/user_images/" . $row_logo['contestLogo'] . "' height='150'></p>";
    $message_body .= "<p>" . $to_recipient . ",</p>";
    $message_body .= sprintf("<p>%s</p>", $paypal_response_text_000);
    $message_body .= sprintf("<p><strong>%s</strong></p>", $paypal_response_text_001);
    $message_body .= "<table cellpadding=\"5\" cellspacing=\"0\">";
    $message_body .= sprintf("<tr valign='top'><td nowrap><strong>%s %s:</strong></td><td>" . $to_recipient . "<td></tr>", $label_payer, $label_name);
    $message_body .= sprintf("<tr valign='top'><td nowrap><strong>%s %s:</strong></td><td>" . $display_payer_email . "<td></tr>", $label_payer, $label_email);
    $message_body .= sprintf("<tr valign='top'><td nowrap><strong>%s:</strong></td><td>" . $payment_status . "<td></tr>", $label_status);
    $message_body .= sprintf("<tr valign='top'><td nowrap><strong>%s:</strong></td><td>" . $payment_amount . " " . $payment_currency . "<td></tr>", $label_amount);
    $message_body .= sprintf("<tr valign='top'><td nowrap><strong>%s:</strong></td><td>" . $transaction_id . "<td></tr>", $label_transaction_id);
    $message_body .= sprintf("<tr valign='top'><td nowrap><strong>%s %s:</strong></td><td>" . $display_entry_numbers . "<td></tr>", $label_entry_numbers, $label_paid);
    $message_body .= "</table>";

    $message_body .= sprintf("<p>%s</p>", $paypal_response_text_002);
    $message_body .= sprintf("<p><small>%s</small></p>", $paypal_response_text_003);
    $message_bottom .= "</body>";
    $message_bottom .= "</html>";

    $message_all = $message_top . $message_body . $message_bottom;

    $test_text = "";
    if ($test_mode) {
        $test_text = "Test: ";
    }

    // Send the email message
    $subject = $test_text . " " . $item_name . " - " . ucwords($paypal_response_text_009);

    if ($mail_use_smtp) {
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->addAddress($to_email, $to_recipient);
        $mail->addCC($cc_email, $cc_recipient);
        $mail->setFrom($from_email, $row_logo['contestName']);
        $mail->Subject = $subject;
        $mail->Body = $message_all;
        sendPHPMailerMessage($mail);
    } else {
        mail($to_email, $subject, $message_all, $headers);
    }
}

function sendAdminConfirmationEmail()
{
    global $connection, $prefix;
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

    if (!empty($to_email)) {
        $message_body_confirm .= "<p>To: " . $to_recipient . "<br>" . "To Email: " . $to_email . "<br>" . "CC: " . $cc_recipient . "<br>" . "BCC Email: " . $cc_email . "</p>";
        $message_body_confirm .= $message_body;
        $message_body_confirm .= "<br>-----------------------------------</p>";
    }

    $message_body_confirm .= "<table border=\"0\" cellpadding=\"5\" cellspacing=\"0\">";
    $message_body_confirm .= "<tr><th>Variable</th><th>Value</th></tr>";
    $message_body_confirm .= "<tr><td width=\"150\">paypal_ipn_status</td><td>" . $paypal_ipn_status . "</td></tr>";
    $message_body_confirm .= "<tr><td width=\"150\">paypal_ipn_date</td><td>" . $current_date_time_display . "</td></tr>";
    if (!empty($data_text))    $message_body_confirm .= $data_text;
    $message_body_confirm .= "</table>";

    $message_bottom_confirm .= "</body>";
    $message_bottom_confirm .= "</html>";

    $message_all_confirm = $message_top_confirm . $message_body_confirm . $message_bottom_confirm;

    $subject_confirm = "PayPal IPN: " . $paypal_ipn_status;

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
