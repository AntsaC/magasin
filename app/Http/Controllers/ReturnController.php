<?php

namespace App\Http\Controllers;

use App\Models\StockPv;
use App\Models\Transfer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ReturnController extends Controller
{

    public function index(){
        return view('return.index',[
            "transfers" => Transfer::all_return_by_pv(Auth::user()->sale_point->id)
        ]);
    }

    public function create(){
        return view('return.form',[
            "laptops" => StockPv::by_pv(Auth::user()->sale_point->id)
        ]);
    }

    public function store(Request $request){
        $pv = Auth::user()->sale_point->id;
        $request->merge([
            "sale_point_id" => $pv,
            "type_transfert_id" => 2
        ]);
        $stock = StockPv::by_pv_laptop($pv, $request->input('laptop_id'));
        $request->validate([
            'quantity_sent' => ['required','numeric','min:1','max:'.$stock->quantity],
            'transfer_at' => ['required', 'date','before_or_equal:'.Carbon::now()],

        ]);

        $stock->quantity -= $request->input('quantity_sent');
        $stock->save();
        Transfer::create($request->all());
        return Redirect::route('returns.index');
    }

}
