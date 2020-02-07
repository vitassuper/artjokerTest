<?php

spl_autoload_register(function ($class_name) {
    $path = str_replace('\\', '/' , $class_name) . '.php';
    if(file_exists($path)){
        require $class_name. '.php';
    }
 });