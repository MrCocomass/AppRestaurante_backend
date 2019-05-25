<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use \Firebase\JWT\JWT;
use App\Users;

class UserController extends Controller
{

	public function index()
    {
        
        $header = getallheaders();
        $userParams = JWT::decode($header['Authorization'], $this->key, array('HS256'));
    }

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

        if (strlen($password) < 8){

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
                // $users->rol_id = 2;

                $users->save();
            }

            catch(Exception $e)
            {
                return $this->error(2, $e->getMessage());
            }
            
            return $this->success('Usuario registrado correctamente');
        }
        	else
        {
            return $this->error(401, 'Debes rellenar todos los campos');
        }
    }

    protected function login (Request $request)

    {

        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($email)){

            return $this->error (401, 'Por favor introduce un email');

        }

        if (empty($password)){

            return $this->error (401, 'Por favor introduce el password');

        }

        $users = Users::where('email', $email)->get();


        if ($users->isEmpty()) { 

            return $this->error(400, "Ese usuario no existe, por favor introduce un email correcto");

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

            
        $token = JWT::encode($array, $key);

            return $this->success("Usuario logeado", $token);

            // return response($token)->header('Access-Control-Allow-Origin', '*');

        }
        	else
        {
            return response("Los datos no son correctos", 403)->header('Access-Control-Allow-Origin', '*');
        }
        

    }

}

   //  public function register()
   //  {

   //  		if (empty($_POST['email']) || empty($_POST['password']) )
   //  		{
   //  			print('rellenar todos los campos');
   //  			exit();
   //  		}

   //  		if(strlen($_POST['password']) < 8 || strlen($_POST['password']) > 12)
   //  		{
   //              return $this->createResponse(400, 'La contraseña ha de tener entre 8 y 12 caracteres');
   //      	}

        	
   //  		$name = $_POST['name'];
   //      	$email = $_POST['email'];
   //      	$password = $_POST['password'];
   //      	$users = Users::where('email', $email)->get();

			// $users = new Users();
   //         		$users->email = $email;
   //          	$users->password = $password;
   //          	$users->name = $name;
   //          	$users->save();
  
   //  }
	
	// public function login()

 //    {
 //    	$email = $_POST['email'];
 //            $password = $_POST['password'];
 //            $users = Users::where('email', $email)->get();

 //    	if(self::checkLogin($email, $password)){ 

 //                $userSave = Users::where('email', $email)->first();
 //            }

 //            if (empty($_POST['password']))
 //    		{
 //    			print('rellena los campos');
 //    			exit();
 //    		}
 //    }
