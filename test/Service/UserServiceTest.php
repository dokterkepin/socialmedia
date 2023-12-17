<?php

namespace dokterkepin\media\Service;

use dokterkepin\media\Config\Database;
use dokterkepin\media\Domain\User;
use dokterkepin\media\Exception\ValidationException;
use dokterkepin\media\Model\UserRegisterRequest;
use dokterkepin\media\Repository\UserRepository;
use dokterkepin\media\Service\UserService;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;
    private UserRepository $userRepository;

    protected function setUp(): void
    {
        $connection = Database::getConnection();
        $this->userRepository = new UserRepository($connection);
        $this->userService = new UserService($this->userRepository);

        $this->userRepository->deleteAll();
    }

    public function testRegistrationSuccess(){
        $request = new UserRegisterRequest();
        $request->id = "dokterkepin";
        $request->name = "Kevin";
        $request->password = "rahasia";

        $response = $this->userService->register($request);

        self::assertEquals($request->id, $response->user->id);
        self::assertEquals($request->name, $response->user->name);
        self::assertNotEquals($request->password, $response->user->password);
        self::assertTrue(password_verify($request->password, $response->user->password));
    }

    public function testRegistrationFailed(){
        $this->expectException(ValidationException::class);
        $request = new UserRegisterRequest();
        $request->id = "";
        $request->name = "";
        $request->password = "";

        $response = $this->userService->register($request);
    }

    public function testRegistrationDuplicate(){
        $user = new User();
        $user->id = "dokterkepin";
        $user->name = "Shawn";
        $user->password = "dilarang";
        $this->userRepository->save($user);

        $this->expectException(ValidationException::class);

        $request = new UserRegisterRequest();
        $request->id = "dokterkepin";
        $request->name = "Kevin";
        $request->password = "rahasia";
        $response = $this->userService->register($request);
    }

}
