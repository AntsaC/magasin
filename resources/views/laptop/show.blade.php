@extends('layouts.app')
@section('content')
<div class="container">
    <div class="pagetitle">
        <h1>
            Laptop detail
        </h1>
    </div>
    <div class="card">
        <div class="card-body mt-3">
            <div class="container my-5 row align-items-center">
                <div class="col col-5">
                    <img src="{{ isset($laptop->image) ? asset("storage/".$laptop->image) : asset("img/1.PNG") }}" class="img-fluid" alt="Laptop image">
                </div>
                <div class="col ms-5">
                    <h2 class="fw-bold">{{ $laptop->reference }}</h2>
                    <div class="detail mt-3">
                        <div class="row">
                            <h5 class="col l">
                                Brand
                            </h5>
                            <h5 class="col">
                                {{ $laptop->brand->name }}
                            </h5>
                        </div>
                        <div class="row">
                            <h5 class="col l">
                                Processor
                            </h5>
                            <h5 class="col">
                                {{ $laptop->processor->name }}
                            </h5>
                        </div>
                        <div class="row">
                            <h5 class="col l">
                                Ram
                            </h5>
                            <h5 class="col">
                                {{ $laptop->ram }} GB
                            </h5>
                        </div>
                        <div class="row">
                            <h5 class="col l">
                                Storage
                            </h5>
                            <h5 class="col">
                                {{ $laptop->storage }} GB {{ $laptop->storage_type->type }}
                            </h5>
                        </div>
                        <div class="row">
                            <h5 class="col l">
                                Size
                            </h5>
                            <h5 class="col">
                                {{ $laptop->screen_size }} "
                            </h5>
                        </div>
                        <div class="row">
                            <h5 class="col l">
                                Resolution
                            </h5>
                            <h5 class="col">
                                {{ $laptop->resolution->value }} {{ $laptop->resolution->type }}
                            </h5>
                        </div>
                        <div class="row">
                            <h5 class="col l">
                                Purchasing price
                            </h5>
                            <h5 class="col">
                                {{ number_format($laptop->purchasing_price, 2, '.', ' ') }}
                            </h5>
                        </div>
                        <div class="row">
                            <h5 class="col l">
                                Selling price
                            </h5>
                            <h5 class="col">
                                {{ number_format($laptop->price, 2, '.', ' ') }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
