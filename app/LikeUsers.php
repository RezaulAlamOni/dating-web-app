<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LikeUsers extends Model
{
    protected $fillable = [
        'like_by','like_to','match_status'
    ];
}
