<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Processor extends Model
{
    use HasFactory;

    public $timestamps = false;

    const RULE = [
    ];

    protected $guarded = ['id'];

    protected $with = ['processor_type'];

    public function processor_type(): BelongsTo {
        return $this->belongsTo(ProcessorType::class);
    }

}
