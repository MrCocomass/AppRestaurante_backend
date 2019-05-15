<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Foods;

class FoodController extends Controller
{

	public function index()
	{
		$headers = getallheaders();
		$foodList = Foods::where('name')->get();
		print('hola');
	}


	public function add()

    {
    $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $imagen = $_POST['imagen'];

        // $food = Foods::where('email', $email)->get();
        
		$foods = new Foods();
            $foods->name = $name;
            $foods->price = $price;
            $foods->description = $description;
            $foods->imagen = $imagen;
            $foods->save();
    }

    public function get_food()

    {
    	
    }
}
