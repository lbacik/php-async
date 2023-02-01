<?php

require_once __DIR__ . '/../vendor/autoload.php';

$sleepingUrl = getenv('SLEEPING_URL') ?: "http://localhost:3000";

$multi = curl_multi_init();

$stillRunning = null;

$active = [];
for ($i = 1; $i <= 100; $i++) {
    $curl = curl_init($sleepingUrl);
    curl_multi_add_handle($multi, $curl);
}

do {
    $ret = curl_multi_exec($multi, $stillRunning);
} while ($ret == CURLM_CALL_MULTI_PERFORM);

while ($stillRunning && $ret === CURLM_OK) {
    if (curl_multi_select($multi) != -1) {
        do {
            $mrc = curl_multi_exec($multi, $stillRunning);
        } while ($mrc == CURLM_CALL_MULTI_PERFORM);
    }
}

