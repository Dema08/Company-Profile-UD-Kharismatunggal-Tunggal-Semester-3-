<?php
// app/Notifications/ResetPassword.php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;

class ResetPassword extends ResetPasswordNotification
{
    protected function getUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'password.reset',
            Carbon::now()->addMinutes(config('auth.passwords.'.config('auth.defaults.passwords').'.expire')),
            ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()]
        );
    }
}
