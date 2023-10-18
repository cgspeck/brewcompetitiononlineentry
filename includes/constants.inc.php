<?php

/** -------------------------- Languages Available ----------------------------------------------
 * Array of languages available for translation
 * Associative array of available translation languages.
 * First in the pair is the label name (should be in native language)
 * Second in the pair is the official WWW3 language tag, exactly as it appears there
 * This WWW3 language tag should be the beginining of the language file (e.g., en-US.lang.php)
 * See https://www.loc.gov/standards/iso639-2/php/code_list.php
 * located in its parent language subfolder in the lang folder (e.g., /lang/en/)
 * More at https://www.w3.org/International/articles/language-tags/
 *
 */

$languages = array(
    "pt-BR" => "Brazilian Portuguese",
    "cs-CZ" => "Czech",
    "en-US" => "English (US)",
    "fr-FR" => "French",
    "es-419" => "Spanish (Latin America)"
);

/** -------------------------- Theme File names and  Display Name -------------------------------
 * The first item is the the CSS file name (without .css)
 * The second item is the display name for use in Site Preferences
 * The file name will be stored in the preferences DB table row called prefsTheme and called by all pages
 */

$theme_name = array(
    "default" => "BCOE&amp;M Default (Gray)",
    "bruxellensis" => "Bruxellensis (Blue-Gray)",
    "claussenii" => "Claussenii (Green)",
    "naardenensis" => "Naardenensis (Teal)"
);

// -------------------------- Countries List ----------------------------------------------------
// Array of countries to utilize when users sign up and for competition info
// Replaces countries DB table for better performance

$countries = array("Australia","New Zealand","United Kingdom","Canada","United States","Ireland","Afghanistan","Albania","Algeria","American Samoa","Andorra","Angola","Anguilla","Antarctica","Antigua and Barbuda","Argentina","Armenia","Aruba","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia and Herzegovina","Botswana","Bouvet Island","Brazil","British Indian Ocean Territory","Brunei Darussalam","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Cape Verde","Cayman Islands","Central African Republic","Chad","Chile","China","Christmas Island","Cocos (Keeling) Islands","Colombia","Comoros","Congo","Congo, The Democratic Republic of The","Cook Islands","Costa Rica","Cote D'ivoire","Croatia","Cuba","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Easter Island","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands (Malvinas)","Faroe Islands","Fiji","Finland","France","French Guiana","French Polynesia","French Southern Territories","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guadeloupe","Guam","Guatemala","Guinea","Guinea-bissau","Guyana","Haiti","Heard Island and Mcdonald Islands","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Israel","Italy","Jamaica","Japan","Jordan","Kazakhstan","Kenya","Kiribati","Korea, North","Korea, South","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libyan Arab Jamahiriya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Martinique","Mauritania","Mauritius","Mayotte","Mexico","Micronesia, Federated States of","Moldova, Republic of","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauru","Nepal","Netherlands","Netherlands Antilles","New Caledonia","Nicaragua","Niger","Nigeria","Niue","Norfolk Island","Northern Mariana Islands","Norway","Oman","Pakistan","Palau","Palestinian Territory","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Pitcairn","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Russia","Rwanda","Saint Helena","Saint Kitts and Nevis","Saint Lucia","Saint Pierre and Miquelon","Saint Vincent and The Grenadines","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia and Montenegro","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Georgia/South Sandwich Islands","Spain","Sri Lanka","Sudan","Suriname","Svalbard and Jan Mayen","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania, United Republic of","Thailand","Timor-leste","Togo","Tokelau","Tonga","Trinidad and Tobago","Tunisia","Turkey","Turkmenistan","Turks and Caicos Islands","Tuvalu","Uganda","Ukraine","United Arab Emirates","United States Minor Outlying Islands","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Virgin Islands, British","Virgin Islands, U.S.","Wallis and Futuna","Western Sahara","Yemen","Zambia","Zimbabwe","Other");

