<?php

use GuzzleHttp\Client;
use GuzzleHttp\Promise\Utils;
use Psr\Http\Message\ResponseInterface;

require_once __DIR__ . '/../vendor/autoload.php';

$sequenceStop = (int) ($argv[2] ?? (empty((int) $argv[1]) ? 3 : $argv[1]));
$sequenceStart = (int) (isset($argv[2]) ? $argv[1] : 0);

$sleepingUrl = getenv('SLEEPING_URL') ?: "http://localhost:3000";
$client = new Client();
$printResponse = fn(ResponseInterface $response) => print($response->getBody()->getContents() . PHP_EOL);

echo "Sequence: {$sequenceStart} .. {$sequenceStop}" . PHP_EOL;

for($i = $sequenceStart; $i <= $sequenceStop; $i++) {
    Utils::task(
        fn() => $client->getAsync("{$sleepingUrl}/{$i}")
            ->then($printResponse)
            ->wait()
    );
}

echo 'end' . PHP_EOL;
