<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Ad;
use App\Models\Message;

class ChatController extends Controller
{
    
    public function index()
    {
        $userId = auth()->id();

        $chats = Chat::where('buyer_id', $userId)
            ->orWhere('seller_id', $userId)
            ->with(['lastAd', 'messages'])
            ->latest()
            ->get();

        return view('chat.index', compact('chats'));
    }


    public function createOrOpen(Ad $ad)
    {
        $userId = auth()->id();

        $chat = Chat::firstOrCreate([
            'buyer_id' => $userId,
            'seller_id' => $ad->user_id,
        ]);

        $chat->update([
            'last_ad_id' => $ad->id
        ]);

        return redirect()->route('chats.show', $chat);
    }

    public function show(Chat $chat)
    {
        $chat->load(['messages.user', 'buyer', 'seller', 'lastAd']);

        return view('chat.show', compact('chat'));
    }

    public function send(Request $request, Chat $chat)
    {
        $request->validate([
            'message' => ['required', 'string', 'max:5000'],
        ]);

        $chat->messages()->create([
            'user_id' => auth()->id(),
            'message' => $request->message,
            'read' => false,
            'sent_at' => now(),
        ]);

        return redirect()->back();
    }














}
