<?php

require_once __DIR__ . '/../vendor/autoload.php';

$sleepingUrl = getenv('SLEEPING_URL') ?: "http://localhost:3000";

$multi = curl_multi_init();

$stillRunning = null;

for ($i = 0; $i <= 3; $i++) {
    $curl = curl_init("{$sleepingUrl}/{$i}");
    curl_multi_add_handle($multi, $curl);
}

do {
    $status = curl_multi_exec($multi, $stillRunning);
    if ($stillRunning) {
        curl_multi_select($multi);
    }
} while ($stillRunning && $status == CURLM_OK);
