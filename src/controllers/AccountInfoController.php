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
    }

    public function accountInfoPage() {
        if(isset($_SESSION["username"])) {
            $this->render("accountInfoPage");
            $this->getGeneralInfo();
        } else {
            echo '<script>alert("You must be logged in")</script>';
            $this->render("startPage");
        }
    }

    public function addressInfoPage() {
        if(isset($_SESSION["username"])) {
            $this->render("addressInfoPage");
            $this->getAddressInfo();
        } else {
            echo '<script>alert("You must be logged in")</script>';
            $this->render("startPage");
        }
    }

    public function getAddressInfo() {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            $data = $this->addressService->getAddress($decoded["username"]);
            echo json_encode($data);
        }
    }

    public function getGeneralInfo() {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            $user = $this->userRepository->getUser($decoded["username"]);
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
            $this->render("securityPage");
        } else {
            echo '<script>alert("You must be logged in")</script>';
            $this->render("startPage");
        }
    }

    public function walletPage() {
        if(isset($_SESSION["username"])) {
            $this->render("walletPage");
            $this->getWalletInfo();
        } else {
            echo '<script>alert("You must be logged in")</script>';
            $this->render("startPage");
        }
    }

    public function getWalletInfo() {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            $amount = $this->userService->getWalletAmountByUsername($decoded["username"]);
//            $data = ;
            echo json_encode(["amount" => $amount]);
        }
    }

}