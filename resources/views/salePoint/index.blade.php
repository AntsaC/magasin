@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <div class="pagetitle">
            <h1>
                Point of sales
            </h1>
        </div>
        <a href="{{ route('sale-points.create') }}" class="btn btn-success">
            + New point of sale
        </a>
    </div>
    <div class="card mt-4">
        <div class="card-body mt-3">
            <table id='data' class="table table-hover">
                <thead>
                    <tr>

            <th>Location</th>

            <th>User</th>

                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($salePoints as $salePoint)
                            <tr>

            <td>{{ $salePoint->location }}</td>

            <td>{{ str_replace(['[',']','"'],'',$salePoint->users->pluck('name')) ?? '' }}</td>

                                <td class="control">
                                    <a href="{{ route('sale-points.edit', $salePoint->id) }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <span>
                    <form class="d-inline" method="POST" action="{{ route("sale-points.destroy", $salePoint->id) }}">
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
                buttons: [],
                order: [
                    [0,'asc']
                ]
            });
        })
        </script>
        @endsection

