<?php

namespace App\Domains\User\Infrastructure;

use App\Domains\User as User;
use Illuminate\Support\Facades\DB;

class UserRespository{

    public function save(User $user)
    {
        $saveUser = DB::table('users')->insertGetId((array)$user);        
        $getUserSaved = DB::table('users')->where('id',$saveUser)->get();
        return $getUserSaved;
    }

    public function findById(string $id)
    {
        return DB::table('users')->where('id',$id)->first();
    }

    public function update(User $user): User
    {
        $updateUser = DB::table('users')->update([$user]);
        $updatedUser = DB::table('users')->where('id',$updateUser)->first();
        return $updatedUser;
    }

    public function delete(User $user): User
    {
        $deleteUser = DB::table('users')->update([$user]);
        $deletedUser = DB::table('users')->where('id',$deleteUser)->first();
        return $deletedUser;
    }
    
}