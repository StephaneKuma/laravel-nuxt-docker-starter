<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(fn(object $notifiable, string $token) => config('app.frontend_url') . "/password-reset/{$token}?email={$notifiable->getEmailForPasswordReset()}");
    }
    /**
     * Register any application services.
     */
    public function register(): void {}
}
