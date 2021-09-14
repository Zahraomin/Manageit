<?php

namespace App\Http\Controllers;
use App\Device;
use App\Application;
use App\User;
use Session;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id=Session::get('key');
        Session::forget('key');
        
        return view('home', ['id' => $id])
        ->with('Device', Device::all())
        ->with('Application', Application::all())
        ->with('User', User::all());
        
        ;
    }
}
