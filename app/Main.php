<?php

declare(strict_types=1);

namespace Rmagnoprado\Debug;

require 'vendor/autoload.php';

class Main
{
    public function __construct()
    {
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
    public function __destruct()
    {
        //include(__DIR__."../../includes/Footer.php");
    }

    /**
     * Metodo responsável por mostrar os includes do html header
     *
     * @return string $retorno
     */
    public function getHeader(): string
    {
        return (string) file_get_contents(__DIR__.'../../includes/Header.php');
    }

    /**
     * Metodo responsável por mostrar o corpo html
     *
     * @return string $retorno
     */
    public function getBody(): string
    {
        return (string) file_get_contents(__DIR__.'../../includes/Body.php');
    }

    /**
     * Metodo responsável por mostrar o json e o tree view
     *
     * @return string $retorno
     */
    public function getScript(string $data): string
    {
        $rnd = rand(0, 100);

        $script = "<script>
        objTreeView = new treeView();
        var json = JSON.parse('$data');
        var objRoot = objTreeView.addNodeRoot(0, 'Node Raiz', 'vendor/rmagnoprado/debug/dist/Imagens/globe.gif', true);

        i = 0;

        // This function handles arrays and objects
        function eachRecursive(obj,node)
        {            
            Object.keys(obj).forEach(function(key) {
              
                if (typeof obj[key] === 'object') {
                    newNode = node.addNode(i, key, 'vendor/rmagnoprado/debug/dist/Imagens/base.gif', false);
                    i++;
                    eachRecursive(obj[key],newNode);                    
                }else{
                    node.addNode(i, obj[key], 'vendor/rmagnoprado/debug/dist/Imagens/page.gif', false);                   
                    i++;
                }
                
            });
        }
        eachRecursive(json,objRoot);
        document.getElementById('contentTreeViewDiv').innerHTML = objTreeView.contentHtml();    
        </script>
        ";
        
        echo $script;
        /*
        $options = "<p id=\"options{$rnd}\"><label>Opções:</label><br><label title=\"Generate node as collapsed\"> <input onclick=\"renderJson();\"  type=\"checkbox\" id=\"collapsed{$rnd}\"> Collapse nodes</label> <label title=\"Allow root element to be collasped\"> <input onclick=\"renderJson();\"  type=\"checkbox\" id=\"root-collapsable{$rnd}\" checked> Root collapsable</label> <label title=\"Surround keys with quotes\"> <input onclick=\"renderJson();\"  type=\"checkbox\" id=\"with-quotes{$rnd}\"> Keys with quotes</label> <label title=\"Generate anchor tags for URL values\"> <input onclick=\"renderJson();\"  type=\"checkbox\" id=\"with-links{$rnd}\" checked> With Links</label></p><pre id=\"json-renderer{$rnd}\"></pre>";

        $script = "<script src='vendor/rmagnoprado/debug/dist/jquery.json-viewer.js'></script><script>
                        document.getElementById('data').innerHTML = '<div id=\"{$rnd}\"class=\"data\">{$options}</div>';
                        
                        function renderJson() {
                            try {
                            var input = {$data};
                            }
                            catch (error) {
                            return alert(\"Cannot eval JSON: \" + error);
                            }
                            var options = {
                            collapsed: document.getElementById('collapsed{$rnd}').value,
                            rootCollapsable: document.getElementById('root-collapsable{$rnd}').value,
                            withQuotes: document.getElementById('with-quotes{$rnd}').value,
                            withLinks: document.getElementById('with-links{$rnd}').value
                            };
                            //document.getElementById('json-renderer{$rnd}').jsonViewer(input, options);
                        }
                        
                        // Generate on click
                        //$('#btn-json-viewer').click(renderJson);
                        
                        // Generate on option change
                        //document.getElementsByTagName('input').addEventListener('click', renderJson);

                        //$('#options{$rnd} input[type=checkbox]').click(renderJson);
                        
                        // Display JSON sample on page load
                        renderJson();
                       
                    </script>";

        echo $options.$script;
        */
        return '';
    }
}
