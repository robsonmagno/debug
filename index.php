<?php

declare(strict_types=1);

namespace Rmagnoprado\Debug;

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
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Qr Code</title>
    <?php echo $debug->getHeader(); ?>
</head>
<body>
<h1>Teste Debug Client</h1>
<?php echo $debug->getBody(); ?>
<script>
<?php $debug->getScript($json); ?>
</script></body></html>
