<?php
include(INCLUDES . "url_variables.inc.php");

function calculate_total_entry_fees()
{
    global $bid, $filter;
    return total_fees($_SESSION['contestEntryFee'], $_SESSION['contestEntryFee2'], $_SESSION['contestEntryFeeDiscount'], $_SESSION['contestEntryFeeDiscountNum'], $_SESSION['contestEntryCap'], $_SESSION['contestEntryFeePasswordNum'], $bid, $filter, $_SESSION['comp_id']);
}

function calculate_total_paid_entry_fees()
{
    global $bid, $filter;
    return total_fees_paid($_SESSION['contestEntryFee'], $_SESSION['contestEntryFee2'], $_SESSION['contestEntryFeeDiscount'], $_SESSION['contestEntryFeeDiscountNum'], $_SESSION['contestEntryCap'], $_SESSION['contestEntryFeePasswordNum'], $bid, $filter, $_SESSION['comp_id']);
}

function calculate_total_to_pay()
{
    return calculate_total_entry_fees() - calculate_total_paid_entry_fees();
}

function calculate_checkout_fees()
{
    return number_format(((calculate_total_to_pay() * .035) + .50), 2, '.', '');
}

function calculate_payment_amount()
{
    if ($_SESSION['prefsTransFee'] == "Y") {
        return (calculate_total_to_pay() + calculate_checkout_fees());
    }

    return calculate_total_to_pay();
}
