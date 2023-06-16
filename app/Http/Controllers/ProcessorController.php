<?php

namespace App\Http\Controllers;

use App\Models\Processor;
use App\Models\ProcessorType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class ProcessorController extends Controller
{

    public function index()
    {
        return view("processor.index", [
            "processors" => Processor::all()
        ]);
    }

    public function create()
    {
        return view("processor.form",[
            "processor_types" => ProcessorType::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:processors']
        ]);
        Processor::create($request->all());
        return Redirect::route('processors.index');
    }

    public function show(Processor $processor)
    {
        return view("processor.show",[
            "processor" => $processor
        ]);
    }

    public function edit(Processor $processor)
    {
        return view("processor.form", [
            "processor_types" => ProcessorType::all(),
            "processor" => $processor
        ]);
    }

    public function update(Request $request, Processor $processor)
    {
        $unique = null;
        if($processor->reference != $request->name)
            $unique = 'unique:processors';
        $request->validate([
            'name' => ['required', $unique]
        ]);
        $processor->update($request->all());
        return Redirect::route("processors.index");
    }

    public function destroy(Processor $processor)
    {
        $processor->delete();
        return Redirect::route("processors.index");
    }
}
