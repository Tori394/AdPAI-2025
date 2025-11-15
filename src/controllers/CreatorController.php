<?php 

require_once 'AppController.php';

class CreatorController extends AppController {

    private static $instance = null;

    public static function getInstance(): CreatorController {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function index() {
        
        return $this->render('creator');
    }

}
?>