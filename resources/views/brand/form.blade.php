@extends('layouts.app')
@section('content')
<div class="container">
    <div class="pagetitle">
        <h1>
            @if(isset($brand))
                Edit brand
            @else
                New brand
            @endif
        </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('brands.index') }}">Brands</a></li>
                <li class="breadcrumb-item active">New</li>
            </ol>
        </nav>
    </div>
    <div class="card w-50">
        <div class="card-body mt-3">
            <form method="post" enctype="multipart/form-data" action="{{ isset($brand) ? route('brands.update', $brand->id) : route('brands.store') }}">
                @csrf
                @if(isset($brand))
                    @method('PUT')
                @endif

                 <div class='form-group'>
                    <label for='name'>Name</label>
                    <input type='text' name='name' id='name' value='{{ isset($brand) ? $brand->name : old('name') }}' class='form-control @error('name') is-invalid @enderror' />@error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                 <div class='form-group'>
                    <label for='image'>Image</label>
                    <input type='file' name='image' id='image' value='{{ isset($brand) ? $brand->image : old('image') }}' class='form-control @error('image') is-invalid @enderror' />@error('image')
                  <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                <input type="submit" class="btn btn-primary" value="{{ isset($brand) ? 'Update' : 'Save' }}">
            </form>
        </div>
    </div>
</div>
@endsection
