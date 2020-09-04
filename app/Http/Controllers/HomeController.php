<?php

namespace App\Http\Controllers;


use App\DislikeUsers;
use App\LikeUsers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;
use function GuzzleHttp\Promise\all;
use function Symfony\Component\String\u;

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
        $all_users = $users->map(function ($user) {
            return [
                'id'=>$user->id,
                'name'=>$user->name,
                'image'=>$user->image,
                'lat'=>$user->lat,
                'long'=>$user->long,
                'distance'=>$user->distance,
                'gender'=>$user->gender,
                'age'=> $user->age,
                'dob'=>$user->dob,
                'email'=>$user->email,
                'email_verified_at'=>$user->email_verified_at,
                'updated_at'=>$user->updated_at,
                'created_at'=>$user->created_at,
                'like' => $this->isLike($user->id),
                'dislike' => $this->isDislike($user->id)
            ];
        });

        return response()->json(['users'=>$all_users]);

    }

    public function uploadProfile(Request $request){
        $request->validate([
            'profile' => 'required'
        ]);
        if ($request->hasFile('profile')){
            $image = $request->file('profile');
            $name = time().$image->getClientOriginalName();
            $folder = '/';
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

    public function isLike($user_id){
        $like_by = Auth::user()->id;
        $check_like = LikeUsers::where(['like_by'=>$like_by,'like_to'=>$user_id])
            ->orWhere(function ($q) use ($user_id,$like_by){
                $q->where(['like_by'=>$user_id,'like_to'=>$like_by,'match_status'=>1]);
            })->first();
        if ($check_like) {
            return $check_like->match_status == 1 ? 2 : 1;
        } else {
            return 0;
        }
    }

    public function isDislike($user_id){
        $like_by = Auth::user()->id;
        $check_like = DislikeUsers::where(['dislike_by'=>$like_by,'dislike_to'=>$user_id])->count();
        if ($check_like > 0){
            return 1;
        } else {
            return 0;
        }
    }

}
