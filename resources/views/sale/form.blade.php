@extends('layouts.app')
@section('content')
<div class="container">
    <div class="pagetitle">
        <h1>
                New sale
        </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('sales.index') }}">Sales</a></li>
                <li class="breadcrumb-item active">New</li>
            </ol>
        </nav>
    </div>
    <div class="card w-50">
        <div class="card-body mt-3">
            <form method="post" action="{{ isset($sale) ? route('sales.update', $sale->id) : route('sales.store') }}">
                @csrf
                @if(isset($sale))
                    @method('PUT')
                @endif

                 <div class='form-group'>
                    <label for='laptop_id'>Laptop</label>
                    <select id='laptop_id' name='laptop_id' class='form-select @error('laptop_id') is-invalid @enderror' aria-label='Default select example'>
                        @foreach( $laptops as $laptop )
                            <option value='{{ $laptop->laptop->id }}'  @if($laptop->laptop->id == old('laptop_id')) selected @endif >{{ $laptop->laptop->reference }} ({{$laptop->laptop->price.'  | '.$laptop->quantity.' in stock' }})</option>
                        @endforeach
                    </select>@error('laptop_id')
                  <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                 <div class='form-group'>
                    <label for='quantity'>Quantity</label>
                    <input type='text' name='quantity' id='quantity' value='{{ isset($sale) ? $sale->quantity : old('quantity') }}' class='form-control @error('quantity') is-invalid @enderror' />@error('quantity')
                  <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                <div class='form-group'>
                    <label for='received'>Date</label>
                    <input type='datetime-local' name='created_at' id='created_at' value='{{ old('created_at') ?? \Carbon\Carbon::now() }}' class='form-control @error('created_at') is-invalid @enderror' />@error('created_at')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <input type="submit" class="btn btn-primary" value="{{ isset($sale) ? 'Update' : 'Save' }}">
            </form>
        </div>
    </div>
</div>
@endsection
