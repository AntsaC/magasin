<?php

namespace App\Http\Controllers;

use App\Models\Laptop;
use App\Models\Stock;
use App\Models\StockGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class StockController extends Controller
{

    public function index()
    {
        return view("stock.index", [
            "stocks" => Stock::all()
        ]);
    }

    public function create()
    {
        return view("stock.form", [
            "laptops" => Laptop::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(Stock::RULE);
        Stock::create($request->all());

        $group = StockGroup::firstOrNew([
            "laptop_id" => $request->laptop_id
        ]);

        $group->quantity += $request->quantity;
        $group->save();

        return Redirect::route('stocks.index');
    }

    public function show(Stock $stock)
    {
        return view("stock.show",[
            "stock" => $stock
        ]);
    }

    public function group() {
        return view('stock.group', [
            "stock_groups" => StockGroup::orderBy('laptop_id')->get()
        ]);
    }

}
