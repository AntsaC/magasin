@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
            <div class="pagetitle">
                <h1>
                      Returns list
                </h1>
            </div>
            <a href="{{ route('returns.create') }}" class="btn btn-success">
                Return
            </a>
        </div>
    <div class="card mt-4">
        <div class="card-body mt-3">
            <table id='data' class="table table-hover">
                <thead>
                    <tr>

            <th>Laptop</th>

            <th>Return at</th>

            <th>Sent</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($transfers as $transfer)
                            <tr>

            <td>{{ $transfer->laptop->reference }}</td>

            <td>{{ $transfer->transfer_at }}</td>

            <td>{{ $transfer->quantity_sent }}</td>

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

