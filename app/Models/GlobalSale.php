<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalSale extends Model
{
    use HasFactory;

    protected $table = 'v_global_sale';

    public static function get_all($year): Collection
    {
        $sales = GlobalSale::where('year', $year)->orWhereNull('year')->get();
        $sales->map(function ($item) {
            if($item['total'] == 0)
                $item['color'] = 'gray';
            elseif($item['total'] <= 2000000 && $item['total'] > 0)
                $item['color'] = '#ec7e0d';
            elseif ($item['total'] <= 50000000 && $item['total'] > 2000000)
                $item['color'] = '#0dec20';
            elseif($item['total'] <= 250000000 && $item['total'] > 50000000)
                $item['color'] = '#0da9ec';

            return $item;
        });
        return $sales;
    }

}
