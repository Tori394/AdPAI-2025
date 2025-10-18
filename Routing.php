<?php

class Routing {

    public static function run(string $path) {
        $path = trim($path, '/');

        switch ($path) {
            case 'dashboard':
                include 'public/views/dashboard.html';
                return;
            case 'login':
                include 'public/views/login.html';
                return;
        }

        if (preg_match('/^user\/(\d+)$/', $path, $matches)) {
            $id = $matches[1];
            echo "<h1>User ID = {$id}</h1>";
            return;
        }

        include 'public/views/404.html';
    }
}
