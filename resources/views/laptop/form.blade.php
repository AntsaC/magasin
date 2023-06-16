@extends('layouts.app')
@section('content')
<div class="container">
    <div class="pagetitle">
        <h1>
            @if(isset($laptop))
                Edit laptop
            @else
                New laptop
            @endif
        </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('laptops.index') }}">Laptops</a></li>
                <li class="breadcrumb-item active">New</li>
            </ol>
        </nav>
    </div>
    <div style="width: 50%" class="card">
        <div class="card-body mt-3">
            <form method="post" enctype="multipart/form-data" action="{{ isset($laptop) ? route('laptops.update', $laptop->id) : route('laptops.store') }}" >
                @csrf
                @if(isset($laptop))
                    @method('PUT')
                @endif

                 <div class='form-group'>
                    <label for='reference'>Reference</label>
                    <input type='text' name='reference' id='reference' value='{{ isset($laptop) ? $laptop->reference : old('reference') }}' class='form-control @error('reference') is-invalid @enderror' />@error('reference')
                  <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                <div class="d-flex justify-content-between">
                    <div class='form-group w-50'>
                        <label for='ram'>Ram</label>
                        <input type='number' name='ram' id='ram' value='{{ isset($laptop) ? $laptop->ram : old('ram') }}' class='form-control @error('ram') is-invalid @enderror' />@error('ram')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class='form-group w-50 ms-3'>
                        <label for='storage'>Storage</label>
                        <input type='number' name='storage' id='storage' value='{{ isset($laptop) ? $laptop->storage : old('storage') }}' class='form-control @error('storage') is-invalid @enderror' />@error('storage')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="form-inline">
                    <div class='form-group'>
                        <label for='screen_size'>Size "</label>
                        <input type='text' name='screen_size' id='screen_size' value='{{ isset($laptop) ? $laptop->screen_size : old('screen_size') }}' class='form-control @error('screen_size') is-invalid @enderror' />@error('screen_size')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class='form-group ms-3'>
                        <label for='resolution_id'>Resolution</label>
                        <select id='resolution_id' name='resolution_id' class='form-select @error('resolution_id') is-invalid @enderror' aria-label='Default select example'>
                            @foreach( $resolutions as $resolution )
                                <option value='{{ $resolution->id }}' @isset($laptop) @if($resolution->id == $laptop->resolution_id) selected @endif @endisset >{{ $resolution->value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-inline">
                    <div class='form-group'>
                        <label for='brand_id'>Brand</label>
                        <select id='brand_id' name='brand_id' class='form-select @error('brand_id') is-invalid @enderror' aria-label='Default select example'>
                            @foreach( $brands as $brand )
                                <option value='{{ $brand->id }}' @isset($laptop) @if($brand->id == $laptop->brand_id) selected @endif @endisset >{{ $brand->name }}</option>
                            @endforeach
                        </select>@error('brand_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class='form-group ms-3'>
                        <label for='processor_id'>Processor</label>
                        <select id='processor_id' name='processor_id' class='form-select @error('processor_id') is-invalid @enderror' aria-label='Default select example'>
                            @foreach( $processors as $processor )
                                <option value='{{ $processor->id }}' @isset($laptop) @if($processor->id == $laptop->processor_id) selected @endif @endisset >{{ $processor->name }}</option>
                            @endforeach
                        </select>@error('processor_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="form-inline">

                    <div class='form-group '>
                        <label for='ram'>Purchasing price</label>
                        <input @isset($laptop) disabled @endisset type='text' name='purchasing_price' id='purchasing_price' value='{{ isset($laptop) ? $laptop->purchasing_price : old('purchasing_price') }}' class='form-control @error('purchasing_price') is-invalid @enderror' />@error('purchasing_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class='form-group ms-3'>
                        <label for='ram'>Selling price</label>
                        <input type='text' @isset($laptop) disabled @endisset name='price' id='price' value='{{ isset($laptop) ? $laptop->price : old('price') }}' class='form-control @error('price') is-invalid @enderror' />@error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                 <div class='form-group'>
                    <label for='image'>Image</label>
                    <input type='file' name='image' id='image' value='{{ isset($laptop) ? $laptop->image : old('image') }}' class='form-control @error('image') is-invalid @enderror' />@error('image')
                  <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                 @isset($laptop->image)
                    <img class="d-block m-auto img-fluid w-50" src="{{ asset('storage/'.$laptop->image) }}" alt="Laptop image">
                 @endisset
                <input type="submit" class="btn btn-primary px-5 mt-4" value="{{ isset($laptop) ? 'Update' : 'Save' }}">
            </form>
        </div>
    </div>
</div>
@endsection
