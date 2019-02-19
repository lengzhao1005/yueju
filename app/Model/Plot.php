<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Plot extends Model
{
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
