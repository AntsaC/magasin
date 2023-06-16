<?php

namespace App\Http\Controllers;

use App\Models\Laptop;
use App\Models\Sale;
use App\Models\StockPv;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class SaleController extends Controller
{

    public function index(Request $request)
    {
        return view("sale.index", [
            "sales" => Sale::all_by_pv(Auth::user()->sale_point_id, $request)
        ]);
    }

    public function create()
    {
        return view("sale.form",[
            "laptops" => StockPv::by_pv(Auth::user()->sale_point->id)
        ]);
    }

    public function store(Request $request)
    {
        $pv = Auth::user()->sale_point_id;
        $stock = StockPv::by_pv_laptop($pv, $request->input('laptop_id'));

        $request->validate([
            'quantity' => ['required','numeric','min:1','max:'.$stock->quantity],
            'created_at' => ['required','date','before_or_equal:'.Carbon::now()],
        ]);

        $stock->quantity -= $request->input('quantity');
        $stock->save();

        $request->merge(['sale_point_id' => $pv]);
        Sale::create($request->all());
        return Redirect::route('sales.index');
    }



    public function show_detail($month, $year)
    {
        return view("sale.show",[
            "sales" => DB::table('v_sale_detail')->where('month', $month)->where('status_id',1)
            ->where('year', $year)->get()
        ]);
    }


    public function edit(Sale $sale)
    {
        return view("sale.form", compact('sale'));
    }

    public function update(Request $request, Sale $sale)
    {
        $request->validate(Sale::RULE);
        $sale->update($request->all());
        return Redirect::route("sales.index");
    }

    public function destroy_soft(Sale $sale)
    {
        $sale->status_id = 2;
        $sale->save();
        return Redirect::route("sales.index");
    }
}
