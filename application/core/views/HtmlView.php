<?php 
namespace application\core\views;

use application\core\View;

class HtmlView extends View {
    public function render($title, $vars =[]){
        extract($vars);
        $path = $this->route.'.php';
        if (file_exists($path)){
            ob_start();
            require $path;
            $content = ob_get_clean();
            require 'application/views/layouts/'.$this->layout.'.php';
        }
    }
    public static function errorCode($code){
        http_response_code($code);
        $path = 'application/views/errors/'.$code.'.php';
        if(file_exists($path)){
        require $path;
        }
        exit;
    }

    
}