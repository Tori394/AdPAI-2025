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

     // ======= LOKALNA "BAZA" UŻYTKOWNIKÓW =======
    private static array $users = [
        [
            'email' => 'anna@example.com',
            'password' => '$2y$10$wz2g9JrHYcF8bLGBbDkEXuJQAnl4uO9RV6cWJKcf.6uAEkhFZpU0i', // test123
            'username' => 'Anna'
        ],
        [
            'email' => 'bartek@example.com',
            'password' => '$2y$10$fK9rLobZK2C6rJq6B/9I6u6Udaez9CaRu7eC/0zT3pGq5piVDsElW', // haslo456
            'username' => 'Bartek'
        ],
        [
            'email' => 'celina@example.com',
            'password' => '$2y$10$Cq1J6YMGzRKR6XzTb3fDF.6sC6CShm8kFgEv7jJdtyWkhC1GuazJa', // qwerty
            'username' => 'Celina'
        ],
    ];


    //dekorator, ktore opcje sa dostepne dla tego widoku

    public function login() {
        if (!$this->isPost()) { //early return
            return $this->render('login'); 
        }

        $email = $_POST["email"] ?? '';
        $password = $_POST["password"] ?? '';

        if (empty($email) || empty($password)) {
            return $this->render('login', ['message' => 'Fill all fields']);
        }

        $userRow = null;
        foreach (self::$users as $user) {
            if ($user['email'] === $email) {
                $userRow = $user;
                break;
            }
        }

        if ($userRow === null) {
            return $this->render('login', ['message' => 'User not found']);
        }

        if (!password_verify($password, $userRow['password'])) {
            return $this->render('login', ['message' => 'Wrong password']);
        }
        
        // TODO możemy przechowywać sesje użytkowika lub token
        // setcookie("username", $userRow['email'], time() + 3600, '/');

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/dashboard");
    }

    public function register() {
        if (!$this->isPost()) { //early return
            return $this->render('register'); 
        }

        $email = $_POST["email"] ?? '';
        $username = $_POST["username"] ?? '';
        $password = $_POST["password"] ?? '';
        $confPassword = $_POST["confPassword"] ?? '';

        if (empty($email) || empty($username) || empty($password) || empty($confPassword)) {
            return $this->render('register', ['message' => 'Fill all fields']);
        }

        if ($password !== $confPassword) {
            return $this->render('register', ['message' => 'Passwords do not match']);
        }

        foreach (self::$users as $u) {
            if (strcasecmp($u['email'], $email) === 0) {
                return $this->render('register', ['messages' => 'Email already in use by other user']);
            }
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        self::$users[] = [
            'email' => $email,
            'password' => $hashedPassword,
            'username' => $username
        ];

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/login");
    }
}
?>