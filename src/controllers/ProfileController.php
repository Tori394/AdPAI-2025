<?php 

require_once 'AppController.php';

class ProfileController extends AppController {

    private static $instance = null;

    public static function getInstance(): ProfileController {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function index() {
        
        return $this->render('profile');
    }

}
?>