$us_state_abbrevs_names = array(
    'AL' => 'Alabama',
    'AK' => 'Alaska',
    'AS' => 'American Samoa',
    'AZ' => 'Arizona',
    'AR' => 'Arkansas',
    'CA' => 'California',
    'CO' => 'Colorado',
    'CT' => 'Connecticut',
    'DE' => 'Delaware',
    'DC' => 'District of Columbia',
    'FL' => 'Florida',
    'FM' => 'Federated States of Micronesia',
    'GA' => 'Georgia',
    'GU' => 'Guam',
    'HI' => 'Hawaii',
    'ID' => 'Idaho',
    'IL' => 'Illinois',
    'IN' => 'Indiana',
    'IA' => 'Iowa',
    'KS' => 'Kansas',
    'KY' => 'Kentucky',
    'LA' => 'Louisiana',
    'ME' => 'Maine',
    'MD' => 'Maryland',
    'MA' => 'Massachusetts',
    'MH' => 'Marshall Islands',
    'MI' => 'Michigan',
    'MN' => 'Minnesota',
    'MP' => 'Northern Mariana Islands',
    'MS' => 'Mississippi',
    'MO' => 'Missouri',
    'MT' => 'Montana',
    'NE' => 'Nebraska',
    'NV' => 'Nevada',
    'NH' => 'New Hampshire',
    'NJ' => 'New Jersey',
    'NM' => 'New Mexico',
    'NY' => 'New York',
    'NC' => 'North Carolina',
    'ND' => 'North Dakota',
    'OH' => 'Ohio',
    'OK' => 'Oklahoma',
    'OR' => 'Oregon',
    'PA' => 'Pennsylvania',
    'PR' => 'Puerto Rico',
    'PW' => 'Palau',
    'RI' => 'Rhode Island',
    'SC' => 'South Carolina',
    'SD' => 'South Dakota',
    'TN' => 'Tennessee',
    'TX' => 'Texas',
    'UT' => 'Utah',
    'VT' => 'Vermont',
    'VI' => 'Virgin Islands',
    'VA' => 'Virginia',
    'WA' => 'Washington',
    'WV' => 'West Virginia',
    'WI' => 'Wisconsin',
    'WY' => 'Wyoming'
);

$ca_state_abbrevs_names = array(
    'AB' => 'Alberta', 
    'BC' => 'British Columbia', 
    'MB' => 'Manitoba', 
    'NB' => 'New Brunswick', 
    'NL' => 'Newfoundland and Labrador', 
    'NT' => 'Northwest Territories', 
    'NS' => 'Nova Scotia', 
    'NU' => 'Nunavut',
    'ON' => 'Ontario', 
    'PE' => 'Prince Edward Island', 
    'QC' => 'Quebec', 
    'SK' => 'Saskatchewan', 
    'YT' => 'Yukon Territory'
);

$aus_state_abbrevs_names = array(
    'ACT' => 'Australian Capital Territory',
    'NSW' => 'New South Wales',
    'NT' => 'Northern Territory',
    'QLD' => 'Queensland',
    'SA' => 'South Australia',
    'TAS' => 'Tasmania',
    'VIC' => 'Victoria',
    'WA' => 'Western Australia'
);

// -------------------------- Tie break rules ---------------------------------------------------
// List of existing rules for the tie break for ordering the best brewers.
// The order of the rules will be chosen during setup
$tie_break_rules = array(
    "",
    "TBTotalPlaces",
    "TBTotalExtendedPlaces",
    "TBFirstPlaces",
    "TBNumEntries",
    "TBMinScore",
    "TBMaxScore",
    "TBAvgScore"
    //,"TBRandom"
);

/**
 * -------------------------- Clubs List ---------------------------
 * Future release:
 * Convert the array to JSON array and move to contest_info DB table - 
 * contestClubs column.
 * 
 * Updated June 27, 2023
 */

$club_array = array(
    "Westgate Brewers",
    // rest of the Victorian clubs
    "Ballarat and Region Craft Brewers (B.A.R)",
    "Bayside Brewers",
    "Bendigo and Districts Home Brew Club (BAD)",
    "Geelong Craft Brewers",
    "Grog Cobras - Geelong",
    "Macedon Ranges Brew Club",
    "Melbourne Brewers",
    "Merri Mashers",
    "Peninsula Brewers Union (PBU)",
    "Small Batch Home Brew Club",
    "Way Out West",
    "Yarra Valley Brewers",
    // non-Victorian clubs which apppeared in recently published-results
    "---",
    "Brisbane Amateur Beer Brewers (BABBs)",
    "Brisbane Brewers Club (BBC)",
    "Canberra Brewers Club",
    "Central Queensland Craft Brewers (CQCB)",
    "Darwin And NT Homebrewers",
    "GoldCLUB [QLD]",
    "Inner Sydney Brewers (ISB)",
    "Inner West Homebrewers Club",
    "Ipswich Brewers Union (IBU)",
    "Noosa Home Brew Club",
    "Northern Brewers Homebrew Club [WA]",
    "Perth Home Brew Share (PHBS)",
    "Pine Rivers Underground Brewing Society (PUBS)",
    "Righteous Brewers of Townsville (RBT)",
    "South Australian Brewing Club",
    "South West Brew & Co. [WA]",
    "Toowoomba Society Of Beer Appreciation (TooSOBA)",
    "Tuns of Anarchy [QLD]",
    "West Coast Brewers",
    "Western Sydney Brewers",
    /* 
    clubs which did not appear in published results from other comps
    but existed in upstream source code
    */
    "---",
    "Amateur Winemakers and Brewers Club of Adelaide",
    "Brewmasters Grafton",
    "Brewversity",
    "Bubbles n Chalk brew club (BnC)",
    "Central Coast Brewers",
    "Coffs Region Amateur Brewers",
    "Extra Special Brewers (ESB)",
    "Fraser Coast Bayside Brewers",
    "Hills Brewers Guild",
    "Hobart Brewers",
    "Hunter All Grain (HAG)",
    "Hunter United Brewers (HUB)",
    "Illawarra Brewers Union (IBUs)",
    "Ipswich Brewers Union (IBU)",
    "Lockyer Amateur Brewer’s Guild (LABG)",
    "Macarthur Ale and Lager Enthusiasts - NSW",
    "Macedon Ranges Brew Club",
    "Mackay And District (MAD) Brewers",
    "Northern Beaches Homebrew Club",
    "Northside Wine/Beermakers Circ",
    "Redwood Coast Brewers",
    "Small Batch Home Brew Club",
    "Southern Lager & Ale Brewers (SLABs)",
    "Sunshine Coast Amateur Brewers (SCABs)",
    "Tamworth & New England Craft Brewers",
    "Tasmanian Brewers Club",
    "The Border Brewers",
    "Toowoomba Society Of Beer Appreciation (TooSOBA)",
    "West Aussie Brew Crew"
);

