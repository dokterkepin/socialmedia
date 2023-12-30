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
Router::add("GET", "/users/login", UserController::class, "login", []);
Router::add("POST", "/users/login", UserController::class, "postLogin", []);
Router::run();