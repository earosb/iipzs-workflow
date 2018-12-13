<?php

namespace App;

use App\Notifications\InviteCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Invite extends Model
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'token',
    ];

    /**
     *
     * @param string $token
     */
    public function sendInvitationNotification()
    {
        $this->notify(new InviteCreated());
    }
}
