@extends('layouts.app')
@section('content')
<div class="container">
    <div class="pagetitle">
        <h1>
            Project
        </h1>
    </div>
    <div class="card">
        <div class="card-body mt-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="search-bar">
                    <form class="search-form d-flex align-items-center" action="#">
                        <select class="form-select simple-filter" name="" id="">
                            <option value="" selected>All</option>
                            <option value=""></option>
                        </select>
                        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                        <button type="submit" title="Search"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                <div>
                    <button id="filter-btn" class="btn btn-light">
                        <i class="fas fa-filter"></i>
                        Filter
                    </button>
                    <a href="{{ route('projects.create') }}" class="btn btn-success">New project</a>
                </div>
            </div>
            <table id='data' class="table table-hover">
                <thead>
                    <tr>

            <th>Id</th>

            <th>Name</th>

            <th>Category</th>

            <th>Deadline</th>

            <th>Maker</th>

            <th>Staff</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                            <tr>

            <td>{{ $project->id }}</td>

            <td>{{ $project->name }}</td>

            <td>{{ $project->category->name }}</td>

            <td>{{ $project->deadline }}</td>

            <td>{{ $project->maker }}</td>

            <td>{{ $project->staff }}</td>

                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="multi-filter" class="sidebar">
<h4>Filters</h4>
    <form action="">
        <div class="form-group">
            <label for="name">Name</label>
            <input id="name" name="name" type="text" value="{{ $search['name'] ?? '' }}" class="form-control form-control-sm">
        </div>
        <div class="form-group">
            <label>Category</label>
            <select name="category" id="category" class="form-select form-select-sm">
                <option value="" selected>All</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @isset($search['category']) @if($category->id == $search['category']) selected @endif @endisset>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="min">Min deadline</label>
            <input id="min" name="min" type="date" value="{{ $search['min'] ?? '' }}" class="form-control form-control-sm">
        </div>
        <div class="form-group">
            <label for="max">Max deadine</label>
            <input id="max" name="max" type="date" value="{{ $search['max'] ?? '' }}" class="form-control form-control-sm">
        </div>
        <input type="submit" value="Search" class="btn btn-light">
    </form>
    <button id="hide-filter-btn" class="btn btn-link">
        >>
    </button>
</div>
@if(session('status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('status') }}
</div>
@endif
@endsection

        @section('js')
            <script src="{{ asset('js/alert.js') }}"></script>
        <script>
        $(document).ready(function() {
            $('#data').DataTable({
                dom: 'Bfrtip',
                buttons: [],
                searching: false
            });
        })
        </script>
        @endsection

