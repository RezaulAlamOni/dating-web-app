<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{

    protected $fillable = [
        'user_id','lat','long','name'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
