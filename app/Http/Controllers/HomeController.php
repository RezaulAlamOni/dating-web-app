<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

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
        return view('home');
    }

    //for all user api data 
    public function allUser(){
        $user = User::all();
        return $user;

    }

    public function viewAllUser(){
       return view('users');

    }

    public function uploadProfile(Request $request){
       return $request->all();

    }
}
