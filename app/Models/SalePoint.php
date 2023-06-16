<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class SalePoint extends Model
{
    use HasFactory;

    public $timestamps = false;

    const RULE = [
        'location' => ['required', 'unique:sale_points']
    ];

    protected $guarded = ['id'];

    public function users() : HasMany
    {
        return $this->hasMany(User::class);
    }

    public static function not_managed() {
        return DB::select("select * from pv_not_affected");
    }

}
