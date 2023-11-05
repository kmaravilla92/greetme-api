<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Base extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $guarded = [];

    public function resolveRouteBinding(
        $value,
        $field = null
    )
    {
        return $this
                ->where(
                    'id',
                    $value
                )
                ->active()
                ->firstOrFail();
    }

    public function scopeActive(
        Builder $query
    )
    {
        $query->where(
            'status',
            'active'
        );
    }

    public function scopeInactive(
        Builder $query
    )
    {
        $query->where(
            'status',
            'inactive'
        );
    }
}
