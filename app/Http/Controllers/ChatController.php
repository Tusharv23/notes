<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Message;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class ChatController extends Controller
{
    //
    

    public function index()
    {
        $users = DB::select('select name from users');    	
        return view('chat',['users' => $users]);
    }

    public function sendMessage(Request $request)
    {
        $text = $request->text;

        $message = new Message();
        $message->text = $text;
        $message->sender_username = Auth::user()->name;
        $message->receiver_username = $request->receiver;
        $message->save();
    }

    public function retrieve()
    {
        $message = Message::where('receiver_username','=',Auth::user()->name)->where('read','=',false)->orderBy('created_at','desc')->get();

            return $message;
        // if(count($message) > 0)
        // {
        //   $message->read  = true;
        //   $message->save();

        //   $data = ['sender'=>$message->sender_username , 'text'=>$message->text ];
        //   return $data;
        // }
    }
}

    // public function sendMessage(Request $request)
    // {
    // 	$username = Input::get('username');
    // 	$text = Input::get('text');

    // 	$message = new messages();
    // 	$message->sender_username = $username;
    // 	$message->message = $text;
    // 	$message->save();
    // }
    // public function typing()
    // {
    // 	$username = Input::get('username');

    // 	$chat = chats::find(1);
    // 	if($chat->user1 == $username)
    // 		$chat->user1_is_typing = true;
    // 	else
    // 		$chat->user2_is_typing = true;
    // 	$chat->save();
    // }

    //  public function nottyping()
    // {
    // 	$username = Input::get('username');

    // 	$chat = chats::find(1);
    // 	if($chat->user1 == $username)
    // 		$chat->user1_is_typing = false;
    // 	else
    // 		$chat->user2_is_typing = false;
    // 	$chat->save();
    // }

    // public function retrieveChatMessage()
    // {
    // 	$username = Input::get('username');

    // 	$message = messages::where('sender_username','!=','$username')->where('read','=',false)->first();

    // 	if(count($message) > 0)
    // 	{
    // 		$message->read  = true;
    // 		$message->save();
    // 		return $message->message;
    // 	}
    // }

    // public function retrieveTypingStatus()
    // {
    // 	$username = Input::get('username');

    // 	$chat = chats::find(1);
    // 	if($chat->user1 == $username)
    // 	{
    // 		if($chat->user2_is_typing)
    // 			return $chat->user2;
    // 	}
    // 	else
    // 	{
    // 		if ($chat->user1_is_typing) {
    // 			# code...
    // 			return $chat->user1;
    // 		}
    // 	}
    // }

