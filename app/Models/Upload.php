<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    //
    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }

    public function fileName(){
        return basename($this->file);
    }
}
