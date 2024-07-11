<?php

namespace App\Domains\User\Infrastructure;

use App\Models\User;
use Illuminate\Http\Request;

class UserRespository
{

    public function createUser(Request $request)
    {
        return $this->getUser(User::create($request->all())->id);
    }

    public function getAllUsers()
    {
        return User::where('usertype', '=', 'USER')->orderBy('id', 'desc')->paginate(10);
    }

    public function getAllAdminUsers()
    {
        return User::where('usertype', '=', 'ADMIN')->orderBy('id', 'desc')->paginate(10);
    }

    public function getUser(string $id)
    {
        return User::find($id);
    }

    public function updateUser(string $id, Request $request)
    {
        return $this->getUser(User::find($id)->update($request->all()));
    }

    public function deleteUser(string $id)
    {
        return User::find($id)->delete();
    }
}
