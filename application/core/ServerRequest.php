<?php

namespace application\core;


class ServerRequest {

    private $requestType;

    public function __construct(){
       $this->requestType=$_SERVER["REQUEST_METHOD"];
    }

    public function requestData(){
        return $_REQUEST;
    }
    
    public function requestUri(){
        return $_SERVER['REQUEST_URI'];
    }

    public function __get($property){
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }
}