<?php

namespace application\core;

use application\exceptions\NotFoundException;
use application\core\Route;

class Router {
    protected $routes = [];
    protected $params = [];
    public $route;

    public function __construct($config){
        foreach ($config as $key => $val) {
            $this->add($key , $val);
        }
    }

    public function add($route, $params){
        $route=preg_replace('/{([a-z]+):([^\}]+)}/','(?P<\1>\2)',$route);
        $route = '#^'.$route.'$#';
        $this->routes[$route]=$params;
    }

    public function isMatch($route, $params, $request){
        $url = trim($request->requestUri(), '/');
        $url = explode('?',$url);
        if(preg_match($route, $url[0], $matches)){
            foreach ($matches as $key => $match) {
                if (is_string($key)) {
                    if (is_numeric($match)) {
                        $match = (int) $match;
                    }
                    $params[$key] = $match;
                }
            }
            $this->params=$params;
            return true;
        }
        return false;
        }
    

    public function createRoute(){
        $path = $this->params['controller'];
        $action = $this->params['action'];
        return new Route($path, $action, $this->params);
    }

    public function findRoute(ServerRequest $request){
        foreach ($this->routes as $route => $params){
            if ($this->isMatch($route, $params, $request)) {
                return $this->createRoute();
                }
            }
            throw new NotFoundException();
        }
}