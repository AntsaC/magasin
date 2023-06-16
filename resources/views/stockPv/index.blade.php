@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
            <div class="pagetitle">
                <h1>
                      Stocks
                </h1>
            </div>
        </div>
    <div class="card mt-4">
        <div class="card-body mt-3">
            <table id='data' class="table table-hover">
                <thead>
                    <tr>

                        <th>Laptop</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stockPvs as $stockPv)
                            <tr>
                                <td>{{ $stockPv->laptop->reference }}</td>


                                <td>{{ $stockPv->quantity }}</td>

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

