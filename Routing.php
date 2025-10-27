<?php

require_once 'src/controllers/SecurityController.php';

//TODO naprawic kontrolery na singletony
class Routing {

    public static $routing = [
        'login' => [
            'controller' => 'SecurityController',
            'action' => 'login'
        ],
        'register' => [
            'controller' => 'SecurityController',
            'action' => 'register'
        ]
    ];

    public static function run(string $path) {
        switch ($path) {
            case 'dashboard':
                include 'public/views/dashboard.html';
                break;

            case 'login':
            case 'register':
                $controller = self::$routing[$path]['controller'];
                $action = self::$routing[$path]['action'];

                $controllerObcject = new $controller();
                $controllerObcject->$action();

                break;

            default:
                include 'public/views/404.html';
                break;
        }
    }
}
