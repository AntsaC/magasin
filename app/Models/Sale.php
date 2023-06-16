<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class Sale extends Model
{
    use HasFactory;

    const RULE = [
    ];

    protected $guarded = ['id'];

    protected $with = ['laptop'];

    public static function all_by_pv($sale_point_pv, $request)
    {
        return DB::table('v_sale')->where('sale_point_id', $sale_point_pv)
            ->where('status_id',1)
            ->when($request->reference, function (Builder $builder,$name){
                $builder->where('reference','like', "%$name%");
            })
            ->when($request->min, function (Builder $builder, int $name){
                $builder->where('price','>=', $name);
            })
            ->when($request->max, function (Builder $builder, int $name){
                $builder->where('price','<=', $name);
            })
            ->when($request->min_total, function (Builder $builder, int $name){
                $builder->where('total_price','>=', $name);
            })
            ->when($request->max_total, function (Builder $builder, int $name){
                $builder->where('total_price','<=', $name);
            })
            ->orderBy('created_at')
            ->paginate();
    }

    public function laptop(): BelongsTo
    {
        return $this->belongsTo(Laptop::class);
    }

    public function sale_point(): BelongsTo
    {
        return $this->belongsTo(SalePoint::class);
    }



}
