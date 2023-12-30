<?php

namespace dokterkepin\media\Controller;

use dokterkepin\media\Config\Database;
use dokterkepin\media\App\View;
use dokterkepin\media\Repository\UserRepository;

class HomeController
{


    public function __construct()
    {
        $connection = Database::getConnection();
        $userRepository = new UserRepository($connection);

    }

    public function index(){
        View::render("Home/dashboard", [
            "title" => "Login"
        ]);
    }
}