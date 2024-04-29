<?php

namespace App\Providers;

use Illuminate\Auth\Passwords\PasswordResetServiceProvider as ServiceProvider;
use Illuminate\Support\Str;

class CustomPasswordResetServiceProvider extends ServiceProvider
{
    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return $this->app->make('auth.password')->broker();
    }

    /**
     * Get the password reset token repository implementation.
     *
     * @return \Illuminate\Auth\Passwords\TokenRepositoryInterface
     */
    protected function getTokenRepository()
    {
        $tokenRepository = parent::getTokenRepository();

        $tokenRepository->createNewToken = function ($notifiable) {
            return Str::random(60) . '?' . http_build_query(['email' => $notifiable->getEmailForPasswordReset()]);
        };

        return $tokenRepository;
    }
}