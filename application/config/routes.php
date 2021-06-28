<?php

return [
    '/' => [
        'controller' => 'Main',
        'action'     => 'index'
    ],
    'task/create' => [
        'controller' => 'Task',
        'action'     => 'create'
    ],
    'task/read' => [
        'controller' => 'Task',
        'action'     => 'read'
    ],
    'task/edit' => [
        'controller' => 'Task',
        'action'     => 'edit'
    ],
    'task/update' => [
        'controller' => 'Task',
        'action'     => 'update'
    ],
    'sign/in' => [
        'controller' => 'User',
        'action'     => 'signIn'
    ],
    'sign/out' => [
        'controller' => 'User',
        'action'     => 'signOut'
    ],
    'login' => [
        'controller' => 'User',
        'action'     => 'login'
    ],
];