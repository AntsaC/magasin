<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockGroup extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'laptop_id';

    const RULE = [
    ];

    protected $guarded = [];

    public $incrementing = false;

    protected $with = ['laptop'];

    public function laptop(): BelongsTo {
        return $this->belongsTo(Laptop::class);
    }

    public static function by_laptop($laptop_id)
    {
        return StockGroup::where('laptop_id', $laptop_id)
            ->first();
    }

}
