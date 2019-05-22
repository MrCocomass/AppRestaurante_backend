<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use \Firebase\JWT\JWT;
use App\Users;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


protected function error($code, $message)
    {
        $json = ['message' => $message];
        $json = json_encode($json);
        return  response($json, $code)->header('Access-Control-Allow-Origin', '*');
    }
    
    protected function success($code, $message, $data = [])
    {
    	$json = ['code' => $code, 'message' => $message, 'data' => $data];
        $json = json_encode($json);
        return  response($json, 200)->header('Access-Control-Allow-Origin', '*');
    }

    function createResponse($code, $message, $data = [])
    {
        if ($data == null) {
           $data = (object)[];
        }
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data
        ]);

    }

    protected function checkLogin($email, $password)
    {
        $userSave = Users::where('email', $email)->first();
        $emailSave = $userSave->email;
        $passwordSave = $userSave->password;
        if($emailSave == $email && $passwordSave == $password)
        {
            return true;
        }
        return false;
    }

    function is_valid_email($str)
		{
  			return (false !== strpos($str, "@") && false !== strpos($str, "."));
		} 

}
