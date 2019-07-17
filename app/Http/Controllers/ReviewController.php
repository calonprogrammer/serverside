<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddReviewRequest;
use App\Property;
use App\Review;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function getPaginateReview (Request $request){
        $property = Property::where('slug',$request->slug)->with(
            'propertiable',
            'facility',
            'city',
            'user')->first();
        $review = Review::where('property_id',$property->id)->orderBy('created_at','desc')->with('user')->paginate(10);
        return response()->json([
            'property' => $property,
            'review' => $review
        ]);
    }

    public function getAverageReview(Request $request){
        $review = Review::where('property_id',$request->property_id)->get();
        $count = Review::where('property_id',$request->property_id)->count();
        if($count == 0){
            return response()->json([
                'message' => null
            ]);
        }
        $cleanliness = null;
        $room_facility = null;
        $public_facility = null;
        $security = null;
        foreach ($review as $r){
            $cleanliness += $r->cleanliness;
            $room_facility += $r->room_facility;
            $public_facility += $r->public_facility;
            $security += $r->security;
        }
        $cleanliness = $cleanliness/$count;
        $room_facility = $room_facility/$count;
        $public_facility = $public_facility/$count;
        $security = $security/$count;
        return response()->json([
            'average' =>[
                'cleanliness' => $cleanliness,
                'room_facility' => $room_facility,
                'public_facility' => $public_facility,
                'security' => $security
                ]
        ],200);
    }

    public function store(AddReviewRequest $request){
        $review = new Review();
        $review->id = Uuid::uuid();
        $review->user_id = $request->user_id;
        $review->property_id = $request->property_id;
        $review->cleanliness = $request->cleanliness;
        $review->room_facility= $request->room_facility;
        $review->public_facility= $request->public_facility;
        $review->security = $request->security;
        $review->content = $request->contents;
        $review->save();
        return response()->json([
            'message'=>'Success Adding Review',
        ],200);
    }
}
