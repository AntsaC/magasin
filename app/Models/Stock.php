<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stock extends Model
{
    use HasFactory;

    const RULE = [
        'quantity' => ['required','numeric', 'min:1']
    ];

    protected $guarded = ['id','created_at', 'updated_at'];

    protected $with = ['laptop'];

    public function laptop(): BelongsTo {
        return $this->belongsTo(Laptop::class);
    }

}
