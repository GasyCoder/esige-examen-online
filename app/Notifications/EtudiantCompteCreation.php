<?php

namespace App\Notifications;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EtudiantCompteCreation extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */

    public function toMail($notifiable)
    {
        $token = app('auth.password.broker')->createToken($notifiable);
        $baseUrl = config('app.url');
        $resetUrl = "{$baseUrl}/reset-password/{$token}?email=" . urlencode($notifiable->email);

        return (new MailMessage)
            ->subject('Votre compte a été créé avec succès')
            ->greeting('Bienvenue ' . $notifiable->name . ' !')
            ->line('Votre compte étudiant a été créé avec succès, et un premier paiement a été effectué.')
            ->line('Voici vos informations de connexion :')
            ->line('Email : ' . $notifiable->email)
            ->action('Réinitialisez votre mot de passe', $resetUrl)
            ->line('Merci d\'utiliser notre application !');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
