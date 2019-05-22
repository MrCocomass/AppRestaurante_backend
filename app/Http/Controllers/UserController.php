<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Firebase\JWT\JWT;
use DB;
use App\Users;

class UserController extends Controller
{
    public function register()
    {

    		if (empty($_POST['email']) || empty($_POST['password']) )
    		{
    			print('rellenar todos los campos');
    			exit();
    		}

    		if(strlen($_POST['password']) < 8 || strlen($_POST['password']) > 12)
    		{
                return $this->createResponse(400, 'La contraseña ha de tener entre 8 y 12 caracteres');
        	}

        	
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
    	$email = $_POST['email'];
            $password = $_POST['password'];
            $users = Users::where('email', $email)->get();

    	if(self::checkLogin($email, $password)){ 

                $userSave = Users::where('email', $email)->first();
            }
    }
       
}
