<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'creator_id',
        'title',
        'image',
        'description',
        'slug'
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function createUniqueSlug($title, $id = 0)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;

        $i = 1;
        while (static::where('slug', $slug)->where('id', '<>', $id)->exists()) {
            $slug = $originalSlug . '-' . $i;
            $i++;
        }

        return $slug;
    }

}
