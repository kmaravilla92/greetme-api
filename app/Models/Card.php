<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Card extends Base
{
    protected $fillable = [
        'card_template_id',
        'type',
        'receiver_name',
        'receiver_email',
        'user_id',
        'status',
        'scheduled_at'
    ];

    public function template(): BelongsTo
    {
        return $this->belongsTo(CardTemplate::class,'card_template_id');
    }

    public function signs()
    {
        return $this->hasMany(CardSign::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}