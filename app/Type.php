<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Type
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Issue[] $observations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $notifyByDefault
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Issue[] $issue
 */
class Type extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Observaciones de un tipo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function issue()
    {
        return $this->hasMany(Issue::class);
    }

    /**
     * Notificar por defecto a los usuarios
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function notifyByDefault()
    {
        return $this->belongsToMany(User::class);
    }
}
