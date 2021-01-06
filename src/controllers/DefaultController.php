<?php

require_once 'AppController.php';

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

}