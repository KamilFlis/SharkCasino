<?php

require_once 'AppController.php';
require_once __DIR__.'/../services/UserService.php';

class SlotsController extends AppController {

    public function slotsCleopatra() {
        $userService = new UserService();
        if(isset($_SESSION["username"])) {
            $amount = $userService->getWalletAmountByUsername($_SESSION["username"]);
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

            $userService = new UserService();
            $userService->setWalletAmountByUsername($decoded["username"], $money);

            header("Content-Type: application/json");
            http_response_code(200);

            $data = ["money" => $userService->getUserWalletByUsername($decoded["username"])->getAmount()];
            echo json_encode($data);
        }
    }

    public function getUsername() {
        header("Content-Type: application/json");
        http_response_code(200);
        echo json_encode(["username" => $_SESSION["username"]]);
    }

}