<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foods extends Model
{
    protected $table = 'foods';

    protected $fillable = ['name', 'description', 
    'price', 'imagen'];
}
