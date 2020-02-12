<?php

return [
    '' => [
        'controller' => 'main',
        'action' => 'index',
    ],
    'api/users' =>[
        'controller'=> 'main',
        'action' =>'form',
        'api'=>'true',
    ],
    'api/user/{id:\d+}'=>[
        'controller'=>'main',
        'action'=>'user',
    ],
    'api/regions'=>[
        'controller'=> 'main',
        'action' =>'reg',
        'api'=>'true',
    ],
    'api/user/create'=>[
        'controller' => 'main',
        'action' => 'create',
        'api' => 'true',
    ]
];