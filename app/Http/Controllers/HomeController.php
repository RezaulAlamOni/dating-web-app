<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
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
        $request->validate([
            'profile' => 'required'
        ]);
        if ($request->hasFile('profile')){
            $image = $request->file('profile');
            $name = time().$image->getClientOriginalName();
            $folder = '/images/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder;
            $uploaded_file = $this->uploadSingleFile($image,$filePath,'public',$name);
            if ($uploaded_file){
                User::where('id',Auth::user()->id)->update(['image'=>$name]);
            }
            return back();
        }

    }

    public function uploadSingleFile(UploadedFile $uploadedFile, $folder = null, $disk = 'storage', $filename = null)
    {
        $name = !is_null($filename) ? $filename : Str::random(25);

        $file = $uploadedFile->storeAs($folder, $name, $disk);

        return $file;
    }
}
