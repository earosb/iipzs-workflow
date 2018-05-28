<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Status
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $class
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Status whereClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Status whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Status whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Status whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Status whereUpdatedAt($value)
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Issue[] $issues
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Status issuesCount()
 * @method static \Illuminate\Database\Query\Builder|\App\Status onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Status whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Status withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Status withoutTrashed()
 */
class Status extends Model
{
    use SoftDeletes;
    
    const COLORS = [
        'primary' => '#3097D1;',
        'info'    => '#8eb4cb;',
        'success' => '#2ab27b;',
        'warning' => '#cbb956;',
        'danger'  => '#bf5329;',
    ];

    /**
     * @var string
     */
    protected $table = 'status';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'class'];

    /**
     * @param $query
     * @return mixed
     */
    public function scopeIssuesCount($query)
    {
        return $query->where('votes', '>', 100);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function issues()
    {
        return $this->hasMany(Issue::class);
    }
}
