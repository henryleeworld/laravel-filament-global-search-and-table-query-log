<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SearchLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'resource',
        'search_query',
        'user_id',
    ];

    /**
     * Get the user that owns the search log.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