$sidebar_date_format = "short";
$suggested_open_date = time();
$suggested_close_date = time() + 604800;

if (((strpos($section, "step") === FALSE) && ($section != "setup")) && ($section != "update")) {

    if ((isset($row_contest_dates)) && (!empty($row_contest_dates))) {

        $reg_closed_date = $row_contest_dates['contestRegistrationDeadline'];
        $entry_closed_date = $row_contest_dates['contestEntryDeadline'];

        $registration_open = open_or_closed(time(), $row_contest_dates['contestRegistrationOpen'], $row_contest_dates['contestRegistrationDeadline']);
        $entry_window_open = open_or_closed(time(), $row_contest_dates['contestEntryOpen'], $row_contest_dates['contestEntryDeadline']);
        $judge_window_open = open_or_closed(time(), $row_contest_dates['contestJudgeOpen'], $row_contest_dates['contestJudgeDeadline']);
        if ((!empty($row_contest_dates['contestDropoffOpen'])) && (!empty($row_contest_dates['contestDropoffDeadline']))) $dropoff_window_open = open_or_closed(time(), $row_contest_dates['contestDropoffOpen'], $row_contest_dates['contestDropoffDeadline']);
        else $dropoff_window_open = 1;
        if ((!empty($row_contest_dates['contestShippingOpen'])) && (!empty($row_contest_dates['contestShippingDeadline']))) $shipping_window_open = open_or_closed(time(), $row_contest_dates['contestShippingOpen'], $row_contest_dates['contestShippingDeadline']);
        else $shipping_window_open = 1;
        
        $judging_past = judging_date_return();
        $judging_started = FALSE;

        if ((check_setup($prefix."judging_locations",$database)) && (check_update("judgingDateEnd", $prefix."judging_locations"))) {

            $query_judging_dates = sprintf("SELECT judgingDate,judgingDateEnd FROM %s",$judging_locations_db_table);
            $judging_dates = mysqli_query($connection,$query_judging_dates) or die (mysqli_error($connection));
            $row_judging_dates = mysqli_fetch_assoc($judging_dates);
            $totalRows_judging_dates = mysqli_num_rows($judging_dates);

            $date_arr = array();
            $first_judging_date = "";
            $last_judging_date = "";

            if ($totalRows_judging_dates > 0) {
                do {
                    if (!empty($row_judging_dates['judgingDate'])) $date_arr[] = $row_judging_dates['judgingDate'];
                    if (!empty($row_judging_dates['judgingDateEnd'])) $date_arr[] = $row_judging_dates['judgingDateEnd'];
                } while($row_judging_dates = mysqli_fetch_assoc($judging_dates));
            }

            if (!empty($date_arr)) {
                $first_judging_date = min($date_arr);
                $last_judging_date = max($date_arr);
                if (time() > $first_judging_date) {
                    $judging_started = TRUE;
                    $reg_closed_date = $first_judging_date;
                    $entry_closed_date = $first_judging_date;
                }
            }
            
            $pay_window_open = open_or_closed(time(),$row_contest_dates['contestEntryOpen'],$last_judging_date);

        }
        
        /**
         * If any judging session has started, close the entry
         * and account registration windows.
         * This ensures that any entries that are being judged 
         * aren't modified or deleted by non-admin users.
         */
        
        if ($judging_started) {
            $entry_window_open = 2;
            $registration_open = 2;
        }

        if (strpos($_SESSION['prefsLanguage'],"en-") !== false) $sidebar_date_format = "long";

        $reg_open = getTimeZoneDateTime($_SESSION['prefsTimeZone'], $row_contest_dates['contestRegistrationOpen'], $_SESSION['prefsDateFormat'], $_SESSION['prefsTimeFormat'], $sidebar_date_format, "date-time");
        $reg_closed = getTimeZoneDateTime($_SESSION['prefsTimeZone'], $reg_closed_date, $_SESSION['prefsDateFormat'], $_SESSION['prefsTimeFormat'], $sidebar_date_format, "date-time");
        $reg_open_sidebar = getTimeZoneDateTime($_SESSION['prefsTimeZone'], $row_contest_dates['contestRegistrationOpen'], $_SESSION['prefsDateFormat'], $_SESSION['prefsTimeFormat'], "short", "date-time");
        $reg_closed_sidebar = getTimeZoneDateTime($_SESSION['prefsTimeZone'], $reg_closed_date, $_SESSION['prefsDateFormat'],  $_SESSION['prefsTimeFormat'], "short", "date-time");

        $entry_open = getTimeZoneDateTime($_SESSION['prefsTimeZone'], $row_contest_dates['contestEntryOpen'], $_SESSION['prefsDateFormat'],  $_SESSION['prefsTimeFormat'], $sidebar_date_format, "date-time");
        $entry_closed = getTimeZoneDateTime($_SESSION['prefsTimeZone'], $entry_closed_date, $_SESSION['prefsDateFormat'],$_SESSION['prefsTimeFormat'], $sidebar_date_format, "date-time");
        $entry_open_sidebar = getTimeZoneDateTime($_SESSION['prefsTimeZone'], $row_contest_dates['contestEntryOpen'], $_SESSION['prefsDateFormat'],  $_SESSION['prefsTimeFormat'], "short", "date-time");
        $entry_closed_sidebar = getTimeZoneDateTime($_SESSION['prefsTimeZone'], $entry_closed_date, $_SESSION['prefsDateFormat'],$_SESSION['prefsTimeFormat'], "short", "date-time"); 

        $dropoff_open = getTimeZoneDateTime($_SESSION['prefsTimeZone'], $row_contest_dates['contestDropoffOpen'], $_SESSION['prefsDateFormat'],  $_SESSION['prefsTimeFormat'], $sidebar_date_format, "date-time");
        $dropoff_closed = getTimeZoneDateTime($_SESSION['prefsTimeZone'], $row_contest_dates['contestDropoffDeadline'], $_SESSION['prefsDateFormat'],$_SESSION['prefsTimeFormat'], $sidebar_date_format, "date-time");
        $dropoff_open_sidebar = getTimeZoneDateTime($_SESSION['prefsTimeZone'], $row_contest_dates['contestDropoffOpen'], $_SESSION['prefsDateFormat'],  $_SESSION['prefsTimeFormat'], "short", "date-time");
        $dropoff_closed_sidebar = getTimeZoneDateTime($_SESSION['prefsTimeZone'], $row_contest_dates['contestDropoffDeadline'], $_SESSION['prefsDateFormat'],$_SESSION['prefsTimeFormat'], "short", "date-time");

        $shipping_open = getTimeZoneDateTime($_SESSION['prefsTimeZone'], $row_contest_dates['contestShippingOpen'], $_SESSION['prefsDateFormat'],  $_SESSION['prefsTimeFormat'], $sidebar_date_format, "date-time");
        $shipping_closed = getTimeZoneDateTime($_SESSION['prefsTimeZone'], $row_contest_dates['contestShippingDeadline'], $_SESSION['prefsDateFormat'],$_SESSION['prefsTimeFormat'], $sidebar_date_format, "date-time");
        $shipping_open_sidebar = getTimeZoneDateTime($_SESSION['prefsTimeZone'], $row_contest_dates['contestShippingOpen'], $_SESSION['prefsDateFormat'],  $_SESSION['prefsTimeFormat'], "short", "date-time");
        $shipping_closed_sidebar = getTimeZoneDateTime($_SESSION['prefsTimeZone'], $row_contest_dates['contestShippingDeadline'], $_SESSION['prefsDateFormat'],$_SESSION['prefsTimeFormat'], "short", "date-time");

        $judge_open = getTimeZoneDateTime($_SESSION['prefsTimeZone'], $row_contest_dates['contestJudgeOpen'], $_SESSION['prefsDateFormat'],  $_SESSION['prefsTimeFormat'], $sidebar_date_format, "date-time");
        $judge_closed = getTimeZoneDateTime($_SESSION['prefsTimeZone'], $row_contest_dates['contestJudgeDeadline'], $_SESSION['prefsDateFormat'],$_SESSION['prefsTimeFormat'], $sidebar_date_format, "date-time");

        $judge_open_sidebar = getTimeZoneDateTime($_SESSION['prefsTimeZone'], $row_contest_dates['contestJudgeOpen'], $_SESSION['prefsDateFormat'],  $_SESSION['prefsTimeFormat'], "short", "date-time");
        $judge_closed_sidebar = getTimeZoneDateTime($_SESSION['prefsTimeZone'], $row_contest_dates['contestJudgeDeadline'], $_SESSION['prefsDateFormat'],$_SESSION['prefsTimeFormat'], "short", "date-time");
    
        if ($_SESSION['prefsEval'] == 1) {

            if ((empty($row_judging_prefs['jPrefsJudgingOpen'])) || (empty($row_judging_prefs['jPrefsJudgingClosed']))) {
                
                
                if (!empty($date_arr)) {
                    $suggested_open_date = min($date_arr); // Get the start time of the first judging location chronologically
                    $suggested_close_date = (max($date_arr) + 28800); // Add eight hours to the start time at the final judging location
                }
                
                else {
                    $suggested_close_date = (time()  + 28800);
                    $suggested_open_date = time();
                }

                if (empty($row_judging_prefs['jPrefsJudgingOpen'])) $judging_evals_open = getTimeZoneDateTime($_SESSION['prefsTimeZone'], $suggested_open_date, $_SESSION['prefsDateFormat'],  $_SESSION['prefsTimeFormat'], $sidebar_date_format, "date-time");
                else $judging_evals_open = getTimeZoneDateTime($_SESSION['prefsTimeZone'], $row_judging_prefs['jPrefsJudgingOpen'], $_SESSION['prefsDateFormat'], $_SESSION['prefsTimeFormat'], $sidebar_date_format, "date-time");
                if (empty($row_judging_prefs['jPrefsJudgingClosed'])) $judging_evals_closed = getTimeZoneDateTime($_SESSION['prefsTimeZone'], $suggested_close_date, $_SESSION['prefsDateFormat'],$_SESSION['prefsTimeFormat'], $sidebar_date_format, "date-time");
                else $judging_evals_closed = getTimeZoneDateTime($_SESSION['prefsTimeZone'], $row_judging_prefs['jPrefsJudgingClosed'], $_SESSION['prefsDateFormat'],$_SESSION['prefsTimeFormat'], $sidebar_date_format, "date-time");

            }

            else {
                $judging_evals_open = getTimeZoneDateTime($_SESSION['prefsTimeZone'], $row_judging_prefs['jPrefsJudgingOpen'], $_SESSION['prefsDateFormat'], $_SESSION['prefsTimeFormat'], $sidebar_date_format, "date-time");
                $judging_evals_closed = getTimeZoneDateTime($_SESSION['prefsTimeZone'], $row_judging_prefs['jPrefsJudgingClosed'], $_SESSION['prefsDateFormat'],$_SESSION['prefsTimeFormat'], $sidebar_date_format, "date-time");
            }
            
        }

        $currency = explode("^",currency_info($_SESSION['prefsCurrency'],1));
        $currency_symbol = $currency[0];
        $currency_code = $currency[1];

        $totalRows_entry_count = total_paid_received("",0);
        $total_entries = $totalRows_entry_count;
        $total_paid = get_entry_count("paid");
        $comp_paid_entry_limit = FALSE;
        $comp_entry_limit = FALSE;

        if (isset($totalRows_entry_count)) {
            if ((!empty($row_limits['prefsEntryLimit'])) && ($totalRows_entry_count >= $row_limits['prefsEntryLimit'])) $comp_entry_limit = TRUE;
            if ((!empty($row_limits['prefsEntryLimitPaid'])) && ($total_paid >= $row_limits['prefsEntryLimitPaid'])) $comp_paid_entry_limit = TRUE;
        }

        if (!empty($row_limits['prefsEntryLimit'])) $comp_entry_limit_near = ($row_limits['prefsEntryLimit']*.9); else $comp_entry_limit_near = "";
        if ((!empty($row_limits['prefsEntryLimit'])) && (($total_entries > $comp_entry_limit_near) && ($total_entries < $row_limits['prefsEntryLimit']))) $comp_entry_limit_near_warning = TRUE; else $comp_entry_limit_near_warning = FALSE;

        $remaining_entries = 0;
        if ((($section == "brew") || ($section == "list") || ($section == "pay")) && (!empty($row_limits['prefsUserEntryLimit']))) $remaining_entries = ($row_limits['prefsUserEntryLimit'] - $totalRows_log);
        else $remaining_entries = 1;

        if (open_limit($row_judge_count['count'],$row_judging_prefs['jPrefsCapJudges'],$judge_window_open)) $judge_limit = TRUE;
        else $judge_limit = FALSE;

        if (open_limit($row_steward_count['count'],$row_judging_prefs['jPrefsCapStewards'],$judge_window_open)) $steward_limit = TRUE;
        else $steward_limit = FALSE;

        if (($judge_limit) && ($steward_limit)) $judge_window_open = 2;
        if (($comp_entry_limit) || ($comp_paid_entry_limit)) $entry_window_open = 2;

        $current_date = getTimeZoneDateTime($_SESSION['prefsTimeZone'], time(), $_SESSION['prefsDateFormat'], $_SESSION['prefsTimeFormat'], "system", "date");
        $current_date_display = getTimeZoneDateTime($_SESSION['prefsTimeZone'], time(), $_SESSION['prefsDateFormat'], $_SESSION['prefsTimeFormat'], $sidebar_date_format, "date");
        $current_time = getTimeZoneDateTime($_SESSION['prefsTimeZone'], time(), $_SESSION['prefsDateFormat'], $_SESSION['prefsTimeFormat'], "system", "time-gmt");

    } // end if ((isset($row_contest_dates)) && (!empty($row_contest_dates)))

}

