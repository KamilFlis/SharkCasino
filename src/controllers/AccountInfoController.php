<?php

require_once "AppController.php";
require_once __DIR__."/../repository/UserRepository.php";
require_once __DIR__."/../services/AddressService.php";
require_once __DIR__."/../services/UserService.php";

class AccountInfoController extends AppController {

    private UserRepository $userRepository;
    private AddressService $addressService;
    private UserService $userService;

    public function __construct() {
        parent::__construct();
        $this->userRepository = new UserRepository();
        $this->addressService = new AddressService();
        $this->userService = new UserService();
    }

    public function accountInfoPage() {
        if(isset($_SESSION["username"])) {
            return $this->render("accountInfoPage");
        } else {
            echo '<script>alert("You must be logged in")</script>';
            return $this->render("startPage");
        }
    }

    public function addressInfoPage() {
        if(isset($_SESSION["username"])) {
            return $this->render("addressInfoPage");
        } else {
            echo '<script>alert("You must be logged in")</script>';
            return $this->render("startPage");
        }
    }

    public function getAddressInfo() {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]): "";
        if($contentType === "application/json") {
            header("Content-Type: application/json");
            http_response_code(200);
            $data = $this->addressService->getAddress($_SESSION["username"]);
            echo json_encode($data);
        }
    }

    public function getGeneralInfo() {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]): "";

        if($contentType === "application/json") {
            header("Content-Type: application/json");
            http_response_code(200);

            $user = $this->userRepository->getUser($_SESSION["username"]);
            $data = [
                "name" => $user->getName(),
                "surname" => $user->getSurname(),
                "email" => $user->getEmail(),
                "phoneNumber" => $user->getPhoneNumber()
            ];
            echo json_encode($data);
        }
    }

    public function securityPage() {
        if(isset($_SESSION["username"])) {
            return $this->render("securityPage");
        } else {
            echo '<script>alert("You must be logged in")</script>';
            return $this->render("startPage");
        }
    }

    public function walletPage() {
        if(isset($_SESSION["username"])) {
            return $this->render("walletPage");
        } else {
            echo '<script>alert("You must be logged in")</script>';
            return $this->render("startPage");
        }
    }

    public function getWalletInfo() {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]): "";
        if($contentType === "application/json") {
            header("Content-Type: application/json");
            http_response_code(200);
            $amount = $this->userService->getWalletAmountByUsername($_SESSION["username"]);
            echo json_encode(["amount" => $amount]);
        }
    }

    public function topUp() {
        if(!$this->isPost()) {
            return $this->render("walletPage");
        }

        $amount = $_POST["amount"];
        if($amount < 0) {
            return $this->render("walletPage",  ["messages" => ["Amount can't be lesser than 0"]]);
        } else if($amount > 1000) {
            return $this->render("walletPage",  ["messages" => ["To big amount. Play responsibly!"]]);
        }

        $currentAmount = $this->userService->getWalletAmountByUsername($_SESSION["username"]);
        $this->userService->setWalletAmountByUsername($_SESSION["username"], $currentAmount + $amount);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/walletPage");
    }

    public function usersPage() {
        if(!isset($_SESSION["username"])) {
            echo '<script>alert("You must be logged in")</script>';
            return $this->render("startPage");
        }
        $user = $this->userService->getUser($_SESSION["username"]);
        if($user->hasPrivilege("Show all users")) {
            var_dump($this->userService->getAllUsers());

            return $this->render("usersPage");
        }

        return $this->render("startPage");
    }


}