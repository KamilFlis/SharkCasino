<?php

require "Routing.php";

$path = trim($_SERVER["REQUEST_URI"], "/");
$path = parse_url($path, PHP_URL_PATH);

Routing::get("cardsPage", "DefaultController");
Routing::get("slotsPage", "DefaultController");
Routing::get("startPage", "DefaultController");
Routing::get("loginPage", "DefaultController");
Routing::get("registerPage", "DefaultController");
Routing::get("logout", "SecurityController");
Routing::get("slotsCleopatra", "SlotsController");
Routing::get("roulettePage", "DefaultController");
Routing::get("jackpotPage", "DefaultController");
Routing::get("accountInfoPage", "AccountInfoController");
Routing::get("getGeneralInfo", "AccountInfoController");
Routing::get("addressInfoPage", "AccountInfoController");
Routing::get("getAddressInfo", "AccountInfoController");
Routing::get("securityPage", "AccountInfoController");
Routing::get("walletPage", "AccountInfoController");
Routing::get("getWalletInfo", "AccountInfoController");
Routing::get("getCountries", "DefaultController");


Routing::post("login", "SecurityController");
Routing::post("register", "SecurityController");
Routing::post("changePassword", "SecurityController");
Routing::post("getMoney", "SlotsController");
Routing::post("topUp", "AccountInfoController");

Routing::run($path);