<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory, SoftDeletes;

    const MORPH_TO_PREFIX = 'imageable';

    protected $guarded = [];

    public function cardSign(): MorphTo
    {
        return $this->morphTo(self::MORPH_TO_PREFIX);
    }
}