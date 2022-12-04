<?php

namespace App\Models;

use Illuminate\Support\Str;
use Laravel\Passport\Client as OAuthClient;

class PassportClient extends OAuthClient
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
            $model->uuid = Str::uuid()->toString();
        });
    }
}
