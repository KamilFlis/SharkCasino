<?php session_start();

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__."/../repository/UserRepository.php";

class SecurityController extends AppController {

    public function login() {

        $userRepository = new UserRepository();

        if(!$this->isPost()) {
            $this->render("loginPage");
        }

        $username = $_POST["username"];
        $password = $_POST["password"];

        $user = $userRepository->getUser($username);
        if($user) {
            $_SESSION["username"] = $user->getUsername();
            $_SESSION["name"] = $user->getName();
        }

        if(!$user) {
            return $this->render("loginPage", ["messages" => ["User doesn't exist!"]]);
        }

        if($user->getUsername() !== $username) {
            return $this->render("loginPage", ["messages" => ["Wrong username!"]]);
        }

        if($user->getPassword() !== $password) {
            return $this->render("loginPage", ["messages" => ["Wrong password!"]]);
        }

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/startPage");
    }

    public function register() {
        if(!$this->isPost()) {
            return $this->render("registerPage");
        }

        $username = $_POST["username"];
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];
        $phoneNumber = $_POST["phoneNumber"];
        $flatNumber = $_POST["flatNumber"];
        $postcode = $_POST["postcode"];
        $street = $_POST["street"];
        $city = $_POST["city"];
        $country = $_POST["country"];
        $bankAccountNumber = $_POST["bankAccountNumber"];
        $conditions = $_POST["conditions"];

        // unique username
        $userRepository = new UserRepository();
        $user = $userRepository->getUser($username);
        if($user !== null) {
            return $this->render("registerPage", ["messages" => ["Username already exists"]]);
        }

        // email pattern
        if(!preg_match("/\S+@\S+\.\S+/", $email)) {
            return $this->render("registerPage", ["messages" => ["Incorrect email format"]]);
        }

        // same confirmed password
        if($password !== $confirmPassword) {
            return $this->render("registerPage", ["messages" => ["Passwords doesn't match"]]);
        }

        // phone number is 9 digit
        if(strlen($phoneNumber) !== 9) {
            return $this->render("registerPage", ["messages" => ["Wrong phone number format"]]);
        }

        if(strlen($bankAccountNumber) !== 26) {
            return $this->render("registerPage", ["messages" => ["Wrong bank account number format"]]);
        }

        // checked terms and conditions
        if($conditions == null) {
            return $this->render("registerPage", ["messages" => ["You must accept terms and conditions"]]);
        }

        /* TODO: add account info page -> to top up wallet
            ERD diagram + expanded database, more tables (session, login history?) and views
            add user roles -> for normal user + admin
        */

        $userService = new UserService();
        $userService->addUser(
            $username,
            $email,
            $password,
            $name,
            $surname,
            $phoneNumber,
            $flatNumber,
            $street,
            $postcode,
            $city,
            $country,
            $bankAccountNumber,
        );

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/startPage");

    }

}