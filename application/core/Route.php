<?php

namespace application\core;

use application\core\views\JsonView;
use application\core\views\HtmlView;

class Route{
    private $controller;
    private $action;
    private $model;
    private $params=[];

    public function __construct($controller, $action, $params=[]){
        $this->controller=$controller;
        $this->action=$action;
        $this->params=$params;
        $this->createPathModel();
        $this->createPathController();
        $this->view = $this->createView($controller);
        $this->createAction();
    }

    public function createPathController(){
        $this->controller='application\controllers\\'.ucfirst($this->controller).'Controller';
    }

    public function createView($controller){
        if(!isset($this->params['api'])){
             return new HtmlView('application\views\\'.$controller.'\\'.$this->action);
        }
        return new JsonView('api');
    }

    public function createPathModel(){
        $this->model='application\models\\'.ucfirst($this->controller);
    }

    public function createAction(){
        $this->action=$this->action.'Action';
    }

    public function __get($property){
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }
}