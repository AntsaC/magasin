<?php

namespace App\Http\Controllers;

use App\Models\Lost;
use App\Models\SalePoint;
use App\Models\StockGroup;
use App\Models\StockPv;
use App\Models\Transfer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class TransferController extends Controller
{

    public function index()
    {
        return view("transfer.index", [
            "transfers" => Transfer::all_transfer()
        ]);
    }

    public function create()
    {
        return view("transfer.form",[
            'laptops' => StockGroup::all(),
            'sale_points' => SalePoint::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'quantity_sent' => [
                'required','numeric','min:1',
                function($argument, $value, $fail) use ($request) {
                    $stock = StockGroup::by_laptop($request->laptop_id);
                    if($stock->quantity < $value)
                        $fail("Stock of ".$stock->laptop->reference." ($stock->quantity) is insufficient for $value");
                }
            ]
        ]);
        $transfer = new Transfer();
        $transfer->fill($request->all());

        $group = StockGroup::find($request->laptop_id);
        $group->quantity -= $transfer->quantity_sent;
        $group->save();

        $transfer->status_id = 1;
        $transfer->save();

        return Redirect::route('transfers.index');
    }

    public function create_multiple()
    {
        return view('transfer.form-multiple', [
            "laptops" => StockGroup::all(),
            "sale_points" => SalePoint::all()
        ]);
    }

    public function store_multiple(Request $request)
    {

        $request->validate([
            'quantity_sent.*' => ['required','numeric','min:1'],
            'transfer_at.*' => ['required', 'date','before_or_equal:'.Carbon::now()],
            'stock' => function($argument, $value, $fail) use ($request) {
                $qnt_laptops = [];
                foreach ($request->input('laptop_id') as $index => $laptop)
                {
                        if(!isset($qnt_laptops[$laptop]))
                        {
                            $qnt_laptops[$laptop] = 0;
                        }
                        $qnt_laptops[$laptop] += $request->input('quantity_sent')[$index];
                }

                $stocks = StockGroup::all();

                echo json_encode($qnt_laptops);

                foreach ($stocks as $stock)
                {
                    if(isset($qnt_laptops[$stock->laptop_id]))
                    {
                        echo $stock->laptop_id.' '.$qnt_laptops[$stock->laptop_id];
                        if($stock->quantity < $qnt_laptops[$stock->laptop_id]){
                            $fail($stock->laptop->reference."($stock->quantity) is insufficient for ".$qnt_laptops[$stock->laptop_id]);
                        }
                    }
                }
            },
        ]);

        DB::transaction(function () use ($request) {
            foreach ($request->input('laptop_id') as $index => $laptop){
                $this->save_transfer([
                    "laptop_id" => $laptop,
                    "quantity_sent" => $request->input('quantity_sent')[$index],
                    "sale_point_id" => $request->input('sale_point_id')[$index],
                    "transfer_at" => $request->input('transfer_at')[$index],
                ], $laptop);
            }
        });

        return Redirect::route('transfers.index');

    }

    public function reception()
    {
        return view("transfer.reception", [
            "transfers" => Transfer::all_transfer_by_pv(Auth::user()->sale_point_id)
        ]);
    }

    public function reception_validation(Transfer $transfer)
    {
        return view('transfer.validation', compact('transfer'));
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
        $stock = StockPv::firstOrNew([
            "laptop_id" => $transfer->laptop_id,
            "sale_point_id" => Auth::user()->sale_point->id
        ]);

        $stock->quantity += $request->quantity_received;
        $stock->save();

        //Lost laptop
        if($transfer->quantity_sent != $transfer->quantity_received){
            $lost = Lost::firstOrNew(['laptop_id' => $transfer->laptop_id]);
            $lost_quantity = $transfer->quantity_sent - $transfer->quantity_received;
            $lost->quantity += $lost_quantity;
            $lost->save();
            session()->flash('warning', $lost_quantity.' laptops were lost !');
        }
        return Redirect::route('reception');
    }



    protected function save_transfer(array $data, $laptop){
        $transfer = new Transfer();
        $transfer->fill($data);

        $group = StockGroup::find($laptop);
        $group->quantity -= $transfer->quantity_sent;
        $group->save();

        $transfer->status_id = 1;
        $transfer->save();
    }
}