else {

    if (($section == "step4") || ($section == "step5") || ($section == "step6")) {

        $query_prefs_tz = sprintf("SELECT prefsTimeZone,prefsDateFormat,prefsTimeFormat FROM %s WHERE id='1'", $prefix."preferences");
        $prefs_tz = mysqli_query($connection,$query_prefs_tz) or die (mysqli_error($connection));
        $row_prefs_tz = mysqli_fetch_assoc($prefs_tz);

        $current_date = getTimeZoneDateTime($row_prefs_tz['prefsTimeZone'], time(), $row_prefs_tz['prefsDateFormat'], $row_prefs_tz['prefsTimeFormat'], "system", "date");
        $current_date_display = getTimeZoneDateTime($row_prefs_tz['prefsTimeZone'], time(), $row_prefs_tz['prefsDateFormat'], $row_prefs_tz['prefsTimeFormat'], $sidebar_date_format, "date");
        $current_time = getTimeZoneDateTime($row_prefs_tz['prefsTimeZone'], time(), $row_prefs_tz['prefsDateFormat'], $row_prefs_tz['prefsTimeFormat'], "system", "time-gmt");

    }

}

$logged_in = FALSE;
$admin_user = FALSE;
$disable_pay = FALSE;
$show_scores = FALSE;
$show_scoresheets = FALSE;
$show_presentation = FALSE;

