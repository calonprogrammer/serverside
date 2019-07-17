<?php

namespace App\Http\Controllers;

use App\Facility;
use App\Http\Requests\DestroyFacilityRequest;
use App\Http\Requests\StoreFacilityRequest;
use App\Http\Requests\UpdateFacilityRequest;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class FacilityController extends Controller
{
    public function store(StoreFacilityRequest $request){
        $id = Uuid::uuid();
        $name  = $request->name;
        $file = $request->file;
        $type = $request->type;
        $typeString = '';
        if($type == Facility::TYPE_UNIT){
            $typeString = 'unit';
        }else if($type == Facility::TYPE_PARKING) {
            $typeString = 'parking';
        }else if($type == Facility::TYPE_PUBLIC){
            $typeString = 'public';
        }else {
            return response()->json([
                'message'=>'Error Type',
                ],422);
        }
        $facility = new Facility();
        $facility->id = $id;
        $facility->name = $name;
        $facility->type = $type;

        $filename = $id . '.' . $file->getClientOriginalExtension();
        $destination = '/app/public/image/facilities/'.$typeString.'/';
        $file->move(storage_path($destination), $filename);

        $facility->link= 'storage/image/facilities/'.$typeString.'/'.$filename;

        $facility->save();
        return response()->json([
            'message'=>'Success'
            ],200);
        }


    public function get(){
        $facilities = Facility::paginate(10);
        return response()->json([
            'message'=>'Success',
            'facilities'=> $facilities],200);
    }

    public function getAll(){
        $facilities = Facility::all();
        return response()->json([
            'message'=>'Success',
            'facilities'=> $facilities],200);
    }
    public function destroy($id){
        $facility = Facility::find($id)->delete();

        return response()->json([
            'message'=>'Success',
        ]);
    }

    public function update(UpdateFacilityRequest $request){
        $id = $request->id;
        $name  = $request->name;
        $type = $request->type;
        if($type == Facility::TYPE_UNIT){
            $typeString = 'unit';
        }else if($type == Facility::TYPE_PARKING) {
            $typeString = 'parking';
        }else if($type == Facility::TYPE_PUBLIC){
            $typeString = 'public';
        }else {
            return response()->json([
                'message'=>'Error Type',web
            ],422);
        }
        $facility = Facility::find($id);
        $facility->name = $name;
        $facility->type = $type;
        $file = $request->file;
        if($file != 'null'){
            $filename = $id . '.' . $file->getClientOriginalExtension();
            $destination = '/app/public/image/facilities/'.$typeString.'/';
            $file->move(storage_path($destination), $filename);
            $facility->link= 'storage/image/facilities/'.$typeString.'/'.$filename;
        }
        $facility->save();
        return response()->json([
            'message'=>'Success'
        ],200);
    }

    public function search(Request $request){
        $key = strtolower( $request->key);
        $type = 0;
        switch ($key){
            case 'public':
                $type = Facility::TYPE_PUBLIC;
                break;
            case 'parking' :
                $type = Facility::TYPE_PARKING;
                break;
            case 'unit' :
                $type = Facility::TYPE_UNIT;
                break;
        }
        $results = Facility::where('name',"LIKE","%$key%")->orWhere('type',"LIKE","%$type%")->get();
        return response($results);
    }
}