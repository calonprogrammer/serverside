<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function getAllCity(){
        $cities = City::all();
        return response()->json([
            'message'=> 'Sukses',
            'cities'=>$cities]);
    }
}
