<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use \Firebase\JWT\JWT;
use App\Orders;

class OrderController extends Controller
{
   public function add()
    {
    	$id_user = $_POST['id_user'];
        $id_user = $_POST['id_food'];
        $orders = Orders::where('id_user', $id_user)->get();

        foreach ($orders as $order => $id_user) 
        {
        	return $this->error(400, 'this food is already added'); 
        }
        
        // $food = Foods::where('email', $email)->get();
        
		$foods = new Orders();
            $orders->id_user = $id_user;
            $orders->id_food = $id_food;
            
            $orders->save();
            return $this->success(200, 'food added');                   
    }
}
