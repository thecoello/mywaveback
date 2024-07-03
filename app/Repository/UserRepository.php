<?php

namespace App\Domains\User\Infrastructure;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserRespository
{

    public function createUser(Request $request)
    {  

        $validator = Validator::make($request->all(),['email' => [ 'required','unique:users'], 'password' => [
            Password::min(6)->numbers()->mixedCase()
        ]]);

        if($validator->passes()){
            return $this->getUser(User::create($request->all())->id);
        }

        return Response::json($validator->errors(),403);
    }

    public function getAllUsers(){
        return User::orderBy('id','desc')->paginate(10);
    }

    public function getUser(string $id)
    {
        return User::find($id);
    }

    public function updateUser(string $id, Request $request)
    {

        $validator = Validator::make($request->all(),['email' => [ 'required','unique:users'], 'password' => [
            Password::min(6)->numbers()->mixedCase()
        ]]);

        if($validator->passes()){
            return $this->getUser(User::find($id)->update($request->all()));
        }

        return Response::json($validator->errors(),403);
    }

    public function deleteUser(string $id)
    {
        return User::find($id)->delete();
    }
}
