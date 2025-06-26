<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['url', 'image_able_id', 'image_able_type'];

    public function image_able()
    {
        return $this->morphTo();
    }
}
