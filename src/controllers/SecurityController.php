<?php 

require_once 'AppController.php';

class SecurityController extends AppController {
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