<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['blog_id', 'name', 'email', 'comment'];

    public function blog(): BelongsTo
    {
        return $this->belongsTo(Blog::class);
    }
}
