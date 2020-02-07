<?php
namespace application\core;

abstract class View {
    public $path;
    public $layout = 'default';
    public $route;

    public function __construct($route){
       $this->route=$route;
    }

    public function redirect($url) {
		header('location: /'.$url);
		exit;
	}

}