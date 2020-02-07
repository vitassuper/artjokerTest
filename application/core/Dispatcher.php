<?php

namespace application\core;

use application\core\views\HtmlView;

use applicaton\core\Route;



class Dispatcher{

    private $router;

    private $route;

    public function __construct($router){
        $this->router=$router;
    }

    public static function ErrorCode(){
        HtmlView::errorCode(404);
    }

    public function dispatch($request){
        try{
           $this->route=$this->router->findRoute($request);
           $controller=$this->route->controller;
           $model=$this->route->model;
           $action=$this->route->action;
           $view=$this->route->view;
           $controller = new $controller(new $model(), $view, $request, $this->route->params);
           $controller->$action();
        }catch(NotFoundException $exception){
            View::error();
        }
    }
}