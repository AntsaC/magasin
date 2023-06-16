@extends('layouts.app')
@section('content')
<div class="container">
    <div class="pagetitle">
        <h1>
            @if(isset($salePoint))
                Edit point of sale
            @else
                New point of sale
            @endif
        </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('sale-points.index') }}">Point sale</a></li>
                <li class="breadcrumb-item active">New</li>
            </ol>
        </nav>
    </div>
    <div class="card w-50">
        <div class="card-body mt-3">
            <form method="post" enctype="multipart/form-data" action="{{ isset($salePoint) ? route('sale-points.update', $salePoint->id) : route('sale-points.store') }}">
                @csrf
                @if(isset($salePoint))
                    @method('PUT')
                @endif

                 <div class='form-group'>
                    <label for='location'>Location</label>
                    <input type='text' name='location' id='location' value='{{ isset($salePoint) ? $salePoint->location : old('location') }}' class='form-control @error('location') is-invalid @enderror' />@error('location')
                  <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                <input type="submit" class="btn btn-primary" value="{{ isset($salePoint) ? 'Update' : 'Save' }}">
            </form>
        </div>
    </div>
</div>
@endsection
