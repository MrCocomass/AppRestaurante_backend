<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use \Firebase\JWT\JWT;
use App\Foods;

class FoodController extends Controller
{

	public function index()
	{
		$headers = getallheaders();
		$foodList = Foods::where('name')->get();
	}

	public function add()
    {
    	$name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $imagen = $_POST['imagen'];
        $foods = Foods::where('name', $name)->get();

        foreach ($foods as $food => $name) 
        {
        	return $this->error(400, 'this food is already added'); 
        }

        // $food = Foods::where('email', $email)->get();
        
		$foods = new Foods();
            $foods->name = $name;
            $foods->price = $price;
            $foods->description = $description;
            $foods->imagen = $imagen;
            $foods->save();
            return $this->success(200, 'food added');                   
    }

    public function get_food()
    {
    	$foods = Foods::all();
        return $this->createResponse(200, 'Comidas', array('comidas' => $foods));
    }

}
