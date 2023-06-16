<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\LapTop;
use App\Models\Processor;
use App\Models\Resolution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class LapTopController extends Controller
{

    public function index()
    {
        return view("lapTop.index", [
            "laptops" => LapTop::paginate(8)
        ]);
    }

    public function create()
    {
        return view("lapTop.form",[
            "brands" => Brand::all(),
            "processors" => Processor::all(),
            'resolutions' => Resolution::all()
        ]);
    }

    public function store(Request $request)
    {
        $lapTop = new LapTop();

        $request->validate([
            'reference' => ['required','unique:laptops'],
            'ram' => ['required','numeric','min:1'],
            'storage' => ['required','numeric','min:1'],
            'screen_size' => ['required', 'numeric', 'min:1'],
            'brand_id' => ['required'],
            'processor_id' => ['required'],
            'purchasing_price' => ['required', 'numeric', 'min:1'],
            'price' => ['required', 'numeric', 'min:1'],
        ]);


        $lapTop->fill($request->all());
        if($request->has('image'))
            $lapTop->image = $request->file('image')->store('laptops','public');
        $lapTop->save();
        return Redirect::route('laptops.index');
    }

    public function show(LapTop $laptop)
    {
        return view("laptop.show",[
            "laptop" => $laptop
        ]);
    }

    public function edit(LapTop $laptop)
    {
        return view("lapTop.form", [
            "brands" => Brand::all(),
            "processors" => Processor::all(),
            'resolutions' => Resolution::all(),
            "laptop" => $laptop
        ]);
    }

    public function update(Request $request, LapTop $laptop)
    {
        $unique = null;
        if($laptop->reference != $request->reference)
            $unique = 'unique:laptops';
        $request->validate([
            'reference' => ['required',$unique],
            'ram' => ['required','numeric','min:1'],
            'storage' => ['required','numeric','min:1'],
            'screen_size' => ['required', 'numeric', 'min:1'],
            'brand_id' => ['required'],
            'processor_id' => ['required'],
            'purchasing_price' => ['same:'.$laptop->purchasing_price],
            'price' => ['same:'.$laptop->price],
        ], [
            'purchasing_price.same' => 'The purchasing price is fixed',
            'price.same' => 'The selling price is fixed',
        ]);

        $laptop->fill($request->all());
        if($request->has('image'))
            $laptop->image = $request->file('image')->store('laptops','public');
        $laptop->save();
        return Redirect::route("laptops.index");
    }

    public function destroy(LapTop $laptop)
    {
        $laptop->delete();
        return Redirect::route("laptops.index");
    }

}
