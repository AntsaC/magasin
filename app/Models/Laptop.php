<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Laptop extends Model
{
    use HasFactory;

    public $timestamps = false;

    const RULE = [
    ];

    protected $guarded = ['id'];

    protected $with = ['brand', 'processor'];

    public function resolution(): BelongsTo {
        return $this->belongsTo(Resolution::class);
    }

    public function storage_type(): BelongsTo {
        return $this->belongsTo(Storage::class,'storage_id');
    }

    public function brand(): BelongsTo {
        return $this->belongsTo(Brand::class);
    }

    public function processor(): BelongsTo {
        return $this->belongsTo(Processor::class);
    }

}
