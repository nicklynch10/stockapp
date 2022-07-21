<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class VerifyEmail extends Notification implements ShouldQueue
{

    use Queueable;

    public static $createUrlCallback;

    public static $toMailCallback;

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        if (static::$toMailCallback) {
            return call_user_func(
                static::$toMailCallback,
                $notifiable,
                $verificationUrl
            );
        }

        return $this->buildMailMessage($verificationUrl, $notifiable);
    }
    protected function buildMailMessage($url, $notifiable)
    {
        $appName = appName(false, $notifiable);
        $appLogo = appLogo(false, $notifiable);

        return (new MailMessage())
            ->markdown('notifications::email', [
                'appName' => $appName,
                'appLogo' => $appLogo,
            ])
            ->subject(Lang::get('Verify Email Address'))
            ->line(
                Lang::get(
                    'Please click the button below to verify your email address.'
                )
            )
            ->action(Lang::get('Verify Email Address'), $url)
            ->line(
                Lang::get(
                    'If you did not create an account, no further action is required.'
                )
            );
    }
    protected function verificationUrl($notifiable)
    {
        if (static::$createUrlCallback) {
            return call_user_func(static::$createUrlCallback, $notifiable);
        }

        return route('verification.verify', [
            'id' => $notifiable->getKey(),
            'hash' => sha1($notifiable->getEmailForVerification()),
        ]);
    }

    public static function createUrlUsing($callback)
    {
        static::$createUrlCallback = $callback;
    }
    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }
}
