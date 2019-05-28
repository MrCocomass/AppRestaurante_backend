<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use \Firebase\JWT\JWT;
use App\Users;

class UserController extends Controller
{

    public function register (Request $request)
    {
        if (!isset($_POST['name']) or !isset($_POST['email']) or !isset($_POST['password'])) 
        {
            return $this->error(401, 'Tienes que rellenar todos los campos');
        }
      	
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $users = Users::where('email', $email)->get();

        foreach ($users as $user) 
        {
            if ($user->email == $email) 
            {
                return $this->error(400, 'El email ya existe, por favor utiliza otro'); 
            }
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            return $this->error(400, 'Por favor introduce un email que sea valido con formato @___.com'); 
        }

        if (strlen($password) < 8)
        {
            return $this->error(400, 'El password debe tener al  menos 8 caracteres');
        }

        if (!empty($name) && !empty($email) && !empty($password))
        {
            try
            {
                $users = new Users();
                $users->name = $name = str_replace(' ', '',$request->name);
                $users->password = encrypt($password);
                $users->email = $email;          
                $users->save();
            }
            catch(Exception $e)
            {
                return $this->error(2, $e->getMessage());
            }
            
            	return $this->success('register success');
        	}
        else
       		{
            	return $this->error(400, 'fill empty parameters');
        	}
    }


    protected function login (Request $request)
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($email))
        {
            return $this->error (401, 'add email');
        }

        if (empty($password))
        {
            return $this->error (401, 'add pasword');
        }

        $users = Users::where('email', $email)->get();

        if ($users->isEmpty())
        { 
            return $this->error(400, "User dont exist");
        }
      
        $userDecrypt = Users::where('email', $email)->first();
				$passwordHold = $userDecrypt->password;

        $decryptedPassword = decrypt($passwordHold);
        $key = $this->key;
        if (self::checkLogin($email, $password))
        {   
        	$userSave = Users::where('email', $email)->first();

            $array = $arrayName = array
            (
                'id' => $userSave->id,
                'email' => $email,
                'password' => $password,
                'name' => $userSave->name
            );
           
           	// $token = JWT::encode($array, $key);

           	// return $this->createResponse(200, 'login correcto', ['token'=>$token, 'user' => $userSave, 'privacity' =>$privacity]);
           
            return $this->success("Login success");
            // return response($token)->header('Access-Control-Allow-Origin', '*');
        }
        	else
        {
            return response("wrong data", 403)->header('Access-Control-Allow-Origin', '*');
        }    
    }

    public function update (Request $request)
    {

    }   
}