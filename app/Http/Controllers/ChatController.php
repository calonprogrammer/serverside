<?php

namespace App\Http\Controllers;

use App\Chat;
use Carbon\Carbon;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ChatController extends Controller
{
    public function create(Request $request){
        $chat = new Chat();
        $chat->id = Uuid::uuid();
        $chat->channel_id = $request->channel_id;
        $chat->sender = $request->sender;
        $chat->receiver = $request->receiver;
        $chat->message = $request->message;
        $chat->sent_time = Carbon::now();
        $chat->save();
        return response()->json([
            'message'=>'Success'
        ]);
    }

}
