<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;

    public $fillable = [
        'title',
        'resume',
        'content'
    ];

    const RULE = [
        'title' => 'required',
        'resume' => 'required'
    ];

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

}
