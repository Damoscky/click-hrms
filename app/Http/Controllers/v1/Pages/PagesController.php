<?php

namespace App\Http\Controllers\v1\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        return view('pages.login');
    }

    
}
