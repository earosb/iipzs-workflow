<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
