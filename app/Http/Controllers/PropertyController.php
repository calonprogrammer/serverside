<?php

namespace App\Http\Controllers;

use App\Apartement;
use App\Facility;
use App\History;
use App\House;
use App\Http\Requests\AddApartementRequest;
use App\Http\Requests\AddKostRequest;
use App\Property;
use App\Review;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class PropertyController extends Controller
{
    public function addApartemen(AddApartementRequest $request){
        $property = new Property();

        $id = Uuid::uuid();
        $property->id = $id;


        $name = $request->name;
        $property->name = $name;

        $user_id = $request->user_id;
        $property->user_id = $user_id;


        $pict_id = $request->pict_id;
        //picture
        $tempId = Uuid::uuid();

        if($pict_id !== null){
            $pictureFilename = $tempId . '.' . $pict_id->getClientOriginalExtension();
            $destination = '/app/public/image/property/'.$id.'/';
            $pict_id->move(storage_path($destination), $pictureFilename);
            $property->pict_id = 'storage/image/property/'.$id.'/'.$pictureFilename;
        }

        $banner_id =$request->banner_id;
        if($banner_id != null){
            $tempId = Uuid::uuid();
            $bannerFilename = $tempId . '.' . $banner_id->getClientOriginalExtension();
            $destination = '/app/public/image/property/'.$id.'/';
            $banner_id->move(storage_path($destination), $bannerFilename);
            $property->banner_id = 'storage/image/property/'.$id.'/'.$bannerFilename;
        }

        $pict360_id= $request->pict360_id;
        if($pict360_id != null){
            $tempId = Uuid::uuid();
            $pict360Filename = $tempId . '.' . $banner_id->getClientOriginalExtension();
            $destination = '/app/public/image/property/'.$id.'/';
            $pict360_id->move(storage_path($destination), $pict360Filename);
            $property->pict360_id = 'storage/image/property/'.$id.'/'.$pict360Filename;
        }

//        $video_id= $request->video_id;
//        if($video_id != null){
//            $tempId = Uuid::uuid();
//            $videoFilename = $tempId . '.' . $banner_id->getClientOriginalExtension();
//            $destination = '/app/public/video/property/'.$id.'/';
//            $pict360_id->move(storage_path($destination), $videoFilename);
//            $property->video_id = 'storage/video/property/'.$id.'/'.$videoFilename;
//        }

        $description= $request->description;
        $property->description = $description;

        $area	= $request->unit_area;
        $property->area = $area;


        $string = $request->facilities;
        $temp = explode(",", $string);
        $facilities	= $temp;

        foreach ($facilities as $facility){
            $tempFacility = Facility::find($facility);
            $property->facility()->save($tempFacility);
        }

        $additional_information	= $request->addtional_information;
        if($additional_information!= null){
            $property->additional_information = $additional_information;
        }

        $additional_fees	= $request->addtional_fees;
        if($additional_fees != null){
            $property->additionalFees =  $additional_fees;
        }

        $price	= $request->price;
        $property->price = $price;

        $period	= $request->period;
        $property->period = $period;

        $city_id	= $request->city_id;
        $property->city_id = $city_id;

        $longitude	= $request->longitude;
        $property->longitude = $longitude;

        $latitude	= $request->latitude;
        $property->latitude= $latitude;

        $address	= $request->address;
        $property->address = $address;

        $property->propertiable_id =$id;
        $property->propertiable_type = Apartement::class;

        $property->slug = str_slug($name)."-".$id."-apartement";
        //execute
        $apartement = new Apartement();

        $apartement->id = $id;
        $unit_type = $request->unit_type;
        $apartement->unit_type = $unit_type;

        $unit_condition	 = $request->unit_condition;
        $apartement->unit_condition= $unit_condition;

        $unit_floor	 = $request->unit_floor;
        $apartement->unit_floor = $unit_floor;

        $furnished = $request->furnished;
        $apartement->furnished = $furnished;

        $apartement->save();
        $property->save();
        return response()->json([
            'message'=>'Success',
        ],200);
    }

    public function addKost(AddKostRequest $request){
        $property = new Property();

        $id = Uuid::uuid();
        $property->id = $id;

        $name = $request->name;
        $property->name = $name;

        $user_id = $request->user_id;
        $property->user_id = $user_id;

        $pict_id = $request->pict_id;
        //picture
        $tempId = Uuid::uuid();
        if($pict_id !== null){
            $pictureFilename = $tempId . '.' . $pict_id->getClientOriginalExtension();
            $destination = '/app/public/image/property/'.$id.'/';
            $pict_id->move(storage_path($destination), $pictureFilename);
            $property->pict_id = 'storage/image/property/'.$id.'/'.$pictureFilename;
        }

        $banner_id =$request->banner_id;
        if($banner_id != null){
            $tempId = Uuid::uuid();
            $bannerFilename = $tempId . '.' . $banner_id->getClientOriginalExtension();
            $destination = '/app/public/image/property/'.$id.'/';
            $banner_id->move(storage_path($destination), $bannerFilename);
            $property->banner_id = 'storage/image/property/'.$id.'/'.$bannerFilename;
        }

        $pict360_id= $request->pict360_id;
        if($pict360_id != null){
            $tempId = Uuid::uuid();
            $pict360Filename = $tempId . '.' . $banner_id->getClientOriginalExtension();
            $destination = '/app/public/image/property/'.$id.'/';
            $pict360_id->move(storage_path($destination), $pict360Filename);
            $property->pict360_id = 'storage/image/property/'.$id.'/'.$pict360Filename;
        }

//        $video_id= $request->video_id;
//        if($video_id != null){
//            $tempId = Uuid::uuid();
//            $videoFilename = $tempId . '.' . $banner_id->getClientOriginalExtension();
//            $destination = '/app/public/video/property/'.$id.'/';
//            $pict360_id->move(storage_path($destination), $videoFilename);
//            $property->video_id = 'storage/video/property/'.$id.'/'.$videoFilename;
//        }

        $description= $request->description;
        $property->description = $description;

        $area	= $request->unit_area;
        $property->area = $area;


        $string = $request->facilities;
        $temp = explode(",", $string);
        $facilities	= $temp;

        foreach ($facilities as $facility){
            $tempFacility = Facility::find($facility);
            $property->facility()->save($tempFacility);
        }

        $additional_information	= $request->addtional_information;
        if($additional_information!= null){
            $property->additional_information = $additional_information;
        }

        $additional_fees	= $request->addtional_fees;
        if($additional_fees != null){
            $property->additionalFees =  $additional_fees;
        }

        $price	= $request->price;
        $property->price = $price;

        $period	= $request->period;
        $property->period = $period;

        $city_id	= $request->city_id;
        $property->city_id = $city_id;

        $longitude	= $request->longitude;
        $property->longitude = $longitude;

        $latitude	= $request->latitude;
        $property->latitude= $latitude;

        $address	= $request->address;
        $property->address = $address;


        $property->propertiable_id =$id;
        $property->propertiable_type = House::class;

        $property->slug = str_slug($name)."-".$id."-house";
        //execute
        $kost= new House();
        $kost->id = $id;
        $room_remaining = $request->room_remaining;
        $kost->room_remaining = $room_remaining;
        $gender_type = $request->gender_type;
        $kost->gender_type = $gender_type;
        $kost->save();
        $property->save();
        return response()->json([
            'message'=>'Success',
        ],200);
    }

    public function getFourApartement(Request $request){
        $property = Property::where('propertiable_type',Apartement::class)->where('ban','NOTLIKE','1');
        if($request->city_id != null){
            $properties = $property->where('city_id',$request->city_id)->orderBy('total_view','desc')->with('user.transactionPremium','propertiable','facility','city')->take(4)->get();
            return response()->json([
                'apartements' => $properties
            ]);
        }
        $properties = Property::select(DB::raw('*, ( 6367 * acos( cos( radians('.$request->latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$request->longitude.') ) + sin( radians('.$request->latitude.') ) * sin( radians( latitude ) ) ) ) AS distance'))
            ->where('propertiable_type',Apartement::class)->where('ban','NOTLIKE','1')
            ->having('distance', '<', 40)
            ->orderBy('distance')->with('user.transactionPremium','propertiable','facility','city','review')->take(4)
            ->get();
        return response()->json([
            'apartements' => $properties
        ]);
    }

    public function getFourKost(Request $request){
        $property = Property::where('propertiable_type',House::class)->where('ban','NOTLIKE','1');
        if($request->city_id != null){
            $properties = $property->orderBy('total_view','desc')->with('user.transactionPremium','propertiable','facility','city','review')->where('city_id',$request->city_id)->take(4)->get();
            return response()->json([
                'kosts' => $properties
            ]);
        }
        $properties = Property::select(DB::raw('*, ( 6367 * acos( cos( radians('.$request->latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$request->longitude.') ) + sin( radians('.$request->latitude.') ) * sin( radians( latitude ) ) ) ) AS distance'))
            ->where('propertiable_type',House::class)->where('ban','NOTLIKE','1')
            ->having('distance', '<', 40)
            ->orderBy('distance')->with('user.transactionPremium','propertiable','facility','city','review')->take(4)
            ->get();
        return response()->json([
            'kosts' => $properties
        ]);
    }

    public function getRandomApartement(){
        $properties = Property::where('propertiable_type',Apartement::class)->where('ban','NOTLIKE','1')
            ->with('user.transactionPremium','propertiable','facility','city','review')->take(4)
            ->inRandomOrder()->get();
        return response()->json([
            'apartements' => $properties
        ]);
    }

    public function getRandomKost(){
        $properties = Property::where('propertiable_type',House::class)->where('ban','NOTLIKE','1')
            ->with('user.transactionPremium','propertiable','facility','city','review')->take(4)
            ->inRandomOrder()->get();
        return response()->json([
            'kosts' => $properties
        ]);
    }

    public function getPropertyWithSlug(Request $request){
        try{
            $user = JWTAuth::parseToken()->authenticate();
        }catch (\Exception $e){
            $user = null;
        }


        $property = Property::where('slug',$request->slug)->with(
            'propertiable',
            'facility',
            'city',
            'user.transactionPremium')->first();
        $property->total_view += 1;
        $property->save();
        if($user !== null){
            $history = History::where('property_id',$property->id)
                ->where('user_id',$user->id)->first();
            if($history == null){
                $history = new History();
                $history->id = Uuid::uuid();
            }

            $history->user_id = $user->id;
            $history->property_id = $property->id;
            $history->save();
        }
        $review = Review::where('property_id',$property->id)->orderBy('created_at','desc')->with('user')->paginate(3);
        return response()->json([
            'property' => $property,
            'review' => $review
        ]);
    }
    public function ban(Request $request){
        $property = Property::where('id',$request->id)->first();
        $property->ban = true;
        $property->save();
        return response()->json([
            'message'=> 'Success Ban'
        ]);
    }

    public function deleteProperty(Request $request){
        $property = Property::find($request->id)->delete();
        return response()->json(
            ['message'=> 'Success Delete Property'],200);
    }

    public function getNearbyApartement(Request $request){
        $properties = Property::select
        (DB::raw('*, ( 6367 * acos( cos( radians('.$request->latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$request->longitude.') ) + sin( radians('.$request->latitude.') ) * sin( radians( latitude ) ) ) ) AS distance'))
            ->where('propertiable_type',Apartement::class)->where('ban','NOTLIKE','1')
            ->having('distance', '<', 40)
            ->orderBy('distance')->with('user.transactionPremium','propertiable','facility','city','review')
            ->simplePaginate(10);
        return response()->json([
            'properties' => $properties
        ]);
    }

    public function getNearbyKost(Request $request){
        $properties = Property::select(DB::raw('*, ( 6367 * acos( cos( radians('.$request->latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$request->longitude.') ) + sin( radians('.$request->latitude.') ) * sin( radians( latitude ) ) ) ) AS distance'))
            ->where('propertiable_type',Apartement::class)->where('ban','NOTLIKE','1')
            ->having('distance', '<', 40)
            ->orderBy('distance')->with('user.transactionPremium','propertiable','facility','city','review')
            ->simplePaginate(10);
        return response()->json([
            'properties' => $properties
        ]);
    }
}
