<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Observation
 *
 * @property int $id
 * @property int $type_id
 * @property string $title
 * @property string $content
 * @property int $user_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Type $type
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Observation whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Observation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Observation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Observation whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Observation whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Observation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Observation whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Status $status
 * @property int $status_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Observation[] $attachments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Observation whereStatusId($value)
 */
class Observation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type_id', 'title', 'content', 'user_id'];

    /**
     * Tipo de observación
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * Usuario creador
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Estado de la observación
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Comentarios de una observación
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get all of the comment's attachments.
     */
    public function attachments()
    {
        return $this->morphMany('App\Observation', 'attachable');
    }
}
