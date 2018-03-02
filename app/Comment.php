<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Comment
 *
 * @property int $id
 * @property int $user_id
 * @property string $content
 * @property int $observation_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Attachment[] $attachments
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereObservationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereUserId($value)
 * @mixin \Eloquent
 * @property int $immediate_action_id
 * @property-read \App\User $immediateAction
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereImmediateActionId($value)
 */
class Comment extends Model
{
    protected $fillable = ['user_id', 'immediate_action_id', 'observation_id', 'content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function immediateAction()
    {
        return $this->belongsTo(User::class, 'immediate_action_id');
    }

    /**
     * Get all of the comment's attachments.
     */
    public function attachments()
    {
        return $this->morphMany('App\Attachment', 'attachable');
    }
}
