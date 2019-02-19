<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function plots()
    {
        return $this->morphedByMany(Plot::class, 'taggable');
    }
}
