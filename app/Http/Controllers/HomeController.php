<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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

    public function viewAllUser(){
        return view('users');

    }
    //for all user api data
    public function allUser(){
        $my_location = Auth::user()->location;
        $sql_distance = DB::raw('( 111.045 * acos( cos( radians(' . $my_location->lat . ') )
                       * cos( radians( locations.lat ) )
                       * cos( radians( locations.long )
                       - radians(' . $my_location->long  . ') )
                       + sin( radians(' . $my_location->lat  . ') )
                       * sin( radians( locations.lat ) ) ) )'); // distance calculate by  Haversine formula

        $users = User::join('locations','users.id','locations.user_id')
            ->select('locations.lat', 'locations.long','users.*')
            ->selectRaw("{$sql_distance} AS distance")
            ->selectRaw("TIMESTAMPDIFF(YEAR, DATE(dob), current_date) AS age") // Age calculate
            ->orderBy('distance')
            ->where('users.id' ,'!=' ,Auth::user()->id)
            ->having('distance' ,'<=' ,5)
            ->get();

        return response()->json(['users'=>$users]);

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
                if (Auth::user()->image !== 'default.png'){
                    $this->deleteOne($folder,'public',Auth::user()->image);
                }
                User::where('id',Auth::user()->id)->update(['image'=>$name]);
            }
            return redirect()->back()->with(['status' => 'Profile updated successfully.']);
        }

    }

    public function uploadSingleFile(UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null)
    {
        $name = !is_null($filename) ? $filename : Str::random(25);

        $file = $uploadedFile->storeAs($folder, $name, $disk);

        return $file;
    }

    public function deleteOne($folder = null, $disk = 'public', $filename = null)
    {
        Storage::disk($disk)->delete($folder.$filename);
    }

}
