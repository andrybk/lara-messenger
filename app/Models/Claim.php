<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Claim extends Model
{
    use SoftDeletes;

    protected $casts = [
        'answered' => 'boolean',

    ];
    protected $dates = ['created_at', 'updated_at',];


    public function user(){
        return $this->belongsTo(User::class);
    }
    public function upload(){
        return $this->belongsTo(Upload::class);
    }
}
