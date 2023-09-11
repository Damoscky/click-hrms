<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function chat($id)
    {
        $id = base64_decode($id);
        $record = User::find($id);
        return view('admin.chat.chat', ['record' => $record]);
    }
}
