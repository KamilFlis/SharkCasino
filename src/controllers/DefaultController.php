<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function startPage() {
        $this->render("startPage");
    }

    public function loginPage() {
        $this->render("loginPage");
    }

    public function registerPage() {
        $this->render("registerPage");
    }

    public function slotsPage() {
        $this->render("slotsPage");
    }

    public function cardsPage() {
        $this->render("cardsPage");
    }

    public function roulettePage() {
        $this->render("roulettePage");
    }

    public function jackpotPage() {
        $this->render("jackpotPage");
    }

    public function logout() {
        $this->render("logout");
    }

}