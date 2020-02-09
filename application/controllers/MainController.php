<?php

namespace application\controllers;

use application\core\Controller;

class MainController extends Controller
{
    public function indexAction(){
        $this->view->render('Главная страница');
        
    }
    public function formAction(){
        $result = $this->model->getUsers();
        $this->view->JSON(200,$result);
    }
    public function regAction(){
        $result = $this->model->getRegions($this->request->pid);
        $this->view->JSON(200,$result);
    }
    public function createAction(){
        $user = $this->model->checkLogin($this->request->email);
        if($user){
            $this->view->JSON(301, ['id'=>$user]);
        }
        $name = $this->request->name;
        
        $email = $this->request->email;
        $terr_id = $this->request->terr_id;
        $result = $this->model->createUser($name, $email, $terr_id);
        $this->view->JSON(200, true);
    }
    public function userAction(){
        $user = $this->model->getUser($this->params['id']);
        $this->view->render('Страница', $user[0]);
    }
}
