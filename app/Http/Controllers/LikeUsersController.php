<?php

namespace App\Http\Controllers;

use App\LikeUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeUsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createLike(Request  $request){
        $like_by = Auth::user()->id;
        $like_to = $request->user_id;

        $check_like = LikeUsers::where(['like_by'=>$like_by,'like_to'=>$like_to])
            ->orWhere(function ($q) use ($like_to,$like_by){
                $q->where(['like_by'=>$like_to,'like_to'=>$like_by,'match_status'=>1]);
            })->count();
        if ($check_like <= 0){
            LikeUsers::create([
                'like_by'=>$like_by,
                'like_to'=>$like_to
            ]);

            return response()->json(['status'=>'success']);
        } else {
            return response()->json(['status'=>'already liked']);
        }
    }
}
