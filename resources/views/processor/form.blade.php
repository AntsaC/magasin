@extends('layouts.app')
@section('content')
<div class="container">
    <div class="pagetitle">
        <h1>
            @if(isset($processor))
                Edit processor
            @else
                New processor
            @endif
        </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Articles</a></li>
                <li class="breadcrumb-item active">New</li>
            </ol>
        </nav>
    </div>
    <div class="card w-50">
        <div class="card-body mt-3">
            <form method="post" action="{{ isset($processor) ? route('processors.update', $processor->id) : route('processors.store') }}">
                @csrf
                @if(isset($processor))
                    @method('PUT')
                @endif

                 <div class='form-group'>
                    <label for='name'>Name</label>
                    <input type='text' name='name' id='name' value='{{ isset($processor) ? $processor->name : old('name') }}' class='form-control @error('name') is-invalid @enderror' />@error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                 <div class='form-group'>
                    <label for='processor_type_id'>Type</label>
                    <select id='processor_type_id' name='processor_type_id' class='form-select @error('processor_type_id') is-invalid @enderror' aria-label='Default select example'>
                        @foreach( $processor_types as $processor_type )
                            <option value='{{ $processor_type->id }}' @isset($processor) @if($processor_type->id == $processor->processor_type_id) selected @endif @endisset >{{ $processor_type->name }}</option>
                        @endforeach
                    </select>@error('processor_type_id')
                  <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                <input type="submit" class="btn btn-primary" value="{{ isset($processor) ? 'Update' : 'Save' }}">
            </form>
        </div>
    </div>
</div>
@endsection
