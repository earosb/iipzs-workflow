<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Resource
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Resource whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Resource whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Resource whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Resource whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Resource whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Resource extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];
}
