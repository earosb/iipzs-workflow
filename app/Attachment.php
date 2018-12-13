<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = ['name', 'mime_type', 'path'];

    public function attachable()
    {
        return $this->morphTo();
    }
}
