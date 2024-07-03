<?php

namespace App\Domains\User\Application;

use App\Domains\User\Infrastructure\UserRespository;
use Illuminate\Http\Request;

class UserService
{
    private $userRepository;

    public function __construct(UserRespository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(Request $user)
    {
        return $this->userRepository->createUser($user);
    }

    public function getAllUsers()
    {
        return $this->userRepository->getAllUsers();
    }

    public function getUser(string $id)
    {
        return $this->userRepository->getUser($id);
    }

    public function updateUser(string $id, Request $user)
    {
        return $this->userRepository->updateUser($id, $user);
    }

    public function deleteUser(string $id)
    {
        return $this->userRepository->deleteUser($id);
    }
}
