<?php

namespace App\Http\Controllers;

use App\Models\Benefice;
use App\Models\Commision;
use App\Models\GlobalSale;
use App\Models\PVSale;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use function view;

class DashboardController extends Controller
{

    function magasin()
    {
        $year = $_GET['date'] ?? Carbon::now()->year;
        if($year == null)
            $year = Carbon::now()->year;

        return view("dashboard.global_sale", [
            "GlobalSales" => GlobalSale::get_all($year),
            'title' => 'Global sale '.$year,
            'year' => $year
        ]);
    }

    function pv_sale(Request $request)
    {
        $year = $_GET['date'] ?? Carbon::now()->year;
        return view('dashboard.pv_sale', [
            'pvs' => PVSale::get_all($year),
            'title' => 'Sale per point',
            'year' => $year
        ]);
    }

    function global_sale_resource($year)
    {
        return response()->json(GlobalSale::get_all($year)->pluck('total'));
    }

    function benefice()
    {
        $year = $_GET['date'] ?? Carbon::now()->year;
        return view('dashboard.benefice',[
            'benefices' => Benefice::find_all($year),
            'title' => 'Benefice '.$year,
            'year' => $year == null ? 'global' : $year
        ]);
    }

    function benefice_resource($year)
    {
        return response()->json(
            [
                Benefice::find_all($year)->pluck('benefice'),
                Benefice::find_all($year)->pluck('total_vente')
            ]
        );
    }

    function pv(): View
    {
        return view('pv.dashboard');
    }

    function montant_commision()
    {
        $date = isset($_GET['date']) ? Carbon::createFromFormat('Y-m', $_GET['date'] ) : Carbon::now();
        $pvs = PVSale::get_all_by_year_month($date->year, $date->month);

        return view('dashboard.montant_commision', [
            'pvs' => $pvs,
            'date' => $date
        ]);
    }

}
