<?php

namespace dokterkepin\media\Controller;

use dokterkepin\media\Config\Database;
use dokterkepin\media\Repository\UserRepository;
use PHPUnit\Framework\TestCase;


class HomeControllerTest extends TestCase
{
    private HomeController $homeController;
    private UserRepository $userRepository;

    protected function setUp() :void
    {
        $this->homeController = new HomeController();
        $this->userRepository = new UserRepository(Database::getConnection());

        $this->userRepository->deleteAll();
    }

    public function testGuest(){
        $this->homeController->index();
        $this->expectOutputRegex("[Welcome, Please Login]");
    }


}
