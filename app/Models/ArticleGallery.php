<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArticleGallery extends Model
{
    protected $fillable = ['article_id', 'image_path'];

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}
