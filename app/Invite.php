<?php

namespace App;

use App\Notifications\InviteCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * App\Invite
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invite whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invite whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invite whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invite whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invite query()
 */
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
