<?php

namespace App\Http\Controllers;

use App\Models\Lost;
use App\Models\StockGroup;
use App\Models\StockPv;
use App\Models\Transfer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class MagasinReceptionController extends Controller
{
    public function reception()
    {
        return view("reception_mag.reception", [
            "transfers" => Transfer::all_return()
        ]);
    }

    public function reception_validation(Transfer $transfer)
    {
        return view('reception_mag.validation', compact('transfer'));
    }

    public function validate_reception(Request $request, Transfer $transfer){
        $request->validate([
            'quantity_received' => ['required','numeric','min:0','max:'.$transfer->quantity_sent],
            'received_at' => ['required','date','before_or_equal:'.Carbon::now()],
        ]);
        $request->merge([
            "status_id" => 2
        ]);
        $transfer->update($request->all());

        //Increase stock
        $stock = StockGroup::firstOrNew([
            "laptop_id" => $transfer->laptop_id,
        ]);

        $stock->quantity += $request->quantity_received;
        $stock->save();

        //Lost laptop
        if($transfer->quantity_sent != $transfer->quantity_received){
            $lost_quantity = $transfer->quantity_sent - $transfer->quantity_received;
            session()->flash('warning', $lost_quantity.' laptops were lost !');
        }
        return Redirect::route('receptions.magasin');
    }

}
