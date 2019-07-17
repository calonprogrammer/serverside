<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePremiumRequest;
use App\Premium;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;

class PremiumController extends Controller
{
    public function getAll(){
        $premiums = Premium::paginate(10);
        return response()->json([
            'premiums'=> $premiums],200);
    }
    public function destroy($id){
        Premium::find($id)->delete();
        return response()->json([
            'message'=>'Success',
        ]);
    }

    public function update(UpdatePremiumRequest $request){
        $premium = Premium::find($request->id);
        $premium->name = $request->name;
        $premium->duration = $request->duration;
        $premium->discount = $request->discount;
        $premium->price = $request->price;
        $premium->save();
        return response()->json([
            'message' => 'Success',
        ],200);
    }

    public function add(UpdatePremiumRequest $request){
        $premium = new Premium();
        $premium->id = Uuid::uuid();
        $premium->name = $request->name;
        $premium->duration = $request->duration;
        $premium->discount = $request->discount;
        $premium->price = $request->price;
        $premium->save();
        return response()->json([
            'message' => 'Success'
        ],200);
    }
    public function search(Request $request){
        $key = strtolower( $request->key);
        $results = Premium::where('name',"LIKE","%$key%")->orWhere('duration',"LIKE","%$key%")->orWhere('discount',"LIKE","%$key%")->get();
        return response($results);
    }

}
