<?php
declare(strict_types=1);

namespace Rmagnoprado\Debug;

require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Rmagnoprado\Debug\Main;

/** @MainTest */
class MainTest extends TestCase {

    public function test_show() : void{

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

        $this->assertIsString(
            $debug->getScript($json)
        );
    }

    public function test_getHeader() : void{

        $debug = new Main();

        $this->assertIsString(
            $debug->getHeader()
        );
    }

    public function test_getBody() : void{

        $debug = new Main();

        $this->assertIsString(
            $debug->getBody()
        );
    }
}