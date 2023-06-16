<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class BrandController extends Controller
{

    public function index()
    {
        return view("brand.index", [
            "brands" => Brand::all()
        ]);
    }

    public function create()
    {
        return view("brand.form");
    }

    public function store(Request $request)
    {
        $request->validate(Brand::RULE);
        $brand = new Brand();
        $brand->fill($request->all());
        if($request->has('image'))
            $brand->image = $request->file('image')->store('brands','public');
        $brand->save();
        return Redirect::route('brands.index');
    }

    public function show(Brand $brand)
    {
        return view("brand.show",[
            "brand" => $brand
        ]);
    }

    public function edit(Brand $brand)
    {
        return view("brand.form", compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $unique = null;
        if($brand->name != $request->name)
            $unique = 'unique:brands';
        $request->validate([
            'name' => ['required', $unique]
        ]);
        if($request->has('image'))
            $brand->image = $request->file('image')->store('brands','public');
        $brand->save();
        return Redirect::route("brands.index");
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return Redirect::route("brands.index");
    }
}
