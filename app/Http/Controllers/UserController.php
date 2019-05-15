<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;

class UserController extends Controller
{
    public function register()
    {

    	$name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $users = Users::where('email', $email)->get();

		$users = new Users();
            $users->email = $email;
            $users->password = $password;
            $users->name = $name;
            $users->save();

    }

    public function login()
    {
    	
    }
       
}
