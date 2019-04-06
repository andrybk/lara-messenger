<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use SoftDeletes;

    public function user(){
        return $this->belongsTo(User::class);
    }
}
