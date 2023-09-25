<?php

namespace dokterkepin\media\Controller;

use dokterkepin\media\Config\Database;
use dokterkepin\media\App\View;
class HomeController
{

    public function index(){
        View::render("Home/index", [
            "title" => "Welcome, Please Login"
        ]);
    }
}