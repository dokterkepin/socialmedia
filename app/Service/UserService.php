<?php

namespace dokterkepin\media\Service;

use dokterkepin\media\Domain\User;
use dokterkepin\media\Exception\ValidationException;
use dokterkepin\media\Model\UserRegisterRequest;
use dokterkepin\media\Model\UserRegisterResponse;
use dokterkepin\media\Model\UserLoginRequest;
use dokterkepin\media\Model\UserLoginResponse;
use dokterkepin\media\Repository\UserRepository;
use dokterkepin\media\Config\Database;

class UserService
{

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(UserRegisterRequest $request): UserRegisterResponse
    {
        $this->validateUserRegistrationRequest($request);

        try{
            Database::beginTransaction();
            $user = $this->userRepository->findById($request->id);
            if($user != null){
                throw new ValidationException("User Already Exist");
            }
            $user = new User();
            $user->id = $request->id;
            $user->name = $request->name;
            $user->password = password_hash($request->password, PASSWORD_BCRYPT);

            $this->userRepository->save($user);
            $response = new UserRegisterResponse();
            $response->user = $user;

            Database::commitTransaction();
            return $response;

        }catch (\Exception $exception){
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    private function validateUserRegistrationRequest(UserRegisterRequest $request)
    {
        if($request->id == null || $request->name == null || $request->password == null
            || trim($request->id) == "" || trim($request->name) == "" || trim($request->password) == ""){
            throw new ValidationException("Id, Name or Password Can not be Blank");
        }

    }

    public function login(UserLoginRequest $request): UserLoginResponse
    {
        $this->validateUserLoginRequest($request);
        $user = $this->userRepository->findById($request->id);

        if($user == null){
            throw new validationException("Id or Password is Wrong");
        }

        if(password_verify($request->password, $user->password)){
            $response = new UserLoginResponse();
            $response->user = $user;

            return $response;
        }else{
            throw new ValidationException("Id or Password is Wrong");
        }

    }

    private function validateUserLoginRequest(UserLoginRequest $request)
    {
        if($request->id == null || $request->password == null || trim($request->id) == "" || trim($request->password) == ""){
            throw new ValidationException("Id or Password can not be Blank");
        }
    }

}