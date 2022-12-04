<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Client;
use Laravel\Passport\Passport;
use Illuminate\Support\Str;
use Laravel\Passport\Token;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Passport::ignoreMigrations();
        // Passport::useClientModel(\App\Models\PassportClient::class);
        // Passport::useTokenModel(\App\Models\PassportToken::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Token::creating(function (Token $token) {
            $token->user_id = Str::uuid()->toString();
        });

        // Client::creating(function (Client $client) {
        //     $client->incrementing = false;
        //     $client->id = Str::uuid()->toString();
        // });

        // Client::retrieved(function (Client $client) {
        //     $client->incrementing = false;
        // });
    }
}
