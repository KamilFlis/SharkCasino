<?php

require_once "AppController.php";
require_once __DIR__."/../repository/CountryRepository.php";

require_once __DIR__."/../services/UserService.php";

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

    public function getCountries() {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]): "";
        if($contentType === "application/json") {
            header("Content-Type: application/json");
            http_response_code(200);
            $countryRepository = new CountryRepository();
            $countries = $countryRepository->getAllCountries();
            echo json_encode($countries);
        }
    }

}