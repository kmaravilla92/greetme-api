<?php

namespace App\Models;

use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CardTemplate extends Base
{
    public function parts()
    {
        return $this->hasMany(CardTemplatePart::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(CardTemplateCategory::class);
    }

    public function cards()
    {
        return $this->hasMany(Card::class);
    }
}