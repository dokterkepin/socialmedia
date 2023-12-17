<?php

namespace dokterkepin\media\Controller;

use dokterkepin\media\Config\Database;
use dokterkepin\media\Exception\ValidationException;
use dokterkepin\media\Model\UserRegisterRequest;
use dokterkepin\media\Repository\UserRepository;
use dokterkepin\media\Service\UserService;
use dokterkepin\media\App\View;

class UserController
{
    private UserService $userService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $userRepository = new UserRepository($connection);
        $this->userService = new UserService($userRepository);
    }

    public function register(){
        View::render("User/register", ["title" => "Register New User"]);
    }

    public function postRegister(){
        $request = new UserRegisterRequest();
        $request->id = $_POST["id"];
        $request->name = $_POST["name"];
        $request->password = $_POST["password"];

        try{
            $this->userService->register($request);
            View::redirect("login");
        }catch(ValidationException $exception){
            View::render("User/register",
                ["title" => "Register New User",
                    "error" => $exception->getMessage()]);
        }

    }


}