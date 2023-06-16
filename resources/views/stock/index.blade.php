@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
            <div class="pagetitle">
                <h1>
                      Purchase list
                </h1>
            </div>
            <a href="{{ route('stocks.create') }}" class="btn btn-success">
                <i class="fa fa-cart-shopping"></i>
                Purchasing
            </a>
        </div>
    <div class="card mt-4">
        <div class="card-body mt-3">
            <div class="button-group">

            </div>
            <table id='data' class="table table-hover">
                <thead>
                    <tr>

            <th>Id</th>

            <th>Laptop</th>
                        <th>Quantity</th>

                        <th>Date</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($stocks as $stock)
                            <tr>

            <td>{{ $stock->id }}</td>
                                <td>{{ $stock->laptop->reference }}</td>
                                <td>{{ $stock->quantity }}</td>

                                <td>{{ $stock->created_at }}</td>



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
                order: [[3,'asc']]
            });
        })
        </script>
        @endsection

