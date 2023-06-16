@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <div class="pagetitle">
            <h1>
                Laptops list
            </h1>
        </div>
        <a href="{{ route('laptops.create') }}" class="btn btn-success">
            + New laptop
        </a>
    </div>
    <div class="card mt-4">
        <div class="card-body mt-3">
            <div class="row row-cols-1 row-cols-md-4 mt-4">
                @foreach( $laptops as $laptop )
                    <div class="col px-4">
                        <div>
                            <div class="hidden-overflow">
                                <a href="{{ route('laptops.show', $laptop->id) }}">
                                    <img class="card-img-top zoom-in" height="227px" src="{{ isset($laptop->image) ? asset("storage/".$laptop->image) : asset("img/1.PNG") }}" alt="Article">
                                </a>
                            </div>
                            <div class="card-body">
                                <a class="overflow-hidden" href="{{ route('laptops.show', $laptop->id) }}">
                                    <h6 class="laptop-ref mt-3 fw-bold text-nowrap overflow-hidden">{{ $laptop->reference }}</h6>
                                </a>
                                <h6>
                                    <strong>Purchasing:</strong> {{ number_format($laptop->purchasing_price, 2, '.', ' ') }}
                                </h6>
                                <h6>
                                    <strong>Selling:</strong> {{ number_format($laptop->price, 2, '.', ' ') }}
                                </h6>
                                <div class="button-control">
                                    <a href="{{ route("laptops.edit", $laptop->id) }}" >
                                        <span><i class="fas fa-edit"></i></span>
                                    </a>
                                    <form method="POST" class="d-inline" action="{{ route("laptops.destroy", $laptop->id) }}">
                                        @csrf
                                        @method("DELETE")
                                        <button class="btn text-danger">
                                            <span><i class="fas fa-trash"></i></span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{ $laptops->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

