<?php 

require_once 'AppController.php';

class SecurityController extends AppController {

    private static $instance = null;

    public static function getInstance(): SecurityController {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function login() {
        //TODO get data from user form
        //check if user exists in database
        //render dasboard or show error
        return $this->render('login',['message' => 'Błędne hasło']);
    }

    public function register() {
        return $this->render('register');
    }
}
?>