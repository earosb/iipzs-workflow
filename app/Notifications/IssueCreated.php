<?php

namespace App\Notifications;

use App\Issue;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class IssueCreated extends Notification
{
    use Queueable;

    /**
     * @var Issue
     */
    protected $issue;

    /**
     * Create a new notification instance.
     *
     * @param Issue $issue
     */
    public function __construct(Issue $issue)
    {
        $this->issue = $issue;
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
            ->greeting("Hola, {$notifiable->name}")
            ->subject("#{$this->issue->id} {$this->issue->title}")
            ->line($this->issue->description)
            ->action('Ver detalles', route('issue.show', $this->issue->id, true))
            ->salutation('Icil Icafal Proyecto Zona Sur S.A.');
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
