<?php

namespace App\Domains\User\Application;

use App\Domains\User\Infrastructure\UserRespository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Response;

class UserService
{
    private $userRepository;

    public function __construct(UserRespository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(Request $request)
    {
        $validator = Validator::make($request->all(), ['email' => ['required', 'unique:users'], 'password' => [
            Password::min(6)->numbers()->mixedCase()
        ]]);

        if ($validator->passes()) {
            return $this->userRepository->createUser($request);
        }else{
            return Response::json($validator->errors(), 403);
        }
    }

    public function getAllUsers()
    {   
        return $this->userRepository->getAllUsers();
    }

    public function getAllAdminUsers()
    {   
        return $this->userRepository->getAllAdminUsers();

    }

    public function getUser(string $id)
    {
        return $this->userRepository->getUser($id);
    }

    public function updateUser(string $id, Request $request)
    {
        $user = $this->getUser($id);

        if($user->email == $request->email){
            $validator = Validator::make($request->all(), ['email' => ['required'], 'password' => [
                Password::min(6)->numbers()->mixedCase()
            ]]);
    
            if ($validator->passes()) {
               return  $this->userRepository->updateUser($id, $request);
            }else{
                return Response::json($validator->errors(), 403);
            }
        }
    }

    public function deleteUser(string $id)
    {
        return $this->userRepository->deleteUser($id);
    }
}
