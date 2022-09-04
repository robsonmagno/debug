<?php

declare(strict_types=1);

namespace Rmagnoprado\Debug;

ob_start();
require 'vendor/autoload.php';

$request = '{
    "Field":"Value",
    "NewField":"New Value"
}';
$header = [
    'Content-type' => 'application/json',
    'Accept' => 'application/json',
    'Cache-Control' => 'no-cache',
    'Pragma' => 'no-cache',
];
$json = (string) json_encode(['header' => $header,'body' => json_decode($request)]);
$debug = new Main();
$debug->getHeader($json);
$debug->getBody($json);
$debug->getScript($json);
