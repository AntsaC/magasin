@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <div class="pagetitle">
            <h1>
                Processor lists
            </h1>
        </div>
        <a href="{{ route('processors.create') }}" class="btn btn-success">
            + New processor
        </a>
    </div>
    <div class="card mt-4">
        <div class="card-body mt-3">
            <table id='data' class="table table-hover">
                <thead>
                    <tr>

            <th>Id</th>

            <th>Name</th>

            <th>Type</th>

                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($processors as $processor)
                            <tr>

            <td>{{ $processor->id }}</td>

            <td>{{ $processor->name }}</td>

            <td>{{ $processor->processor_type->name }}</td>

                                <td>
                                    <a href="{{ route('processors.edit', $processor->id) }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <span>
                    <form class="d-inline" method="POST" action="{{ route("processors.destroy", $processor->id) }}">
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

