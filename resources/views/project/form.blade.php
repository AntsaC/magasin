@extends('layouts.app')
@section('content')
<div class="container">
    <div class="pagetitle">
        <h1>
            @if(isset($project))
                Edit project
            @else
                New project
            @endif
        </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Articles</a></li>
                <li class="breadcrumb-item active">New</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body mt-3">
            <form method="post" enctype="multipart/form-data" action="{{ isset($project) ? route('projects.update', $project->id) : route('projects.store') }}">
                @csrf
                @if(isset($project))
                    @method('PUT')
                @endif
                
                 <div class='form-group'>
                    <label for='name'>Name</label>
                    <input type='text' name='name' id='name' value='{{ isset($project) ? $project->name : old('name') }}' class='form-control @error('name') is-invalid @enderror' />@error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                 
                 <div class='form-group'>
                    <label for='category_id'>Category_id</label>
                    <select id='category_id' name='category_id' class='form-select' aria-label='Default select example'>
                        @foreach( $categories as $category )
                            <option value='{{ $category->id }}' @isset($project) @if($category->id == $project->category_id) selected @endif @endisset >{{ $category->name }}</option>
                        @endforeach
                    </select>@error('category_id')
                  <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                 
                 <div class='form-group'>
                    <label for='deadline'>Deadline</label>
                    <input type='date' name='deadline' id='deadline' value='{{ isset($project) ? $project->deadline : old('deadline') }}' class='form-control @error('deadline') is-invalid @enderror' />@error('deadline')
                  <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                 
                 <div class='form-group'>
                    <label for='maker'>Maker</label>
                    <input type='datetime-local' name='maker' id='maker' value='{{ isset($project) ? $project->maker : old('maker') }}' class='form-control @error('maker') is-invalid @enderror' />@error('maker')
                  <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                 
                 <div class='form-group'>
                    <label for='staff'>Staff</label>
                    <input type='text' name='staff' id='staff' value='{{ isset($project) ? $project->staff : old('staff') }}' class='form-control @error('staff') is-invalid @enderror' />@error('staff')
                  <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                 
                <input type="submit" class="btn btn-primary" value="{{ isset($project) ? 'Update' : 'Save' }}">
            </form>
        </div>
    </div>
</div>
@endsection
