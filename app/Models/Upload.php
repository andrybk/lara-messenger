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
        $path = $this->file;
        $result = basename($this->file);
        return $result;
    }
}
