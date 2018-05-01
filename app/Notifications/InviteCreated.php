<?php

namespace App\Notifications;

use App\Invite;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class InviteCreated extends Notification
{
    use Queueable;


    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting("Hola {$notifiable->name}")
            ->subject('Invitación a ' . config('app.name'))
            ->line('Has sido invitado al sistema de inspecciones de Icil Icafal PZS S.A.')
            ->action('Crear cuenta', url(config('app.url').route('accept', $notifiable->token, false)))
            ->line('Si no has solicitado una cuenta, por favor ignora este mensaje.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
