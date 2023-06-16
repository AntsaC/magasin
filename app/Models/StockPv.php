<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockPv extends Model
{
    use HasFactory;

    public $timestamps = false;

    const RULE = [
    ];

    protected $guarded = ['id'];

    protected $with = [
        'laptop'
    ];

    public static function by_pv($pv_id)
    {
        return StockPv::where("sale_point_id", $pv_id)->get();
    }

    public static function by_pv_laptop($pv_id, $laptop)
    {
        return StockPv::where('sale_point_id',$pv_id)->where('laptop_id', $laptop)->first();
    }

    public function laptop(): BelongsTo
    {
        return $this->belongsTo(Laptop::class);
    }

}
