<?php session_start();

require_once "AppController.php";
require_once __DIR__.'/../models/User.php';
require_once __DIR__."/../repository/UserRepository.php";

class SecurityController extends AppController {

    private UserRepository $userRepository;

    public function __construct() {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function login() {
        if(!$this->isPost()) {
            $this->render("loginPage");
        }

        $username = $_POST["username"];
        $password = $_POST["password"];

        $user = $this->userRepository->getUser($username);
        if(!$user) {
            return $this->render("loginPage", ["messages" => ["User doesn't exist!"]]);
        }

        if($user->getUsername() !== $username) {
            return $this->render("loginPage", ["messages" => ["Wrong username!"]]);
        }

        if(!password_verify($password, $user->getPassword())) {
            return $this->render("loginPage", ["messages" => ["Wrong password!"]]);
        }

        $_SESSION["username"] = $user->getUsername();
        $_SESSION["name"] = $user->getName();

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

        $user = $this->userRepository->getUser($username);
        if($user !== null) {
            return $this->render("registerPage", ["messages" => ["Username already exists"]]);
        }

        if(!preg_match("/\S+@\S+\.\S+/", $email)) {
            return $this->render("registerPage", ["messages" => ["Incorrect email format"]]);
        }

        if($password !== $confirmPassword) {
            return $this->render("registerPage", ["messages" => ["Passwords don't match"]]);
        }

        if(strlen($phoneNumber) !== 9) {
            return $this->render("registerPage", ["messages" => ["Wrong phone number format"]]);
        }

        if(strlen($bankAccountNumber) !== 26) {
            return $this->render("registerPage", ["messages" => ["Wrong bank account number format"]]);
        }

        if($conditions == null) {
            return $this->render("registerPage", ["messages" => ["You must accept terms and conditions"]]);
        }

        $checkDistinct = $this->userRepository->checkIfUserParameterExist($email, $phoneNumber, $bankAccountNumber);
        if($checkDistinct === "email") {
            return $this->render("registerPage", ["messages" => ["User with that email already exists"]]);
        }

        if($checkDistinct === "phoneNumber") {
            return $this->render("registerPage", ["messages" => ["User with that phone number already exists"]]);
        }

        if($checkDistinct === "bankAccountNumber") {
            return $this->render("registerPage", ["messages" => ["User with that bank account number already exists"]]);
        }

        // TODO: ERD diagram

        $userService = new UserService();
        $userService->addUser(
            $username,
            $email,
            password_hash($password, PASSWORD_DEFAULT, ["cost" => PASSWORD_BCRYPT_DEFAULT_COST]),
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

    public function changePassword() {
        if(!$this->isPost()) {
            return $this->render("securityPage");
        }

        $oldPassword = $_POST["oldPassword"];
        $newPassword = $_POST["newPassword"];
        $confirmPassword = $_POST["confirmPassword"];

        $user = $this->userRepository->getUser($_SESSION["username"]);
        if(!password_verify($oldPassword, $user->getPassword())) {
            return $this->render("securityPage", ["messages" => ["Wrong old password"]]);
        }

        if($newPassword !== $confirmPassword) {
            return $this->render("securityPage",  ["messages" => ["Passwords don't match"]]);
        }

        $this->userRepository->setPassword($_SESSION["username"], password_hash($newPassword, PASSWORD_DEFAULT, ["cost" => PASSWORD_BCRYPT_DEFAULT_COST]));
        return $this->render("securityPage",  ["messages" => ["Password changed successfully"]]);
    }

    public function logout() {
        session_unset();
        session_destroy();

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/startPage");
    }


}