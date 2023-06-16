@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
            <div class="pagetitle">
                <h1>
                      Dashboard
                </h1>
            </div>
        </div>
    <div class="card mt-4">
        <div class="card-body mt-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">
                    Sales per point of {{ $year }}
                </h5>
                <div>
                    <form action="">
                        <div class="d-flex">
                            <div>
                                <input type="number" class="form-control" value="{{ $year }}" name="date" />
                            </div>
                            <div>
                                <input class="btn btn-primary" type="submit" value="Search">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <table id='data' class="table table-hover">
                <thead>
                    <tr>
            <th></th>

            <th>January</th>

            <th>February</th>

            <th>March</th>

            <th>April</th>

            <th>May</th>

            <th>June</th>

            <th>July</th>

            <th>August</th>

            <th>September</th>
            <th>October</th>
            <th>November</th>
            <th>December</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($pvs as $key => $pv)
                            <tr>
                                <td class="fw-bold">{{ $key }}</td>
                                @for($i = 0 ; $i < 12 ;$i++)
                                    <td>{{ number_format($pv[$i], 2, '.', ' ') }}</td>
                                @endfor
                            </tr>
                    @endforeach
                </tbody>
            </table>
            <canvas id="global"></canvas>
        </div>
    </div>
</div>
@endsection

        @section('js')
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <script>
        $(document).ready(function() {
            $('#data').DataTable({
                dom: 'Bfrtip',
                buttons: ['pdf'],
                ordering: false,
                searching: false,
                scrollX: true
            });




        })
        </script>
        @endsection

