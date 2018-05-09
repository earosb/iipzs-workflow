<?php

namespace App\Notifications;

use App\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class IssueCommented extends Notification
{
    use Queueable;

    /**
     * @var Comment
     */
    public $comment;

    /**
     * Create a new notification instance.
     *
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
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
            ->greeting("Hola, {$notifiable->name}")
            ->subject("#{$this->comment->issue->id} {$this->comment->issue->title}")
            ->line("{$this->comment->createdBy->name} comentó")
            ->line($this->comment->description)
            ->action('Ver detalles', route('issue.show', $this->comment->issue->id, true))
            ->salutation('Icil Icafal Proyecto Zona Sur S.A.');
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
