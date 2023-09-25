<?php
require_once __DIR__ . "/../vendor/autoload.php";

use dokterkepin\media\App\Router;
use dokterkepin\media\Controller\HomeController;
use dokterkepin\media\Config\Database;

Database::getConnection("prod");
Router::add("GET", "/", HomeController::class, "index", []);
Router::run();