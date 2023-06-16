@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
            <div class="pagetitle">
                <h1>
                      Paliers list
                </h1>
            </div>
            <a href="{{ route('paliers.create') }}" class="btn btn-success">
                + New palier
            </a>
        </div>
    <div class="card mt-4">
        <div class="card-body mt-3">
            <table id='data' class="table table-hover">
                <thead>
                    <tr>

            <th>Id</th>

            <th>Total min (Excluded)</th>

            <th>Total max</th>

            <th>Pourcentage</th>

                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($paliers as $palier)
                            <tr>

            <td>{{ $palier->id }}</td>

            <td>{{ number_format($palier->total_min, 2, '.', ' ') }}</td>

                                <td>{{ number_format($palier->total_max, 2, '.', ' ') }}</td>

            <td>{{ $palier->pourcentage }}</td>

                                <td>
                                     <a href="{{ route('paliers.edit', $palier->id) }}">
                                         <i class="fa fa-edit"></i>
                                     </a>
                                     <form class="d-inline" method="POST" action="{{ route("paliers.destroy", $palier->id) }}">
                                                    @csrf
                                                        @method("DELETE")
                                                    <button style="background: none" class="border-0" >
                                                        <span><i class="fas fa-trash text-danger"></i></span>
                                                    </button>
                                     </form>
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
                buttons: [],
                ordering: [[1,'asc']]
            });
        })
        </script>
        @endsection