// User constants
if (isset($_SESSION['loginUsername']))  {

	$logged_in = TRUE;
	$logged_in_name = $_SESSION['loginUsername'];

    if (((strpos($section, "step") === FALSE) && ($section != "setup")) && ($section != "update")) {

        if ($_SESSION['userLevel'] <= "1") {
    		if ($section == "admin") $link_admin = "#";
    		else $link_admin = "";
    		$admin_user = TRUE;
    	}

		// Get Entry Fees
	   $total_entry_fees = total_fees($_SESSION['contestEntryFee'], $_SESSION['contestEntryFee2'], $_SESSION['contestEntryFeeDiscount'], $_SESSION['contestEntryFeeDiscountNum'], $_SESSION['contestEntryCap'], $_SESSION['contestEntryFeePasswordNum'], $_SESSION['user_id'], $filter, $_SESSION['comp_id']);
       if ($bid == "default") $user_id_paid = $_SESSION['user_id'];
       else $user_id_paid = $bid;
	   $total_paid_entry_fees = total_fees_paid($_SESSION['contestEntryFee'], $_SESSION['contestEntryFee2'], $_SESSION['contestEntryFeeDiscount'], $_SESSION['contestEntryFeeDiscountNum'], $_SESSION['contestEntryCap'], $_SESSION['contestEntryFeePasswordNum'], $user_id_paid, $filter, $_SESSION['comp_id']);
	   $total_to_pay = $total_entry_fees - $total_paid_entry_fees;

		// Disable pay?
		if (($registration_open == 2) && ($shipping_window_open == 2) && ($dropoff_window_open == 2) && ($entry_window_open == 2) && ($pay_window_open == 2)) $disable_pay = TRUE;

	}

}

