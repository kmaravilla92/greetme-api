<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Card;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('view-cards', function (User $user, Card $card) {
            dump($user->id, $card->user_id);
            return $user->id === $card->user_id;
        });
    }
}
