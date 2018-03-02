<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Attachment
 *
 * @property int $id
 * @property string $name
 * @property string $mime_type
 * @property string $path
 * @property int $attachable_id
 * @property string $attachable_type
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $attachable
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attachment whereAttachableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attachment whereAttachableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attachment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attachment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attachment whereMimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attachment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attachment wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attachment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Attachment extends Model
{
    protected $fillable = ['name', 'mime_type', 'path'];

    public function attachable()
    {
        return $this->morphTo();
    }
}
