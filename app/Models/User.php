<?php

namespace App\Models;

use App\Notifications\VerifyEmailQueuedNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function short_url() : HasMany
    {
        return static::hasMany(ShortUrl::class , 'user_id');
    }
    public function visits() : HasMany
    {
        return static::hasMany(ShortUrlVisit::class , 'user_id');
    }

    public function sendEmailVerificationNotification()
    {
        static::notify(new VerifyEmailQueuedNotification());

    }

}
