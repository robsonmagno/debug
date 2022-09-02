<?php
namespace Rmagnoprado\Debug;

ob_start();

require 'vendor/autoload.php';

use Rmagnoprado\Debug\Main;

$request = '{
    "Field":"Value",
    "NewField":"New Value"
}';            
    
$header = array(
    "Content-type" => "application/json",
    "Accept" => "application/json",
    "Cache-Control" => "no-cache",
    "Pragma" => "no-cache",
); 
$json = (string)json_encode(array('header'=>$header,'body'=>json_decode($request)));

$debug = new Main();
$debug->show($json);