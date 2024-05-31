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
        $staff = Staff::where('email', Auth::user()->email)->first();
        //dd($staff->post);
        $auth_post = $staff->post;
        $applications = Applications::all();
        for ($i = 0; $i < count($applications); $i++) {
            $application = $applications[$i];
            //dd($application->category->post);
            $post = $application->category->post;
            if ($auth_post != $post){
                unset($applications[$i]);
            }
        }
        $count = 0;
        foreach ($applications as $application){
            if ($application->is_check == 0)
                $count++;
        }
        $students = Students::with('room')->get();

        return view('admin.index', compact('applications', 'count', 'students'));
    }
}
