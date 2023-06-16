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
                    Montant and commission of {{ \Carbon\Carbon::create(null, $date->month)->format('F').' '.$date->year }}
                </h5>
                <div>
                    <form action="">
                        <div class="d-flex">
                            <div>
                                <input type="month" class="form-control" value="{{ $date->year }}-{{ strlen($date->month) == 1 ? '0'.$date->month : $date->month  }}" name="date" />
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
                        <th>Point of sale</th>

                        <th>Montant</th>

                        <th>Commission</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($pvs as $pv)
                            <tr>
                                <td>{{ $pv['pv'] }}</td>
                                <td>{{ $pv['montant'] }}</td>
                                <td>{{ $pv['commission'] }}</td>
                            </tr>
                    @endforeach
                    <tr class="table-light">
                        <td>Total</td>
                        <td>{{ array_sum(array_column($pvs, 'montant')) }}</td>
                        <td>{{ array_sum(array_column($pvs, 'commission')) }}</td>
                    </tr>
                </tbody>
            </table>
            <canvas id="global"></canvas>
        </div>
    </div>
</div>
@endsection

        @section('js')
            <script>
        $(document).ready(function() {
            $('#data').DataTable({
                dom: 'Bfrtip',
                buttons: ['pdf'],
                ordering: false,
                searching: false,
            });




        })
        </script>
        @endsection

