<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Transfer extends Model
{
    use HasFactory;

    public $timestamps = false;

    const RULE = [
    ];

    protected $guarded = ['id'];

    protected $table = 'transfers';

    protected $with = ['laptop','sale_point','status'];

    public static function all_return_by_pv($pv)
    {
        return Transfer::where("type_transfert_id",2)->where('sale_point_id',$pv)->get();
    }

    public static function all_return()
    {
        return Transfer::where("type_transfert_id",2)->get();
    }

    public function laptop(): BelongsTo {
        return $this->belongsTo(Laptop::class);
    }

    public function sale_point(): BelongsTo {
        return $this->belongsTo(SalePoint::class);
    }

    public function status(): BelongsTo {
        return $this->belongsTo(Status::class);
    }

    public function is_received()
    {
        return $this->status_id == 2;
    }

    public static function all_transfer() {
        return Transfer::where("type_transfert_id",1)->get();
    }

    public static function all_transfer_by_pv($pv) {
        return Transfer::where("type_transfert_id",1)->where('sale_point_id', $pv)->get();
    }
}
