<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';

class SecurityController extends AppController {

    public function login() {
        $user = new User("admin", "email@email.com", "admin1", "Jon", "Snow");

        if(!$this->isPost()) {
            return $this->render("loginPage");
        }

        $username = $_POST["username"];
        $password = $_POST["password"];

        if($user->getUsername() !== $username) {
            return $this->render("loginPage", ["messages" => ["Wrong username!"]]);
        }

        if($user->getPassword() !== $password) {
            return $this->render("loginPage", ["messages" => ["Wrong passowrd!"]]);
        }

        return $this->render("loggedIn", ["messages" => [$user->getName()]]);
    }

}