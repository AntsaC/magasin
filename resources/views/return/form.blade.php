@extends('layouts.app')
@section('content')
<div class="container">
    <div class="pagetitle">
        <h1>
            Return
        </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('returns.index') }}">Returns</a></li>
                <li class="breadcrumb-item active">New</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body mt-3">
            <form method="post" action="{{ route('returns.store') }}">
                @csrf

                 <div class='form-group'>
                    <label for='laptop_id'>Laptop in stock</label>
                    <select id='laptop_id' name='laptop_id' class='form-select @error('laptop_id') is-invalid @enderror' aria-label='Default select example'>
                        @foreach( $laptops as $laptop )
                            <option value='{{ $laptop->laptop_id }}' @isset($transfer) @if($laptop->laptop_id == $transfer->laptop_id) selected @endif @endisset >{{ $laptop->laptop->reference }} ( {{ $laptop->quantity }} )</option>
                        @endforeach
                    </select>@error('laptop_id')
                  <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                 <div class='form-group'>
                    <label for='quantity_sent'>Quantity</label>
                    <input type='text' name='quantity_sent' id='quantity_sent' value='{{ isset($transfer) ? $transfer->quantity_sent : old('quantity_sent') }}' class='form-control @error('quantity_sent') is-invalid @enderror' />@error('quantity_sent')
                  <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                <div class='form-group col'>
                    <label for='transfer_at'>Date</label>
                    <input type='datetime-local' name='transfer_at' id='transfer_at' value='{{ \Carbon\Carbon::now() }}' class='form-control @error('transfer_at') is-invalid @enderror' />@error('transfer_at')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <input type="submit" class="btn btn-primary" value="Validate">
            </form>
        </div>
    </div>
</div>
@endsection
