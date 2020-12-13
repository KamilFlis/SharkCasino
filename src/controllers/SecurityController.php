<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__."/../repository/UserRepository.php";

class SecurityController extends AppController {

    public function login() {

        $userRepository = new UserRepository();

        $user = new User("admin", "email@email.com", "admin1", "Jon", "Snow");

        if(!$this->isPost()) {
            return $this->render("loginPage");
        }

        $username = $_POST["username"];
        $password = $_POST["password"];

        $user = $userRepository->getUser($username);

        if(!$user) {
            return $this->render("loginPage", ["messages" => ["User doesn't exist!"]]);
        }

        if($user->getUsername() !== $username) {
            return $this->render("loginPage", ["messages" => ["Wrong username!"]]);
        }

        if($user->getPassword() !== $password) {
            return $this->render("loginPage", ["messages" => ["Wrong passowrd!"]]);
        }

        return $this->render("loggedIn", ["messages" => [$user->getName()]]);
    }

}