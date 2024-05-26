<?php

namespace App\Http\Controllers;

use App\Post;

use \App\Season;
use \App\Episode;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }
}
