<?php

namespace dokterkepin\media\Controller {

    require_once __DIR__ . "/../Helper/helper.php";

    use dokterkepin\media\Config\Database;
    use dokterkepin\media\Domain\User;
    use dokterkepin\media\Repository\UserRepository;
    use PHPUnit\Framework\TestCase;

    class UserControllerTest extends TestCase
    {

        private UserController $userController;
        private UserRepository $userRepository;

        protected function setUp(): void
        {
            $this->userController = new UserController();
            $this->userRepository = new UserRepository(Database::getConnection());
            $this->userRepository->deleteAll();
            putenv("mode=test");
        }

        public function testRegister()
        {
            $this->userController->register();

            $this->expectOutputRegex("[id]");
            $this->expectOutputRegex("[name]");
            $this->expectOutputRegex("[password]");
            $this->expectOutputRegex("[Register New User]");
        }

        public function testPostRegisterSuccess()
        {
            $_POST["id"] = "dokterkepin";
            $_POST["name"] = "Kevin";
            $_POST["password"] = "rahasia";

            $this->userController->postRegister();

            $this->expectOutputRegex("[Location: login]");
        }

        public function testPostRegisterValidationError(){
            $_POST["id"] = "";
            $_POST["name"] = "";
            $_POST["password"] = "rahasia";

            $this->userController->postRegister();

            $this->expectOutputRegex("[Register New Account]");
            $this->expectOutputRegex("[Register]");
            $this->expectOutputRegex("[id]");
            $this->expectOutputRegex("[name]");
            $this->expectOutputRegex("[password]");
            $this->expectOutputRegex("[Id, Name or Password Can not be Blank]");
        }

        public function testPostRegisterDuplicate(){
            $user = new User();
            $user->id = "shawngading";
            $user->name = "shawn";
            $user->password = "rahasia";
            $this->userRepository->save($user);

            $_POST["id"] = "shawngading";
            $_POST["name"] = "daniel";
            $_POST["password"] = "rahasia";
            $this->userController->postRegister();

            $this->expectOutputRegex("[User Already Exist]");
        }


    }
}