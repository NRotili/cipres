<?php

namespace App\Http\Controllers\Panel\Whatsapp\Chats;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    //index
    public function index()
    {
        return view('panel.whatsapp.chats.index');
    }
}
