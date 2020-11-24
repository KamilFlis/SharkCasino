<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function startPage() {
        $this->render("startPage");
    }

    public function loginPage() {
        $this->render("loginPage");
    }
}