@extends('layouts.app')
@section('content')
<div class="container">
    <div class="pagetitle">
        <h1>
            @if(isset($palier))
                Edit palier
            @else
                New palier
            @endif
        </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('paliers.index') }}">Paliers</a></li>
                <li class="breadcrumb-item active">New</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body mt-3">
            <form method="post" enctype="multipart/form-data" action="{{ isset($palier) ? route('paliers.update', $palier->id) : route('paliers.store') }}">
                @csrf
                @if(isset($palier))
                    @method('PUT')
                @endif

                 <div class='form-group'>
                    <label for='total_min'>Total min</label>
                    <input type='text' name='total_min' id='total_min' value='{{ isset($palier) ? $palier->total_min : old('total_min') }}' class='form-control @error('total_min') is-invalid @enderror' />@error('total_min')
                  <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                 <div class='form-group'>
                    <label for='total_max'>Total max</label>
                    <input type='text' name='total_max' id='total_max' value='{{ isset($palier) ? $palier->total_max : old('total_max') }}' class='form-control @error('total_max') is-invalid @enderror' />@error('total_max')
                  <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                 <div class='form-group'>
                    <label for='pourcentage'>Pourcentage</label>
                    <input type='text' name='pourcentage' id='pourcentage' value='{{ isset($palier) ? $palier->pourcentage : old('pourcentage') }}' class='form-control @error('pourcentage') is-invalid @enderror' />@error('pourcentage')
                  <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                <input type="submit" class="btn btn-primary" value="{{ isset($palier) ? 'Update' : 'Save' }}">
            </form>
        </div>
    </div>
</div>
@endsection
