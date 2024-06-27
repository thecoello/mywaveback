<?php

namespace App\Domains\User\Application;

use App\Domains\User;
use App\Domains\User\Infrastructure\UserRespository;

class UserService {
    private $userRepository;

    public function __construct(UserRespository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(User $user){
        return $this->userRepository->save($user);
    }

    public function getUser(string $id){
        return $this->userRepository->findById($id);  
    }


}