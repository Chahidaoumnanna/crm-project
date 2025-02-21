<?php

namespace App\Http\Controllers\Api;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }
}
