@extends('layouts.app')
@section('content')
<div class="container">
    <div class="pagetitle">
        <h1>
            Reception
        </h1>
    </div>
    <div class="card w-50">
        <div class="card-body mt-3">
            <form method="post" action="{{ route('reception.validate', $transfer) }}">
                @csrf
                 <div class='form-group'>
                    <label for='received'>Received</label>
                    <input type='number' name='quantity_received' id='received' value='{{ old('quantity_sent') ?? $transfer->quantity_sent }}' class='form-control @error('quantity_received') is-invalid @enderror' />@error('quantity_received')
                  <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                <div class='form-group'>
                    <label for='received'>Date</label>
                    <input type='datetime-local' name='received_at' id='received_at' value='{{ old('received_at') ?? \Carbon\Carbon::now() }}' class='form-control @error('received_at') is-invalid @enderror' />@error('received_at')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <input type="submit" class="btn btn-primary" value="Validate">
            </form>
        </div>
    </div>
</div>
@endsection
