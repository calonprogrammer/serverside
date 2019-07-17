<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Chat;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function synchronizeChat(Request $request){
        $owner_id = $request->owner_id;
        $guest_id = $request->guest_id;
        $channel = Channel::where('owner_id',$owner_id)->where('guest_id',$guest_id)
            ->first();
        return response()->json([
            'channel' => $channel
        ]);
    }

    public function index(Request $request){
        $id = $request->user->id;
        $channel = Channel::where('owner_id',$id)->orWhere('guest_id',$id)
            ->with('guest','owner')
            ->get();
        return response()->json([
            'channel' => $channel
        ]);
    }

    public function checkChannel(Request $request){
        $guestId = $request->user->id;
        $ownerId = $request->owner_id;
        $channel = Channel::where('owner_id',$ownerId)->where('guest_id',$guestId)->first();
        if($channel == null){
            $channel = new Channel();
            $channel->id = Uuid::uuid();
            $channel->guest_id = $guestId;
            $channel->owner_id = $ownerId;
            $channel->save();
        }
        return response()->json([
            'channel'=>$channel
        ],200);
    }

    public function getAllChat(Request $request){
        $chat = Chat::where('channel_id',$request->channel_id)->get();
        return response()->json([
            'chat' => $chat
        ],200);
    }
}
