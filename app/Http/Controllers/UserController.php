<?php
 
namespace App\Http\Controllers;
 
use App\Domains\User;
use App\Domains\User\Application\UserService;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Request as HttpRequest;
use ReflectionClass;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function createUser(HttpRequest $request){

        $user = new User(explode(':',$request->getContent()));
        
        return $this->userService->createUser($user);
    }

    public function getUser(string $id){
        print_r($id);
        return $this->userService->getUser($id);  
    }

}