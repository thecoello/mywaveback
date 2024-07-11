<?php
 
namespace App\Http\Controllers;

use App\Domains\User\Application\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;

class LoginController extends Controller
{
    private $userService;

    public function __construct(UserService $userService, Guard $auth)
    {
        $this->userService = $userService;
    }

    public function login(Request $request){
         if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user();
            $success['token'] = "Bearer " . $request->user()->createToken(session()->id())->plainTextToken; 
            $success['user_id'] =  $user->id;
            return $success;
        }        
        return response('Login invalid', 503);
    }

    public function logout(Request $request){
        return $request->user()->tokens()->delete();
    }

}