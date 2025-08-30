<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailNotification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmail extends VerifyEmailNotification
{
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Verifikasi Email Akun Anda - OsingGuide')
            ->greeting('Halo, ' . $notifiable->name . ' 👋')
            ->line('Terima kasih sudah mendaftar di **OsingGuide**.')
            ->line('Silakan klik tombol di bawah untuk memverifikasi alamat email Anda.')
            ->action('Verifikasi Email', $verificationUrl)
            ->line('Link ini berlaku selama 60 menit.')
            ->line('Jika Anda tidak membuat akun, abaikan email ini.')
            ->salutation('Salam hangat, Tim OsingGuide 💙');
    }

    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }
}
