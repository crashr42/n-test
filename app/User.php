<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


/**
 * Class User
 * @property string email
 * @property string last_name
 * @property string first_name
 * @property string state
 * @property string password
 * @property int id
 * @property int group_id
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property string api_token
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, Notifiable;

    protected $casts = [
        'id'       => 'integer',
        'group_id' => 'integer',
    ];

    protected $rules = [
        'last_name'  => 'required|string|max:50',
        'first_name' => 'required|string|max:50',
        'email'      => 'required|email|max:255',
        'password'   => 'required|string|max:255',
        'state'      => 'required|user_state',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'state', 'group_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function (User $user) {
            $user->api_token = bin2hex(openssl_random_pseudo_bytes(16));
        });
    }
}
