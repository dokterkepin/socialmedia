<?php
require_once __DIR__ . "/../vendor/autoload.php";

use dokterkepin\media\App\Router;
use dokterkepin\media\Controller\HomeController;
use dokterkepin\media\Controller\UserController;
use dokterkepin\media\Config\Database;

Database::getConnection("prod");

//Home Controller
Router::add("GET", "/", HomeController::class, "index", []);

//User Controller
Router::add("GET", "/users/register", UserController::class, "register", []);
Router::add("POST", "/users/register", UserController::class, "postRegister", []);
Router::run();