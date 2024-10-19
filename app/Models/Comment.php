<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'article_id',
        'comment'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function article(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}