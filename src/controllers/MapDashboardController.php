<?php 

require_once 'AppController.php';

class MapDashboardController extends AppController {

    private static $instance = null;

    public static function getInstance(): MapDashboardController {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function index(?int $id) {
        
        return $this->render('map');
    }

}
?>