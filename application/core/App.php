<?php

namespace application\core;

use application\core\Router;
use application\core\Dispatcher;
use application\core\ServerRequest;

class App{

    private $routes=[];

    public function __construct($config){
        $this->routes=$config['routes'];
    }

    protected function createRouter(array $routes){
        return new Router($routes);
    }

    protected function createDispatcher(Router $router){
        return new Dispatcher($router);
    }

    protected function createServerRequest(){
        return new ServerRequest();
    }

    public function run(){
        $router=$this->createRouter($this->routes);
        $dispatcher=$this->createDispatcher($router);
        $request = $this->createServerRequest();
        $dispatcher->dispatch($request);
    }
}