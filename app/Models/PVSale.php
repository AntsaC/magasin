<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PVSale extends Model
{
    use HasFactory;

    protected $table = 'pv_sale';

    static function get_all($year)
    {
        $sales = [];
        foreach (SalePoint::orderBy('location')->get() as $sale_point)
        {
            $sales[$sale_point->location] = [0,0,0,0,0,0,0,0,0,0,0,0];
        }
        foreach (PVSale::where('year', $year)->get() as $pv)
        {
            $sales[$pv->location][$pv->month -1] = $pv->total;
        }
        return $sales;
    }


    // QUESTION FARANYYYY
    static function get_all_by_year_month($year, $month)
    {
        $result = array();
        $commisions = Commision::get_all_comision_per_pv($year);
        foreach (self::get_all($year) as $key => $pv)
        {
            $result[] = array(
                'pv' => $key,
                'montant' => $pv[$month - 1],
                'commission' => $commisions[$key][$month - 1]
            );

        }
        return $result;
    }


}
