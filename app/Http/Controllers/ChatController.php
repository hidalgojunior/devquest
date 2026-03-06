<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;

class ChatController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        // list conversations -- for simplicity, distinct receivers/senders
        $convs = Message::where('sender_id',$user->id)
            ->orWhere('receiver_id',$user->id)
            ->get()
            ->map(function($m) use ($user){
                $other = $m->sender_id==$user->id ? $m->receiver : $m->sender;
                return ['id'=>$other->id,'name'=>$other->name,'url'=>route('chat.show',$other->id)];
            })->unique('id')->values();
        return view('chat.index', ['conversations'=>$convs]);
    }

    public function show($id)
    {
        $user = auth()->user();
        $other = User::findOrFail($id);
        $messages = Message::where(function($q) use($user,$other){
            $q->where('sender_id',$user->id)->where('receiver_id',$other->id);
        })->orWhere(function($q) use($user,$other){
            $q->where('sender_id',$other->id)->where('receiver_id',$user->id);
        })->orderBy('created_at')->get();
        return view('chat.show', compact('messages','other'));
    }

    public function store(Request $request, $id)
    {
        $user = auth()->user();
        $other = User::findOrFail($id);
        $data = $request->validate(['content'=>'required']);
        Message::create(['sender_id'=>$user->id,'receiver_id'=>$other->id,'content'=>$data['content']]);
        return back();
    }
}
