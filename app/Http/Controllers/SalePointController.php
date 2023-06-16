<?php

namespace App\Http\Controllers;

use App\Models\SalePoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class SalePointController extends Controller
{

    public function index()
    {
        return view("salePoint.index", [
            "salePoints" => SalePoint::all()
        ]);
    }

    public function create()
    {
        return view("salePoint.form");
    }

    public function store(Request $request)
    {
        $request->validate(SalePoint::RULE);
        SalePoint::create($request->all());
        return Redirect::route('sale-points.index');
    }

    public function show(SalePoint $salePoint)
    {
        return view("salePoint.show",[
            "salePoint" => $salePoint
        ]);
    }

    public function edit(SalePoint $salePoint)
    {
        return view("salePoint.form", compact('salePoint'));
    }

    public function update(Request $request, SalePoint $salePoint)
    {
        $request->validate(SalePoint::RULE);
        $salePoint->update($request->all());
        return Redirect::route("sale-points.index");
    }

    public function destroy(SalePoint $salePoint)
    {
        $salePoint->delete();
        return Redirect::route("sale-points.index");
    }
}
