<?php

namespace dokterkepin\media\Repository;

use PHPUnit\Framework\TestCase;
use dokterkepin\media\Domain\User;
use dokterkepin\media\Config\Database;

class UserRepositoryTest extends TestCase
{

    private UserRepository $userRepository;
    protected function setUp(): void{
        $this->userRepository = new UserRepository(Database::getConnection());
        $this->userRepository->deleteAll();

    }

    public function testSaveSuccess(){
        $user = new User();
        $user->id = "dokterkepin";
        $user->name = "Kevin";
        $user->password = "rahasia";

        $this->userRepository->save($user);
        $result = $this->userRepository->findById($user->id);

        $this->assertEquals($user->id, $result->id);
        $this->assertEquals($user->name, $result->name);
        $this->assertEquals($user->password, $result->password);
    }

    public function testFindByIdNotFound(){
        $user = $this->userRepository->findById("not found");
        $this->assertNull($user);
    }

    public function testUpdate(){
        $user = new User();
        $user->id = "dokterkepin";
        $user->name = "Kevin";
        $user->password = "rahasia";
        $this->userRepository->save($user);

        $user->name = "Nathan";
        $this->userRepository->update($user);

        $result = $this->userRepository->findById($user->id);

        $this->assertEquals($user->id, $result->id);
        $this->assertEquals($user->name, $result->name);
        $this->assertEquals($user->password, $result->password);
    }


}
