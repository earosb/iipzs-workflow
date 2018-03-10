<?php

namespace App\Notifications;

use App\Observation;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ObservationCreated extends Notification
{
    use Queueable;

    /**
     * @var Observation
     */
    protected $observation;

    /**
     * Create a new notification instance.
     *
     * @param Observation $observation
     */
    public function __construct(Observation $observation)
    {
        $this->observation = $observation;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail(User $notifiable)
    {
        return (new MailMessage)
            ->greeting("Hola {$notifiable->name}")
            ->subject("[iipzs] #{$this->observation->id} {$this->observation->title}")
            ->line($this->observation->content)
            ->action('Ver detalles', route('observation.show', $this->observation->id, true))
            ->line('Gracias por usar nuestra aplicación!')
            ->salutation('Saludos');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
