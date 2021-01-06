<?php

require 'Routing.php';

$path = trim($_SERVER["REQUEST_URI"], "/");
$path = parse_url($path, PHP_URL_PATH);

Routing::get("logout", "DefaultController");
Routing::get("cardsPage", "DefaultController");
Routing::get("slotsPage", "DefaultController");
Routing::get("startPage", "DefaultController");
Routing::get("loginPage", "DefaultController");
Routing::post("login", "SecurityController");
Routing::get("slotsCleopatra", "SlotsController");
Routing::post("getMoney", "SlotsController");
Routing::get("getUsername", "SlotsController");

Routing::run($path);