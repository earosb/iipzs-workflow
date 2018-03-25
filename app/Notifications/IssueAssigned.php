<?php

namespace App\Notifications;

use App\Issue;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class IssueAssigned extends Notification
{
    use Queueable;

    /**
     * @var Issue
     */
    protected $issue;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Issue $issue)
    {
        $this->issue = $issue;
    }

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
            ->subject("[iipzs] #{$this->issue->id} {$this->issue->title}")
            ->line('Acción inmediata')
            ->line($this->issue->content)
            ->action('Ver detalles', route('issue.show', $this->issue->id, true))
            ->line('Gracias por usar nuestra aplicación!')
            ->salutation('Saludos');
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
