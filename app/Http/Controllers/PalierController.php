<?php

namespace App\Http\Controllers;

use App\Models\Palier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class PalierController extends Controller
{

    public function index()
    {
        return view("palier.index", [
            "paliers" => Palier::all()
        ]);
    }

    public function create()
    {
        return view("palier.form");
    }

    public function store(Request $request)
    {
        $request->validate(Palier::RULE);
        Palier::create($request->all());
        return Redirect::route('paliers.index');
    }

    public function show(Palier $palier)
    {
        return view("palier.show",[
            "palier" => $palier
        ]);
    }

    public function edit(Palier $palier)
    {
        return view("palier.form", compact('palier'));
    }

    public function update(Request $request, Palier $palier)
    {
        $request->validate(Palier::RULE);
        $palier->update($request->all());
        return Redirect::route("paliers.index");
    }

    public function destroy(Palier $palier)
    {
        $palier->delete();
        return Redirect::route("paliers.index");
    }
}
