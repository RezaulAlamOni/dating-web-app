<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DislikeUsers extends Model
{
    protected $fillable = [
        'dislike_to','dislike_by'
    ];
}
