<?php

require_once(CONFIG."config.php");

include __DIR__.'/vendor/php-totp/Hotp.php';
include __DIR__.'/vendor/php-totp/Totp.php';
include __DIR__.'/vendor/php-totp/Base32.php';

use lfkeitel\phptotp\Totp;
use lfkeitel\phptotp\Base32;

function wg_make_link(string $path): string {
    global $wg_score_app_url;
    global $wg_score_app_comp_env;
    global $wg_score_app_topt_secret_key;

    if (!substr($path, -1) == "?") {
        $path = $path . "?";
    }

    $key = Base32::decode($wg_score_app_topt_secret_key);
    $tail = "comp_env=" . $wg_score_app_comp_env . "&token=" . (new Totp())->GenerateToken($key);
    // OMFG https://stackoverflow.com/a/4366748
    if (strpos($path, "?") !== false) {
        return $wg_score_app_url . $path . "&" . $tail;
    } else {
        return $wg_score_app_url . $path . "?" . $tail;
    }
}
