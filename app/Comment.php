<?php

namespace App;

use App\Events\IssueCommented;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Comment
 *
 * @property int $id
 * @property int $created_by
 * @property string $description
 * @property int $issue_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Attachment[] $attachments
 * @property-read \App\User $createdBy
 * @property-read \App\Issue $issue
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereIssueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['created_by', 'description', 'issue_id'];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => IssueCommented::class,
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function issue()
    {
        return $this->belongsTo('App\Issue');
    }

    /**
     * Get all of the comment's attachments.
     */
    public function attachments()
    {
        return $this->morphMany('App\Attachment', 'attachable');
    }
}
