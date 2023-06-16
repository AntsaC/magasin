@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
            <div class="pagetitle">
                <h1>
                      Receptions
                </h1>
            </div>
        </div>
    <div class="card mt-4">
        <div class="card-body mt-3">
            <table id='data' class="table table-hover">
                <thead>
                    <tr>

            <th>Laptop</th>

            <th>Transfer at</th>

            <th>Received at</th>

            <th>Sent</th>

            <th>Received</th>

            <th>Lost</th>

                        <th class="text-center">Status</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($transfers as $transfer)
                            <tr>

            <td>
                <a href="{{ route('laptops.pv', $transfer->laptop->id) }}" class="btn btn-link">
                    {{ $transfer->laptop->reference }}
                </a>
            </td>

            <td>{{ \Carbon\Carbon::parse($transfer->transfer_at)->format('Y-m-d H:i') }}</td>

            <td>{{ isset($transfer->received_at) ? \Carbon\Carbon::parse($transfer->received_at)->format('Y-m-d H:i') : '' }}</td>

            <td>{{ $transfer->quantity_sent }}</td>

            <td>{{ $transfer->quantity_received }}</td>

            <td>{{ isset($transfer->quantity_received) ? $transfer->quantity_sent - $transfer->quantity_received : '' }}</td>
                                <td class="text-center">
                                    @if($transfer->status->id == 1)
                                        <a href="{{ route('reception.validation', $transfer->id) }}" class="link-info">Receive</a>
                                    @else
                                        <span class="badge rounded-pill bg-success">
                                               {{ $transfer->status->name }}
                                        </span>
                                    @endif
                                </td>

                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@if(session('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('warning') }}
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
                order: [
                    [1,'asc']
                ]
            });
        })
        </script>
        @endsection

