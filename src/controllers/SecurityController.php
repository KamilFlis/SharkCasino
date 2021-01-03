<?php session_start();

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__."/../repository/UserRepository.php";

class SecurityController extends AppController {

    public function login() {

        $userRepository = new UserRepository();

        if(!$this->isPost()) {
            return $this->render("loginPage");
        }

        $username = $_POST["username"];
        $password = $_POST["password"];

        $user = $userRepository->getUser($username);
        $_SESSION["username"] = $user->getUsername();
        $_SESSION["name"] = $user->getName();

        if(!$user) {
            return $this->render("loginPage", ["messages" => ["User doesn't exist!"]]);
        }

        if($user->getUsername() !== $username) {
            return $this->render("loginPage", ["messages" => ["Wrong username!"]]);
        }

        if($user->getPassword() !== $password) {
            return $this->render("loginPage", ["messages" => ["Wrong password!"]]);
        }

        return $this->render("startPage");
    }

}