if ((strpos($section, "step") === FALSE) && ($section != "setup") && ($judging_past == 0)) {
    if (($_SESSION['prefsDisplayWinners'] == "Y") && (judging_winner_display($_SESSION['prefsWinnerDelay']))) {
        $show_presentation = TRUE;
        if ($logged_in) {
            $show_scores = TRUE;
            $show_scoresheets = TRUE;
        }
    }
}

// DataTables Default Values
$output_datatables_bPaginate = "true";
$output_datatables_sPaginationType = "full_numbers";
$output_datatables_bLengthChange = "true";
if ((strpos($section, "step") === FALSE) && ($section != "setup")) $output_datatables_iDisplayLength = round($_SESSION['prefsRecordPaging']);
if ($action == "print") $output_datatables_sDom = "it";
else $output_datatables_sDom = "rftp";
$output_datatables_bStateSave = "false";
$output_datatables_bProcessing = "false";

// Disable stuff on participants, entries, tables, and other screens when looking at archived data
$archive_display = FALSE;
if ($dbTable != "default") $archive_display = TRUE;

$totalRows_mods = "";

// Get unconfirmed entry count
if (((strpos($section, "step") === FALSE) && ($section != "setup")) && ($section != "update")) {
    if (($section == "admin") && (($filter == "default") && ($bid == "default") && ($view == "default"))) $entries_unconfirmed = ($totalRows_entry_count - $totalRows_log_confirmed);
    else $entries_unconfirmed = ($totalRows_log - $totalRows_log_confirmed);
}

