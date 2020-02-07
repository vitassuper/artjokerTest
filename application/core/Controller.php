<?php

namespace application\core;

use application\core\View;

abstract class Controller{

    protected $model;
    protected $view;
    protected $request;
    protected $params=[];

    public function __construct(Model $model, View $view, ServerRequest $request, $params){
       $this->model=$model;
       $this->view=$view;
       $this->request=$request;
       $this->params=$params;
    }

    public function loadModel($name){
        $path = 'application\models\\'.ucfirst($name);
        if(class_exists($path)){
            return new $path;
        }
    }

    public function redirect($url){
        header('location: '.$url);
        exit;
    }
}