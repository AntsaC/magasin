@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <div class="pagetitle">
            <h1>
                Brand lists
            </h1>
        </div>
        <a href="{{ route('brands.create') }}" class="btn btn-success">
            + New brand
        </a>
    </div>
    <div class="card mt-4 w-50 m-auto">
        <div class="card-body mt-3">
            <table id='data' class="table table-hover">
                <thead>
                    <tr>

            <th>Name</th>

                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($brands as $brand)
                            <tr>

            <td>
                @isset($brand->image)
                <img width="35" height="35" src="{{ asset('storage/'.$brand->image) }}" alt="brand">
                @endisset
                    {{ $brand->name }}
            </td>

                                <td class="text-center">
                                    <a href="{{ route('brands.edit', $brand->id) }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <span>
                    <form class="d-inline" method="POST" action="{{ route("brands.destroy", $brand->id) }}">
                    @csrf
                        @method("DELETE")
                    <button style="background: none" class="border-0" >
                        <span><i class="fas fa-trash text-danger"></i></span>
                    </button>
                </form>
                </span>
                                </td>


                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

        @section('js')
        <script>
        $(document).ready(function() {
            $('#data').DataTable({
                dom: 'Bfrtip',
                buttons: []
            });
        })
        </script>
        @endsection

