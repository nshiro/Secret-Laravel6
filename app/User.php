<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];

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

    /**
     * A user has many messages
     */
    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    /**
     * Boot
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function($user) {
            $user->messages()->delete();
        });
    }

    /**
     * ユーザーの一覧を取得（プルダウン用）
     */
    public static function getUserList()
    {
        return static::latest()->pluck('name', 'id');
    }
}
