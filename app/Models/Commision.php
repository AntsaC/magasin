<?php

namespace App\Models;

use Carbon\Carbon;

class Commision
{

    static function get_all_comision_per_pv($year = null)
    {
        $sales = [];
        if($year == null)
            $year = Carbon::now()->year;
        foreach (SalePoint::orderBy('location')->get() as $sale_point)
        {
            $sales[$sale_point->location] = [0,0,0,0,0,0,0,0,0,0,0,0];
        }
        foreach (PVSale::where('year', $year)->get() as $pv)
        {
            $sales[$pv->location][$pv->month -1] = Palier::calculate_commision($pv->total);
        }
        return $sales;
    }

    static function get_commision_per_month()
    {
        $months = [];
        for ($month = 0; $month < 12; $month++)
        {
            $months[$month]['month'] = Carbon::create(null, $month + 1)->format('F');
            $months[$month]['total'] = 0;

            foreach (self::get_all_comision_per_pv() as $pv)
            {
                $months[$month]['total'] += $pv[$month];
            }
        }

        return $months;
    }

}
