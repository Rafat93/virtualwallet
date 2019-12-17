<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nif',
        'photo',
        'type',
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
    ];

    public function typeToStr()
    {
        switch ($this->type) {
            case 'a':
                return 'Administrator';
            case 'o':
                return 'Operator';
            case 'u':
                return 'user';
        }

        return 'Unknown';
    }

    public function nifIsNull(){
        if($this->nif == null){
            return "-";
        }
        return $this->nif;
    }

    public function activeToStr()
    {
        switch ($this->ativo) {
            case 1:
                return 'Active';
            case 0:
                return 'Inactive';
        }

        return -1;
    }

    public function  isAdmin(){
        return strcmp($this->type ,'a')==0;
    }
}
