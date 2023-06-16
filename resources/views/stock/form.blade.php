@extends('layouts.app')
@section('content')
<div class="container">
    <div class="pagetitle">
        <h1>
            Add stock
        </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('stocks.index') }}">Stocks</a></li>
                <li class="breadcrumb-item active">New</li>
            </ol>
        </nav>
    </div>
    <div class="card w-50">
        <div class="card-body mt-3">
            <form method="post" action="{{ isset($stock) ? route('stocks.update', $stock->id) : route('stocks.store') }}">
                @csrf

                 <div class='form-group'>
                    <label for='laptop_id'>Laptop</label>
                    <select id='laptop_id' name='laptop_id' class='form-select @error('laptop_id') is-invalid @enderror' aria-label='Default select example'>
                        @foreach( $laptops as $laptop )
                            <option value='{{ $laptop->id }}' @isset($stock) @if($laptop->id == $stock->laptop_id) selected @endif @endisset >{{ $laptop->reference }}</option>
                        @endforeach
                    </select>@error('laptop_id')
                  <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                <div class='form-group'>
                    <label for='quantity'>Quantity</label>
                    <input type='number' name='quantity' id='quantity' value='{{ isset($stock) ? $stock->quantity : old('quantity') }}' class='form-control @error('quantity') is-invalid @enderror' />@error('quantity')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <input type="submit" class="btn btn-primary" value="{{ isset($stock) ? 'Update' : 'Save' }}">
            </form>
        </div>
    </div>
</div>
@endsection
