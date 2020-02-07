<?php 
namespace application\core\views;

use application\core\View;

class JsonView extends View {
    public function JSON($status, $message){
        exit(json_encode(['status' => $status, 'message' => $message]));
    }
}