$barcode_qrcode_array = array("0","2","N","C","3","4","5","6","1");
$no_entry_form_array = array("0","1","2","E","C");

if ($logged_in) $location_target = "_blank";
else $location_target = "_self";

if ((isset($_SESSION['prefsStyleSet'])) && ($_SESSION['prefsStyleSet'] == "BA")) $optional_info_styles = array();
elseif ((isset($_SESSION['prefsStyleSet'])) && ($_SESSION['prefsStyleSet'] == "AABC")) $optional_info_styles = array("12-01","14-08","17-03","18-04","18-05","19-05","19-07","16-01","19-01","19-02","19-03","19-04","19-06","20-02","20-03");
elseif ((isset($_SESSION['prefsStyleSet'])) && ($_SESSION['prefsStyleSet'] == "NWCiderCup")) {
$optional_info_styles = array("C4-A","C4-B","C5-A","C8-A","C8-B","C8-C","C9-A","C9-B","C9-C");
}

else {
    $optional_info_styles = array("21-B","28-A","30-B","33-A","33-B","34-B","M2-C","M2-D","M2-E","M3-A","M3-B","M4-B","M4-C","7-C","M1-A","M1-B","M1-C","M2-A","M2-B","M4-A","C1-A","C1-B","C1-C");
    if ((isset($_SESSION['prefsStyleSet'])) && ($_SESSION['prefsStyleSet'] == "BJCP2021")) $optional_info_styles[] = "25-B";
}

$results_method = array("0" => "By Table/Medal Group", "1" => "By Style", "2" => "By Sub-Style");

if (HOSTED) $_SESSION['prefsCAPTCHA'] = 1;

// Load libraries only when needed - for performance
$tinymce_load = array("contest_info","default","step4","default");
$datetime_load = array("contest_info","evaluation","testing","preferences","step4","step5","step6","default","judging","judging_preferences","dates","non-judging");
$datatables_load = array("admin","list","default","step4","evaluation");

$specialty_ipa_subs = array();
$historical_subs = array();

if (isset($_SESSION['prefsStyleSet'])) {
    // Set vars for backwards compatibility
    if (isset($_SESSION['style_set_beer_end'])) $beer_end = $_SESSION['style_set_beer_end'];
    if (isset($_SESSION['style_set_mead'])) $mead_array = $_SESSION['style_set_mead'];
    if (isset($_SESSION['style_set_cider'])) $cider_array = $_SESSION['style_set_cider'];
    if (isset($_SESSION['style_set_category_end'])) $category_end = $_SESSION['style_set_category_end'];
    if (($_SESSION['prefsStyleSet'] == "BJCP2015") || ($_SESSION['prefsStyleSet'] == "BJCP2021")) {
        $specialty_ipa_subs = array("21-B1","21-B2","21-B3","21-B4","21-B5","21-B6","21-B7");
        $historical_subs = array("27-A1","27-A2","27-A3","27-A4","27-A5","27-A6","27-A7","27-A8","27-A9");
    }
}

$db_version = $connection -> server_info;
$db_maria = FALSE;
if (strpos(strtolower($db_version), "mariadb") !== false) $db_maria = TRUE;

if ((!isset($_SESSION['encryption_key'])) || (empty($_SESSION['encryption_key']))) $_SESSION['encryption_key'] = base64_encode(openssl_random_pseudo_bytes(32));
// $encryption_key = "8sQHfMk8rinRtA/Frhm+AWrSgOmkcbu+FxIUGy9Fq5I=";

