<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
