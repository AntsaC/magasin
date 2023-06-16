@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <div class="pagetitle">
            <h1>
                @if(isset($transfer))
                    Edit transfer
                @else
                    New transfer
                @endif
            </h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('transfers.index') }}">Transfers</a></li>
                    <li class="breadcrumb-item active">New</li>
                </ol>
            </nav>
        </div>
        <div class="button-group" role="group">
            <a href="{{ route('transfers.create') }}" class="btn btn-outline-primary">
                </i> Single
            </a>
            <a href="{{ route('transfers.multiple') }}" class="btn btn-outline-primary">
                Multiple
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-body mt-3">
            <form method="post" enctype="multipart/form-data" action="{{ route('transfers.store') }}">
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
                    <label for='sale_point_id'>Point of sale</label>
                    <select id='sale_point_id' name='sale_point_id' class='form-select @error('sale_point_id') is-invalid @enderror' aria-label='Default select example'>
                        @foreach( $sale_points as $sale_point )
                            <option value='{{ $sale_point->id }}' @isset($transfer) @if($sale_point->id == $transfer->sale_point_id) selected @endif @endisset >{{ $sale_point->location }}</option>
                        @endforeach
                    </select>@error('sale_point_id')
                  <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                 <div class='form-group'>
                    <label for='quantity_sent'>Quantity</label>
                    <input type='text' name='quantity_sent' id='quantity_sent' value='{{ isset($transfer) ? $transfer->quantity_sent : old('quantity_sent') }}' class='form-control @error('quantity_sent') is-invalid @enderror' />@error('quantity_sent')
                  <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                <input type="submit" class="btn btn-primary" value="{{ isset($transfer) ? 'Update' : 'Save' }}">
            </form>
        </div>
    </div>
</div>
@endsection
