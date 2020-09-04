<?php

namespace App\Http\Controllers;

use App\DislikeUsers;
use App\LikeUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeUsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createLike(Request $request)
    {
        $like_by = Auth::user()->id;
        $like_to = $request->user_id;

        $check_like = LikeUsers::where(['like_by' => $like_by, 'like_to' => $like_to])->first();
        if (!$check_like) {
            $check_like1 = LikeUsers::where(['like_by' => $like_to, 'like_to' => $like_by])->first();
            if ($check_like1) {
                if ($check_like1->match_status == 1) {
                    return response()->json(['status' => 'match']);
                } else {
                    LikeUsers::where(['id'=>$check_like1->id])
                        ->update([
                            'match_status' => 1
                        ]);
                    return response()->json(['status' => 'match']);
                }
            } else {
                LikeUsers::create([
                    'like_by' => $like_by,
                    'like_to' => $like_to
                ]);
                return response()->json(['status' => 'success']);
            }
        } else {
            return response()->json(['status' => 'already liked']);
        }
    }

    public function createDislike(Request $request)
    {
        $like_by = Auth::user()->id;
        $like_to = $request->user_id;

        $check_like = DislikeUsers::where(['dislike_by' => $like_by, 'dislike_to' => $like_to])->count();
        if ($check_like <= 0) {
            DislikeUsers::create([
                'dislike_by' => $like_by,
                'dislike_to' => $like_to
            ]);

            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'already disliked']);
        }
    }


}
