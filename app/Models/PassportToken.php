<?php

namespace App\Models;

use Illuminate\Support\Str;
use Laravel\Passport\Token as OAuthToken;

class PassportToken extends OAuthToken
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->user_uuid = Str::uuid()->toString();
        });
    }
}
