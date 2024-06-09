<?php

namespace App\Http\Controllers\Admin;

use App\Applications;
use App\Http\Controllers\Controller;
use App\Posts;
use App\Staff;
use App\Students;
use illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
}
