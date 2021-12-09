<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index() {

        $messages = Message::all();

        return view('pages.message.index', [
            'title' => 'Messages', 
            'messages' => $messages
        ]);
    
    }

    public function reply() {
        return view('pages.message.reply', [
            'title' => 'Reply'
        ]);
    }

    public function send(Request $request) {

    }

}
