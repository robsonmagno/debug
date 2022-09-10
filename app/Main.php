<?php

namespace Rmagnoprado\Debug;

require 'vendor/autoload.php';

class Main {
    public function __construct() {
        
    }

    /**
     * Metodo responsável por mostrar os includes do html header
     * @return string $retorno
    */
    public function getHeader():string {
        return (string)file_get_contents(__DIR__."../../includes/Header.php");
    }
    
    /**
     * Metodo responsável por mostrar o corpo html
     * @return string $retorno
    */
    public function getBody():string {
        return (string)file_get_contents(__DIR__."../../includes/Body.php");
    }
    
    /**
     * Metodo responsável por mostrar o json e o tree view
     * @param string $data
     * @return string $retorno
    */
    public function getScript(string $data):string{
        $info = $this->montaTree($data);
        $retorno = "[{'text':'info', 'children': $info }]";

        $rnd = rand(0,100);
        echo "
            $('#data').append('<div id=\"$rnd\"class=\"data\"></div>');        
        ";

        echo "$('#$rnd').jstree({
            'core' : {
                'data': [{'text':'Info', 'state' : { 'opened' : true },'children': $info }]
            }
        });\n";
        return $retorno;
    }

    /**
     * Metodo responsável por montar o json do tree view
     * @param string $json
     * @return string $retorno
    */
    private function montaTree(string $json):string{
        $retorno = "";
        $matriz = json_decode($json,1);
        
        foreach($matriz as $key=>$value) {
            if(gettype($value)=='array'){
                $retorno .= '{"text":"'.$key.'","state" : { "opened" : true },"children":';
                $retorno .= $this->montaTree(json_encode($value))."},";
            }else{
                $retorno .= '{"text":"'.trim($value).'","icon" : "jstree-file"},';   
            }
        }

        return "[$retorno]";
    }

    public function getThree():string{
        return '<script src="vendor/vakata/jstree/dist/jstree.min.js"></script>';
    }   
    
    /* *
     * Metodo responsável por copiar a estrutura após instalação
     * @param Event $event
    * /
    
    public static function copyStructure(Event $event):void{

        $homeDir = (string)$event->getComposer()->getConfig()->get('home');
        $vendorDir = (string)$event->getComposer()->getConfig()->get('vendor-dir');


        foreach (glob('/vakata/jstree/dist/*') as $file) {
            if(!is_dir($file) && is_readable($file)) {
                $dest = realpath("dist" . DIRECTORY_SEPARATOR) . basename($file);
                copy($file, $dest);
            }
        }  

        @mkdir('tests');
        @mkdir('log');
        @mkdir('app');

        
        foreach (glob('/rmagnoprado/debug/php*') as $file) {
            if(!is_dir($file) && is_readable($file)) {
                $dest = realpath("dist" . DIRECTORY_SEPARATOR) . basename($file);
                copy($file, $dest);
            }
        }
        
        //copy($vendorDir.'/phpstan.neon', $homeDir.'/phpstan.neon');
        //copy($vendorDir.'/phpuntil.xml', $homeDir.'/phpuntil.xml');
    }
    */
    public function __destruct() {
        //include(__DIR__."../../includes/Footer.php");
    }
}