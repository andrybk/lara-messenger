<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class User extends Authenticatable
{
    use Notifiable;

    protected $dates = ['created_at', 'updated_at', 'last_claim_created_at'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'last_claim_created_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_claim_created_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasRole($roleName)
    {
        $result = $this->role->name == $roleName;
        return $result;
    }

    public function waitFor()
    {
        if (!$this->canClaim()) {
            $datetime = Carbon::now()->diffInRealSeconds($this->last_claim_created_at->addDays(1));

            return $datetime;
        }

        return 0;
    }

    public function canClaim()
    {

        $user_date = $this->last_claim_created_at;
        if ($user_date) {
            $if1 = $user_date->addDays(1);
            $if2 = Carbon::now();

            if ($if1 < $if2) {

                return true;
            }

            return false;
        }
        return true;
    }


}