/**
 * Failsafe for selected styles.
 * If the session variable is empty, check the DB table column.
 * If the column is empty, regenerate.
 * If the column has data, check if it JSON. If so, repopulate
 * session variable. If not, regenerate.
 */

$regenerate_selected_styles = FALSE;

if (empty($_SESSION['prefsSelectedStyles'])) {

    $query_selected_styles = sprintf("SELECT prefsSelectedStyles FROM %s WHERE id='1';",$prefix."preferences");
    $selected_styles = mysqli_query($connection,$query_selected_styles) or die (mysqli_error($connection));
    $row_selected_styles = mysqli_fetch_assoc($selected_styles);

    if (empty($row_selected_styles['prefsSelectedStyles'])) $regenerate_selected_styles = TRUE;
    else {
        
        $is_styles_json = json_decode($row_selected_styles['prefsSelectedStyles']);
        if (json_last_error() === JSON_ERROR_NONE) $styles_json_data = TRUE;
        else $styles_json_data = FALSE;

        if ($styles_json_data) $_SESSION['prefsSelectedStyles'] = $row_selected_styles['prefsSelectedStyles'];
        else $regenerate_selected_styles = TRUE;
    
    }

    if ($regenerate_selected_styles) {

        $update_selected_styles = array();
        $prefsStyleSet = $_SESSION['prefsStyleSet'];

        if (HOSTED) {
            
            $query_styles_default = sprintf("SELECT id, brewStyle, brewStyleGroup, brewStyleNum, brewStyleVersion FROM `bcoem_shared_styles` WHERE brewStyleVersion='%s'", $prefsStyleSet);
            $styles_default = mysqli_query($connection,$query_styles_default);
            $row_styles_default = mysqli_fetch_assoc($styles_default);

            if ($row_styles_default) {

                do {

                    $update_selected_styles[$row_styles_default['id']] = array(
                        'brewStyle' => $row_styles_default['brewStyle'],
                        'brewStyleGroup' => $row_styles_default['brewStyleGroup'],
                        'brewStyleNum' => $row_styles_default['brewStyleNum'],
                        'brewStyleVersion' => $row_styles_default['brewStyleVersion']
                    );

                } while($row_styles_default = mysqli_fetch_assoc($styles_default));

                    
            }
            
            $query_styles_custom = sprintf("SELECT id, brewStyle, brewStyleGroup, brewStyleNum, brewStyleVersion FROM %s WHERE brewStyleOwn='custom'", $prefix."styles");
            $styles_custom = mysqli_query($connection,$query_styles_custom);
            $row_styles_custom = mysqli_fetch_assoc($styles_custom);

            if ($row_styles_custom) {

                do {

                    $update_selected_styles[$row_styles_custom['id']] = array(
                        'brewStyle' => sterilize($row_styles_custom['brewStyle']),
                        'brewStyleGroup' => sterilize($row_styles_custom['brewStyleGroup']),
                        'brewStyleNum' => sterilize($row_styles_custom['brewStyleNum']),
                        'brewStyleVersion' => sterilize($row_styles_custom['brewStyleVersion'])
                    );

                } while($row_styles_custom = mysqli_fetch_assoc($styles_custom));

                
            }
        
        } // end if (HOSTED)
            
        else {

            $query_styles_default = sprintf("SELECT id, brewStyle, brewStyleGroup, brewStyleNum, brewStyleVersion FROM %s WHERE brewStyleVersion='%s'", $prefix."styles", $prefsStyleSet);
            $styles_default = mysqli_query($connection,$query_styles_default);
            $row_styles_default = mysqli_fetch_assoc($styles_default);

            if ($row_styles_default) {
                do {
                    $update_selected_styles[$row_styles_default['id']] = array(
                        'brewStyle' => sterilize($row_styles_default['brewStyle']),
                        'brewStyleGroup' => sterilize($row_styles_default['brewStyleGroup']),
                        'brewStyleNum' => sterilize($row_styles_default['brewStyleNum']),
                        'brewStyleVersion' => sterilize($row_styles_default['brewStyleVersion'])
                    );
                } while($row_styles_default = mysqli_fetch_assoc($styles_default));
            }

        } // end else

        $update_selected_styles = json_encode($update_selected_styles);

        $update_table = $prefix."preferences";
        $data = array(
            'prefsSelectedStyles' => $update_selected_styles
        );
        $db_conn->where ('id', 1);
        $result = $db_conn->update ($update_table, $data);
        if (!$result) {
            $error_output[] = $db_conn->getLastError();
            $errors = TRUE;
        }

        // Empty the prefs session variable
        // Will trigger the session to reset the variables in common.db.php upon reload after redirect
        unset($_SESSION['prefs'.$prefix_session]);

    }

}

?>