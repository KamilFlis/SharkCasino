<?php

require_once "AppController.php";
require_once __DIR__.'/../services/UserService.php';

class SlotsController extends AppController {

    private UserService $userService;

    public function __construct() {
        parent::__construct();
        $this->userService = new UserService();
    }

    public function slotsCleopatra() {
        if(isset($_SESSION["username"])) {
            $amount = $this->userService->getWalletAmountByUsername($_SESSION["username"]);
            $this->render("slotsCleopatra", ["messages" => [$amount]]);
        } else {
            echo '<script>alert("You must be logged in")</script>';
            $this->render("slotsPage");
        }
    }

    public function getMoney() {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]): "";

        if($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            $money = $decoded["money"];
            $money = $decoded["win"] ? $money + 100 : $money - 10;

            $this->userService->setWalletAmountByUsername($decoded["username"], $money);

            header("Content-Type: application/json");
            http_response_code(200);

            $data = ["money" => $this->userService->getWalletAmountByUsername($decoded["username"])];
            echo json_encode($data);
        }
    }
}