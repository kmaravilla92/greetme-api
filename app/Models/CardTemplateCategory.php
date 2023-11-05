<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CardTemplateCategory extends Base
{
    protected $guarded = [];

    public function templates(): BelongsToMany
    {
        return $this->belongsToMany(CardTemplate::class);
    }
}