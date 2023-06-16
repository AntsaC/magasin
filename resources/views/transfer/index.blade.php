@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
            <div class="pagetitle">
                <h1>
                      Transfers
                </h1>
            </div>
            <a href="{{ route('transfers.multiple') }}" class="btn btn-success">
                + New transfer
            </a>
        </div>
    <div class="card mt-4">
        <div class="card-body mt-3">
            <table id='data' class="table table-hover">
                <thead>
                    <tr>

            <th>Laptop</th>

            <th>Point sale</th>

            <th>Transfer at</th>

            <th>Received at</th>

            <th>Sent</th>

            <th>Received</th>

                        <th>Lost</th>

                        <th>Status</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($transfers as $transfer)
                            <tr>

            <td><a href="{{ route('laptops.show',$transfer->laptop->id ) }}">{{ $transfer->laptop->reference }}</a></td>

            <td>{{ $transfer->sale_point->location }}</td>

            <td>{{ \Carbon\Carbon::parse($transfer->transfer_at)->format('Y-m-d H:i') }}</td>

            <td>{{ $transfer->received_at  }}</td>

            <td>{{ $transfer->quantity_sent }}</td>

            <td>{{ $transfer->quantity_received }}</td>

                                <td>{{ isset($transfer->quantity_received) ? $transfer->quantity_sent - $transfer->quantity_received : '' }}</td>

                                <td class="text-center">
                                    <span @class(['badge','rounded-pill','bg-success' => $transfer->is_received(),'bg-warning' => !$transfer->is_received()])  >{{ $transfer->status->name }}</span>
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
                    [2,'asc']
                ]
            });
        })
        </script>
        @endsection

