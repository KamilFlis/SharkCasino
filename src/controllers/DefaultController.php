<?php

require_once 'AppController.php';
require_once __DIR__."/../services/UserService.php";

class DefaultController extends AppController {

    public function startPage() {
        $this->render("startPage");
    }

    public function loginPage() {
        $this->render("loginPage");
    }

    public function slotsPage() {
        $this->render("slotsPage");
    }

    public function cardsPage() {
        $this->render("cardsPage");
    }

    public function logout() {
        $this->render("logout");
    }

    public function slotsCleopatra() {
        $userService = new UserService();
        $wallet = $userService->getUserWallet("kamil123");
        $this->render("slotsCleopatra", ["messages" => [$wallet->getAmount()]]);
    }
}